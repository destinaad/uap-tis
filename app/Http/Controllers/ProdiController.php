<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth' diterapkan ke semua method di controller ini
        $this->middleware('auth');
    }

    public function index()
    {
        // Lihat semua data prodi
        $prodis = Prodi::all();
        return response()->json($prodis);
    }

    // Tambahan (tidak diminta tapi bagus ada untuk mengisi data)
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|unique:prodis',
        ]);

        $prodi = Prodi::create($request->all());

        return response()->json($prodi, 201);
    }
}