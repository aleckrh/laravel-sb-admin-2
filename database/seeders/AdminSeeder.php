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
                'name'          =>  'Super',
                'last_name'     =>  'Admin',
                'level'         =>  1,
                'telp'          =>  '082182133457',
                'email'         =>  'admin@gmail.com',
                'password'      =>   bcrypt('admin123456'),
        ]);
        DB::table('users')->insert([
                'name'          =>  'Rusdi',
                'last_name'     =>  'Salim',
                'level'         =>  2,
                'telp'          =>  '082182133457',
                'email'         =>  'rusdi@gmail.com',
                'password'      =>   bcrypt('123'),
        ]);
        DB::table('users')->insert([
            'name'          =>  'Faiz',
            'last_name'     =>  'Mandraguno',
            'level'         =>  3,
            'telp'          =>  '082182133457',
            'email'         =>  'faiz@gmail.com',
            'password'      =>   bcrypt('123'),
        ]);
        DB::table('users')->insert([
            'name'          =>  'Harjanto',
            'last_name'     =>  'Surya',
            'level'         =>  4,
            'telp'          =>  '082182133457',
            'email'         =>  'harjanto@gmail.com',
            'password'      =>   bcrypt('123'),
        ]);
        DB::table('users')->insert([
            'name'          =>  'Wisnu',
            'last_name'     =>  'Aditya',
            'level'         =>  5,
            'telp'          =>  '082182133457',
            'email'         =>  'wisnu@gmail.com',
            'password'      =>   bcrypt('123'),
        ]);
    }
}
