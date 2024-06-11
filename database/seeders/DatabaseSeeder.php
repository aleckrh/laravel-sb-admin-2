<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            Divisi::class,
            RoleTableSeeder::class,
            LokasiPelabuhan::class,
            AdminSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //  \App\Models\User::factory()->create([
        //      'name' => 'John',
        //      'last_name' => 'Doe',
        //      'password' => 'password',
        //      'email' => 'test@example.com',
        //  ]);
    }
}
