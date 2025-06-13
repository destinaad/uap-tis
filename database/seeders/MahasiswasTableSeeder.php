<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;                   

class MahasiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $tiProdiId = DB::table('prodis')->where('nama', 'Teknologi Informasi')->first()->id ?? null;
        $siProdiId = DB::table('prodis')->where('nama', 'Sistem Informasi')->first()->id ?? null;
        $ptiProdiId = DB::table('prodis')->where('nama', 'Pendidikan Teknologi Informasi')->first()->id ?? null;
        $tifProdiId = DB::table('prodis')->where('nama', 'Teknik Informatika')->first()->id ?? null;
        $tekkomProdiId = DB::table('prodis')->where('nama', 'Teknik Komputer')->first()->id ?? null;

        // Jika null, itu berarti seeder prodi belum berjalan atau nama prodi tidak cocok
        if (is_null($tiProdiId) || is_null($siProdiId) || is_null($ptiProdiId) || is_null($tifProdiId) || is_null($tekkomProdiId)) {
            $this->command->warn('Beberapa ID Prodi tidak ditemukan. Pastikan ProdisTableSeeder sudah dijalankan dan nama prodi sesuai.');
            return; // Hentikan seeding mahasiswa jika prodi tidak lengkap
        }

        // Masukkan data mahasiswa
        DB::table('mahasiswas')->insert([
            [
                'nim' => '2023001',
                'nama' => 'Budi Santoso',
                'angkatan' => 2023,
                'prodi_id' => $tiProdiId,
                'password' => Hash::make('rahasia1'), 
                'created_at' => Carbon::now(), // <-- Ganti now() dengan Carbon::now()
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '2023002',
                'nama' => 'Siti Aminah',
                'angkatan' => 2023,
                'prodi_id' => $siProdiId,
                'password' => Hash::make('rahasia2'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '2022003',
                'nama' => 'Joko Susilo',
                'angkatan' => 2022,
                'prodi_id' => $ptiProdiId,
                'password' => Hash::make('rahasia3'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '2022004',
                'nama' => 'Dewi Lestari',
                'angkatan' => 2022,
                'prodi_id' => $tifProdiId,
                'password' => Hash::make('rahasia4'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nim' => '2021005',
                'nama' => 'Cahyo Utomo',
                'angkatan' => 2021,
                'prodi_id' => $tekkomProdiId,
                'password' => Hash::make('rahasia5'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}