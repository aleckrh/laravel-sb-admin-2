<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Divisi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisis')->insert(['nama_divisi'  => 'Keuangan']);
        DB::table('divisis')->insert(['nama_divisi'  => 'IT']);
        DB::table('divisis')->insert(['nama_divisi'  => 'SDM dan SCM']);
        DB::table('divisis')->insert(['nama_divisi'  => 'Operasional / Usaha']);
        DB::table('divisis')->insert(['nama_divisi'  => 'DPA']);
        DB::table('divisis')->insert(['nama_divisi'  => 'Kapal']);
        DB::table('divisis')->insert(['nama_divisi'  => 'Teknik']);
    }
}
