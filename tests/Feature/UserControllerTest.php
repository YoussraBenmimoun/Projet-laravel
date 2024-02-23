<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
        $response = $this->get('/users');

        $response->assertStatus(200);
    }
    // public function testStore()
    // {
    //     $userData = [
    //         'name' => 'John Doe',
    //         'email' => 'john@example.com',
    //         'password' => 'password',
    //     ];

    //     $response = $this->post('/users', $userData);

    //     $response->assertStatus(201);

    //     $this->assertDatabaseHas('users', $userData);
    // }
}
