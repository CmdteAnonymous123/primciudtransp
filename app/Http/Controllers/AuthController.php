<?php
namespace App\Http\Controllers;
use App\Models\Pregunta;

header('Content-Type: text/html; charset=UTF-8');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar la vista de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Mostrar la vista de registro
    public function showRegister()
    {
        $preguntas = Pregunta::inRandomOrder()->limit(3)->get();
        //return view('auth.registro');
        return view('auth.registro', compact('preguntas'));
    }
/*  //ESTO LO VA A MANEJAR POR API API\REGISTERCONTROLER.PHP
    // Procesar registro de usuario
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users', // Ahora es opcional
            'password' => 'required|string|min:6|confirmed',
            'cedula' => 'required|string|max:255|unique:users', 
            'lugar_emision' => 'required|in:SC,LP,OR,CB,TA,BE,PA,CH,PO',            
            'fecha_nac' => ['required', 'regex:/^\d{2}\/\d{2}\/\d{4}$/'],
            'ubicacion' => 'required|string',
            'pregunta_1' => 'required|string',
            'pregunta_2' => 'required|string',
            'pregunta_3' => 'required|string',
        ]);
        
        $fechaFormatoDB = \DateTime::createFromFormat('d/m/Y', $request->fecha_nac)->format('Y-m-d');


        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email, // Puede ser null
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'lugar_emision' => $request->lugar_emision,
            'fecha_nac' => $fechaFormatoDB,
            'ubicacion' => $request->ubicacion,
            'pregunta_1' => $request->pregunta_1,
            'pregunta_2' => $request->pregunta_2,
            'pregunta_3' => $request->pregunta_3,
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado con éxito. Ahora puede iniciar sesión.');
    }
 * 
 */

    // Procesar login de usuario
    public function login(Request $request)
    {
        
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['username' => 'Credenciales incorrectas'])->withInput();
        }
    
        return redirect()->route('dashboard');
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
