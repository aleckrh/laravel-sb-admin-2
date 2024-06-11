<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert(['level'    =>  'Admin']);
        DB::table('roles')->insert(['level'    =>  'Administrator']);
        DB::table('roles')->insert(['level'    =>  'General Manager']);
        DB::table('roles')->insert(['level'    =>  'Manager Teknik']);
        DB::table('roles')->insert(['level'    =>  'Pelapor']);
    }
}
