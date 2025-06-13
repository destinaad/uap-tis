<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'nim' => 'required|string|unique:mahasiswas',
            'nama' => 'required|string',
            'angkatan' => 'required|integer',
            'prodi_id' => 'required|exists:prodis,id', // Pastikan prodi_id ada di tabel prodis
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $request->input('nim');
            $mahasiswa->nama = $request->input('nama');
            $mahasiswa->angkatan = $request->input('angkatan');
            $mahasiswa->prodi_id = $request->input('prodi_id');
            $mahasiswa->password = Hash::make($request->input('password')); // Enkripsi password
            $mahasiswa->save();

            // Generate token untuk mahasiswa yang baru daftar (opsional)
            $token = JWTAuth::fromUser($mahasiswa);

            return response()->json([
                'message' => 'Mahasiswa berhasil didaftarkan!',
                'user' => $mahasiswa,
                'token' => $token,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registrasi gagal!', 'error' => $e->getMessage()], 409); // 409 Conflict
        }
    }

    public function login(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['nim', 'password']);

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'NIM atau Password salah!'], 401); // 401 Unauthorized
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'Gagal membuat token!'], 500); // 500 Internal Server Error
        }

        return response()->json([
            'message' => 'Login berhasil!',
            'token' => $token,
            'user' => JWTAuth::user() // Mengambil data user yang sedang login
        ]);
    }

    public function me()
    {
        // Endpoint untuk mendapatkan data user yang sedang login
        return response()->json(auth()->user());
    }
}