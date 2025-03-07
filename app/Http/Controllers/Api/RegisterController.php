<?php
//namespace app\Http\Controllers\Api; //Asi cumple con el standard psr-4, que se yo...
namespace App\Http\Controllers\Api;

header('Content-Type: text/html; charset=UTF-8');
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Pregunta;
use App\Models\Extranjeros;



class RegisterController extends Controller
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function register(Request $request)
    {
        // Validación
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:App\Models\User,username',
            'password' => 'required|string|min:6|confirmed',
            'fullname' => 'required|string|max:255',
            'fecha_nac' => 'required|date_format:Y-m-d',
            'ci' => 'required|string|max:50|unique:App\Models\User,cedula',
            'lugar_emision' => 'required|string|max:2',
            'pregunta_1' => 'required|string',
            'pregunta_2' => 'required|string',
            'pregunta_3' => 'required|string',
            'id_pregunta_1' => 'required|integer|exists:pregunta,id_pregunta',
            'id_pregunta_2' => 'required|integer|exists:pregunta,id_pregunta',
            'id_pregunta_3' => 'required|integer|exists:pregunta,id_pregunta',
            'location' => 'nullable|string'
        ]);
        
        // Validar ubicación
        if (!empty($data['location'])) {
            $coordenadas = explode(',', $data['location']); //ej. -17.7834,-63.1822
            $latitude=$coordenadas[0];
            $longitude=$coordenadas[1];
            $isInBolivia = $this->validateLocationWithinBolivia($latitude,$longitude);
            if (!$isInBolivia) {
                                
                
                $pais = $data['location'];

                // Buscar si ya existe el país en la tabla Extranjeros                
                             
                /*Forma Doctrine 3*/
                $extranjero = $this->entityManager->getRepository('App\Models\Extranjeros')->findOneBy(array('pais' => $pais));
                
                /*forma Eloquent
                $extranjero = Extranjeros::where('pais', $pais)->first(); */
                                                
                
                if (is_null($extranjero)) {
                   // Si no existe, crear un nuevo registro
                    /**Forma Doctrine 3 **/
                    $fecha_actual = now();
                    $extranjero = new Extranjeros();
                    $extranjero->setPais($pais);
                    $extranjero->setVotos(1);
                    $extranjero->setCreatedAtCustom($fecha_actual);
                    $extranjero->setUpdatedAtCustom($fecha_actual);
                    $this->entityManager->persist($extranjero);
                    $this->entityManager->flush();                     

                    
                    /**Forma Eloquent**
                    
                    Extranjeros::create([
                        'pais' => $pais,
                        'votos' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);     */                                                       

                } else {
                    
                    // Si ya existe, aumentar el conteo de votos

                    /**Forma Doctrine 3 **/
                    $votos = $extranjero->getVotos();                    
                    $extranjero->setVotos($votos+1);
                    $this->entityManager->flush();    
                    
                    /**Forma Eloquent **
                    $extranjero->votos += 1;
                    $extranjero->save();       */             
                      
                }                              
                                              
                
                return back()->withErrors(['location' => 'La ubicación debe estar dentro de Bolivia.']);
            }
        }

        // Verificar respuestas de seguridad
        $preguntasRespondidas = [
            $data['id_pregunta_1'] => $data['pregunta_1'],
            $data['id_pregunta_2'] => $data['pregunta_2'],
            $data['id_pregunta_3'] => $data['pregunta_3'],
        ];      
        
        foreach ($preguntasRespondidas as $id => $respuesta) {
            $pregunta = Pregunta::find($id);
            if (!$pregunta || $pregunta->respuesta !== $respuesta) {
                return back()->withErrors(['pregunta_' . $id => 'Respuesta incorrecta']);
            }
        }        
        

        $fecha_nac = \DateTime::createFromFormat('Y-m-d', $data['fecha_nac']);

        // Crear usuario
        $user = new User();
        $user->setUsername($data['username']);
        $user->setName($data['fullname']);
        $user->setCedula($data['ci']);
        $user->setFechaNac($fecha_nac);
        $user->setLugarEmision($data['lugar_emision']);
        $user->setPassword(Hash::make($data['password']));
        $user->setLocation($data['location']);        
        $created_at = new \DateTime();
        $updated_at = new \DateTime();
        $user->setCreatedAtCustom($created_at);
        $user->setUpdatedAtCustom($updated_at);        

        // Guardar en la BD con Doctrine
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        //return response()->json(['message' => 'Registro exitoso'], 201);
        return redirect()->route('login')->with('success', 'Usuario registrado con éxito. Ahora puede iniciar sesión.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }    


    private function validateLocationWithinBolivia($latitude, $longitude)
    {
        // Ruta al archivo GeoJSON
        $geoJsonPath = storage_path('app/geo/bolivia-detailed-boundary_866.geojson');

        // Cargar el contenido
        $geoJsonData = file_get_contents($geoJsonPath);
        $jsonDecoded = json_decode($geoJsonData, true);

        // Extraer las coordenadas del polígono
        $coordinates = $jsonDecoded['features'][0]['geometry']['coordinates'][0];

        // Verificar si el punto está dentro del polígono usando el algoritmo "ray casting"
        $return = $this->pointInPolygon([$longitude, $latitude], $coordinates);
        return $return;
    }

    private function pointInPolygon($point, $polygon)
    {
        // Algoritmo "ray casting" para determinar si un punto está dentro de un polígono
        $x = $point[0];
        $y = $point[1];
        $inside = false;

        $j = count($polygon) - 1;

        for ($i = 0; $i < count($polygon); $i++) {
            $xi = $polygon[$i][0];
            $yi = $polygon[$i][1];
            $xj = $polygon[$j][0];
            $yj = $polygon[$j][1];

            $intersect = (($yi > $y) != ($yj > $y)) && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) {
                $inside = !$inside;
            }

            $j = $i;
        }

        return $inside;
    }   
           
}//end class Users
                            

