<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class ProdisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('prodis')->insert([
            ['nama' => 'Teknologi Informasi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'Sistem Informasi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'Pendidikan Teknologi Informasi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'Teknik Informatika', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'Teknik Komputer', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}