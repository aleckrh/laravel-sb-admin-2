<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiPelabuhan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelabuhans')->insert(['pelabuhan'    => 'Ketapang']);
        DB::table('pelabuhans')->insert(['pelabuhan'    => 'Gilimanuk']);
        DB::table('pelabuhans')->insert(['pelabuhan'    => 'Jangkar']);
    }
}
