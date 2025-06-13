<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi; // Pastikan model Prodi diimport
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth' diterapkan ke semua method di controller ini
        // kecuali 'index' dan 'show' jika kamu mau membuat public
        $this->middleware('auth');
    }

    public function index()
    {
        // Lihat semua mahasiswa beserta info prodi
        $mahasiswas = Mahasiswa::with('prodi')->get(); // 'prodi' adalah nama fungsi relasi di model Mahasiswa
        return response()->json($mahasiswas);
    }

    public function show($nim)
    {
        // Lihat detail mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::with('prodi')->where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan!'], 404);
        }

        return response()->json($mahasiswa);
    }

    public function filterByProdi($prodi_id)
    {
        // Filter mahasiswa berdasarkan ID prodi
        $prodi = Prodi::find($prodi_id);

        if (!$prodi) {
            return response()->json(['message' => 'Prodi tidak ditemukan!'], 404);
        }

        $mahasiswas = $prodi->mahasiswas()->with('prodi')->get();
        // Atau bisa juga: Mahasiswa::where('prodi_id', $prodi_id)->with('prodi')->get();

        return response()->json($mahasiswas);
    }
}