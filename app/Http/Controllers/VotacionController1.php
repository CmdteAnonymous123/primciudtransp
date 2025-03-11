<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleccion;
use App\Models\Candidato;
use App\Models\Votacion;
use App\Models\resultado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VotacionController extends Controller
{
    /**
     * Muestra la interfaz de votación para la elección seleccionada
     *
     * @param int $id_eleccion
     * @return \Illuminate\View\View
     */
    public function index($id_eleccion)
    {
        // Obtener la elección
        $eleccion = Eleccion::findOrFail($id_eleccion);
        
        // Obtener el usuario actual
        $user = Auth::user();
        
        // Verificar si la elección está en curso
        $today = Carbon::now('America/La_Paz')->toDateString();
        $eleccionActiva = ($today >= $eleccion->fecha_ini && $today <= $eleccion->fecha_fin);
        
        // Verificar si el usuario ya votó en esta elección
        $votacion = Votacion::where('id_eleccion', $id_eleccion)
                            ->where('id', $user->id)
                            ->first();
        
        // Obtener todos los candidatos para esta elección
        $candidatos = Candidato::whereHas('elecciones', function($query) use ($id_eleccion) {
                            $query->where('eleccion.id_eleccion', $id_eleccion);
                        })
                        ->with('partido')
                        ->get();
        
        // Determinar el estado de la votación
        $puedeVotar = $eleccionActiva && !$votacion;
        
        return view('votacion', [
            'eleccion' => $eleccion,
            'candidatos' => $candidatos,
            'votacion' => $votacion,
            'puedeVotar' => $puedeVotar,
            'user' => $user,
        ]);
    }
    
    /**
     * Procesa y almacena el voto del usuario
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $user = Auth::user();        

        // Validar datos de entrada
        $validatedData = $request->validate([
            'id_eleccion' => 'required|exists:eleccion,id_eleccion',
            'id_candidato' => 'required|exists:candidato,id_candidato',
        ]);

        $id_eleccion = $validatedData['id_eleccion'];

        // Verificar si el usuario ya votó en esta elección
        $votacionExistente = Votacion::where('id_eleccion', $id_eleccion)
                                    ->where('id', $user->id)
                                    ->exists();

        if ($votacionExistente) {
            return redirect()->route('votar', ['id_eleccion' => $id_eleccion])
                             ->with('error', 'Ya has votado en esta elección.');
        }

        // Verificar si la elección está activa
        $eleccion = Eleccion::findOrFail($id_eleccion);
        $today = Carbon::now('America/La_Paz')->toDateString();
        if ($today < $eleccion->fecha_ini || $today > $eleccion->fecha_fin) {
            return redirect()->route('votar', ['id_eleccion' => $id_eleccion])
                             ->with('error', 'La elección no está activa en este momento.');
        }

        // Verificar si el candidato participa en esta elección
        $participaCandidato = DB::table('eleccion_candidato')
                                ->where('id_eleccion', $id_eleccion)
                                ->where('id_candidato', $validatedData['id_candidato'])
                                ->exists();

        if (!$participaCandidato) {
            return redirect()->route('votar', ['id_eleccion' => $id_eleccion])
                             ->with('error', 'El candidato seleccionado no participa en esta elección.');
        }

        $location = $request->location;

        // Crear nuevo registro de votación
        try {
            DB::beginTransaction();

            // Registrar el voto
            $votacion = Votacion::create([
                'fecha_hora' => Carbon::now('America/La_Paz'),
                'ubicacion' => $location, 
                'ip_origen' => $request->ip(),
                'id_eleccion' => $id_eleccion,
                'id' => $user->id,
                'id_candidato' => $validatedData['id_candidato']
            ]);

            // Crear el archivo JSON con la votación
            $votacionData = [
                'fecha_hora' => $votacion->fecha_hora,
                'ubicacion' => $votacion->ubicacion,
                'ip_origen' => $votacion->ip_origen,
                'id_eleccion' => $votacion->id_eleccion,
                'id_usuario' => $votacion->id,
                'id_candidato' => $votacion->id_candidato
            ];

            $jsonData = json_encode($votacionData);

            // Subir el archivo a IPFS
            $client = new Ipfs();
            $response = $client->add($jsonData);

            // Obtener el hash IPFS
            $ipfsHash = $response['Hash'];

            // Guardar el hash en la tabla de votaciones
            $votacion->update(['ipfs_hash' => $ipfsHash]);

            // Actualizar o crear entrada en la tabla de resultados
            $resultado = Resultado::where('id_eleccion', $id_eleccion)
                                   ->where('id_candidato', $validatedData['id_candidato'])
                                   ->first();

            if ($resultado) {
                $resultado->increment('votos');
            } else {
                Resultado::create([
                    'votos' => 1,
                    'id_eleccion' => $id_eleccion,
                    'id_candidato' => $validatedData['id_candidato'],
                ]);
            }

            DB::commit();

            return redirect()->route('votar', ['id_eleccion' => $id_eleccion])
                             ->with('success', '¡Tu voto ha sido registrado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('votar', ['id_eleccion' => $id_eleccion])
                             ->with('error', 'Ocurrió un error al procesar tu voto. Por favor, intenta nuevamente.');
        }
        

    }
}
