<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleccion;
use App\Models\User;
use App\Models\Votacion;

class DashboardController extends Controller
{
    public function index()
    {
        //Obtener los datos de las elecciones
        $elecciones = Eleccion::all(); 
      
        // Obtener los datos del usuario autenticado
        $usuario = auth()->user(); 
        
        // Obtener las votaciones del usuario
        //$votaciones = Votacion::where('id', $usuario->id)->get();  
        
        //Obtiene solo los id_eleccion en un array
        $votaciones = Votacion::where('id', $usuario->id)->pluck('id_eleccion')->toArray(); 

        // Pasar tanto las elecciones como el usuario a la vista
        return view('dashboard', compact('elecciones', 'votaciones' ,'usuario'));        
        
        
        
    }
}
