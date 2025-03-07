<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;



class RegisterController2Test extends TestCase
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
	
	
    /**
    * @test
    *	
    */
/* 
    public function test_register_fails_with_empty_data()
    {
            
            //$response = $this->post(route('register'), []);
            $response = $this->post('/registro', []);

            $response->assertStatus(302); // Redirecci�n esperada
            $response->assertSessionHasErrors([
                'username', 
                'password', 
                'name', 
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
*/    
    
    
    public function test_register_fails_with_empty_data()
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
    
    
    
    
/*
    public function test_register_fails_with_empty_data()
    {
             
        
            $response = $this->post('/registro', []);
            $response->assertSessionHasErrors(['username', 'password', 'fullname']);
       
 
      
    }    
*/	
	
	
}//fin Class RegisterController2Test
