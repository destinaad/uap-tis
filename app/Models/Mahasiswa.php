<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject; 

// Pastikan kelas mengimplementasikan JWTSubject
class Mahasiswa extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    // Jika primary key bukan 'id', harus didefinisikan
    protected $primaryKey = 'nim';
    public $incrementing = false; // Karena NIM bukan auto-increment integer
    protected $keyType = 'string'; // Karena NIM adalah string

    protected $fillable = [
        'nim', 'nama', 'angkatan', 'prodi_id', 'password',
    ];

    protected $hidden = [
        'password', // Jangan tampilkan password saat mengambil data
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    // --- Metode Wajib untuk JWTSubject ---

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Mengembalikan NIM sebagai identifier JWT
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // Untuk sekarang, kita bisa biarkan kosong
    }

    // --- Akhir Metode JWTSubject ---
}