<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    
    public function testIndex()
    {
        
        User::create([
            'name' => 'Allali Ali',
            'email' => 'ali@example.com',
            'password' => Hash::make('password'),
            'usertype' => 1, 
        ]);

        
        $response = $this->get('/users');

        
        $response->assertStatus(200);

        
        $response->assertViewHas('users');
    }

    /**
     * Test the store method of UserController.
     */
    public function testStore()
    {
      
        $userData = [
            'name' => 'Allali Ali',
            'email' => 'ali@example.com',
            'password' => 'password',
            'usertype' => 1
        ];

        
        $response = $this->post('/users', $userData);

        
        $response->assertStatus(302);

        
        $this->assertDatabaseHas('users', [
            'name' => 'Allali Ali',
            'email' => 'ali@example.com',
        ]);
    }
}
    

