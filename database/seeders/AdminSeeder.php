<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'          =>  'Admin',
            'last_name'     =>  'Admin',
            'level'         =>  'Admin',
            'telp'          =>  '082182133457',
            'email'         =>  'admin@admin.com',
            'password'      =>  bcrypt('admin123456'),
        ]);
    }
}
