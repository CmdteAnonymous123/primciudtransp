<?php
namespace App\Http\Controllers\Api;
header('Content-Type: text/html; charset=UTF-8');
use App\Http\Controllers\Controller;
use App\Models\User;
use Doctrine\ORM\EntityManagerInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
            'fecha_nac' => 'required|date_format:d/m/Y',
            'ci' => 'required|string|max:50|unique:App\Models\User,cedula',
            'lugar_emision' => 'required|string|max:2',
            'pregunta_1' => 'required|string',
            'pregunta_2' => 'required|string',
            'pregunta_3' => 'required|string',
            'location' => 'nullable|string'
        ]);

        // Convertir fecha a formato SQL (YYYY-MM-DD)
        $fecha_nac = \DateTime::createFromFormat('d/m/Y', $data['fecha_nac']);

        // Crear usuario
        $user = new User();
        $user->setUsername($data['username']);
        $user->setName($data['fullname']);
        $user->setCedula($data['ci']);
        //$user->setFechaNac($fecha_nac ? $fecha_nac->format('Y-m-d') : null);
        $user->setFechaNac($fecha_nac);
        $user->setLugarEmision($data['lugar_emision']);
        $user->setPassword(Hash::make($data['password']));

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
    
    
    
}

