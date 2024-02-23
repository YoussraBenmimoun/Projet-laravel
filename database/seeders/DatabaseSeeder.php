<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = [
            ['nom' => 'Entrée', 'image' => 'images/63XXVMyGtl5XCcihcMnlmutr03EYZILpVNGLCW6S.jpg'],
            ['nom' => 'Plat', 'image' => 'images/recipe-big1-23.jpg'],
            ['nom' => 'Dessert', 'image' => 'images/xQSyjWfEsaKaxJUvAbeKKGNZ4jatQRQT2ZTwRY0G.jpg'], 
            ['nom' => 'Petit Plaisir', 'image' => 'images/recipe-big1-3.jpg'], 
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123456789',
            'usertype' => 0,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => '123456789',
            'usertype' => 1,
        ]);
    }
}
