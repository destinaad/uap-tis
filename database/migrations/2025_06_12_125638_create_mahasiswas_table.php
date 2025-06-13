<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim')->primary(); // NIM sebagai PK, tipe datanya string
            $table->string('nama');
            $table->integer('angkatan');
            $table->unsignedBigInteger('prodi_id'); // Foreign Key ke tabel prodis
            $table->string('password'); // Untuk password
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
