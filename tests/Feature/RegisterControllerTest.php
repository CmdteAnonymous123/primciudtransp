<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use \App\Models\User;


class RegisterControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     *
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    */
    
    
    public function test_register_fails_with_empty_data0()
    {
        $response = $this->post('/registro', []);

        $response->assertSessionHasErrors([
            'username', 
            'password', 
            'fullname', 
            'fecha_nac', 
            'ci', 
            'lugar_emision', 
            'pregunta_1', 
            'pregunta_2', 
            'pregunta_3',
            'id_pregunta_1', 
            'id_pregunta_2', 
            'id_pregunta_3'
        ]);
    }    



    protected function setUp(): void
    {
        parent::setUp();
        
        // Configura un canal de log específico para tests
        config([
            'logging.channels.test_logs' => [
                'driver' => 'daily',
                'path' => storage_path('logs/tests.log'),
                'level' => 'debug',
                'days' => 14,
            ]
        ]);
    }
    
    
    public function test_register_fails_with_empty_data1()
    {
        try 
        {
            // Registra el inicio del test
            Log::channel('test_logs')->info('Empezando test_register_fails_with_empty_data1', [
                'timestamp' => now()->toDateTimeString(),
                'test_method' => $this->getName()
            ]);

            // Realiza la solicitud de registro con datos vacíos
            $response = $this->post('/registro', []);
            
            Log::channel('test_logs')->debug('Session errors:', [
                'errors' => session('errors')->getBag('default')->all()
            ]);            

            // Registra los detalles de la respuesta
            Log::channel('test_logs')->debug('Registration response details', [
                'status_code' => $response->getStatusCode(),
                'content' => $response->getContent()
            ]);

            // Verifica errores de sesión
            try {
                // Actualiza los campos para que coincidan con tu controlador
                $response->assertSessionHasErrors([
                    'username', 
                    'password', 
                    'fullname', 
                    'fecha_nac', 
                    'ci', 
                    'lugar_emision', 
                    'pregunta_1', 
                    'pregunta_2', 
                    'pregunta_3',
                    'id_pregunta_1', 
                    'id_pregunta_2', 
                    'id_pregunta_3'
                ]);
                
                

                Log::channel('test_logs')->info('Session validation passed');
                
            } catch (\PHPUnit\Framework\AssertionFailedError $e) {
                Log::channel('test_logs')->error('Session validation failed', [
                    'error_message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (\Exception $e) {
            // Registra cualquier excepción inesperada
            Log::channel('test_logs')->critical('Unexpected error in test', [
                'error_type' => get_class($e),
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        } finally {
            // Registra la finalización del test
            Log::channel('test_logs')->info('Aquí termina test_register_fails_with_empty_data');
        }
    }

    
    
    
    
/*
    public function test_register_fails_with_empty_data()
    {
        
        $logFile = storage_path('logs/tests.log');
        
        
        try {
            $response = $this->post('/register', []);
            $response->assertSessionHasErrors(['username', 'password', 'fullname']);
       
        } catch (\Exception $e) {
            file_put_contents($logFile, "Error: " . $e->getMessage() . "\n", FILE_APPEND);      
        }  
      
    } 
  */  
    
/*     
    public function test_register_fails_with_duplicate_username()
    {
        User::factory()->create(['username' => 'mrmustard123']); // Usuario ya existente

        User::factory()->create([
            'username' => 'mrmustard123',
            'cedula' => '12345678',  // Asegúrate de que sea único
            'name' => 'Mr Mustard',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/registro', [
            'username' => 'mrmustard123', // Mismo usuario
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'fullname' => 'Juan Pérez',
            'fecha_nac' => '2000-05-10',
            'ci' => '12345678',
            'lugar_emision' => 'SC',
            'pregunta_1' => 'respuesta1',
            'pregunta_2' => 'respuesta2',
            'pregunta_3' => 'respuesta3',
            'id_pregunta_1' => 1,
            'id_pregunta_2' => 2,
            'id_pregunta_3' => 3
        ]);
        
        $response->assertSessionHasErrors(['username']);
  
    }//end test_register_fails_with_duplicate_username
    
*/    
    
    
    public function test_register_fails_with_duplicate_username()
    {
        try {
            // Intentar crear el usuario
            $user = User::factory()->create([
                'username' => 'mrmustard123',
                'cedula' => '12345678',
                'name' => 'Mr Mustard',
                'password' => bcrypt('password123')
            ]);

            echo "Usuario creado con ID: " . $user->id . "\n";

            // Resto del test...
            $response = $this->post('/registro', [
                'username' => 'mrmustard123',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'fullname' => 'Juan Pérez',
                'fecha_nac' => '2000-05-10',
                'ci' => '12345678',
                'lugar_emision' => 'SC',
                'pregunta_1' => 'respuesta1',
                'pregunta_2' => 'respuesta2',
                'pregunta_3' => 'respuesta3',
                'id_pregunta_1' => 1,
                'id_pregunta_2' => 2,
                'id_pregunta_3' => 3
            ]);

            echo "Respuesta recibida con código: " . $response->status() . "\n";

            $response->assertSessionHasErrors(['username']);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }        
       
    

    public function test_register_fails_with_invalid_date_format()
    {
        $response = $this->post('/registro', [
            'username' => 'usuarioNuevo',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'fullname' => 'Juan Pérez',
            'fecha_nac' => '10-05-2000', // Formato incorrecto (debería ser Y-m-d)
            'ci' => '987654321',
            'lugar_emision' => 'SC',
            'pregunta_1' => 'respuesta1',
            'pregunta_2' => 'respuesta2',
            'pregunta_3' => 'respuesta3',
            'id_pregunta_1' => 1,
            'id_pregunta_2' => 2,
            'id_pregunta_3' => 3
        ]);

        $response->assertSessionHasErrors(['fecha_nac']);
    }
    



    public function test_register_fails_with_invalid_location()
    {
        $response = $this->post('/registro', [
            'username' => 'usuarioNuevo',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'fullname' => 'Juan Pérez',
            'fecha_nac' => '2000-05-10',
            'ci' => '12345678' . time(), // Agregamos time() para hacerlo único            
            'lugar_emision' => 'SC',
            'location' => '-33.8688,151.2093', // Coordenadas de Australia
            'pregunta_1' => 'respuesta1',
            'pregunta_2' => 'respuesta2',
            'pregunta_3' => 'respuesta3',
            'id_pregunta_1' => 1,
            'id_pregunta_2' => 2,
            'id_pregunta_3' => 3            
        ]);
        
        // Depurar la respuesta
        /*
        $errors = session('errors')->getBag('default')->all();
        dd($errors); // Esto mostrará todos los errores de validación        
        */
        $response->assertSessionHasErrors(['location']);
    }


    
    
    
}//fin
