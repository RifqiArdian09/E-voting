<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();       // NISN siswa
            $table->string('name');                // Nama siswa
            $table->string('class');               // Kelas (contoh: XII RPL 1)
            $table->string('major');               // Jurusan (contoh: PPLG)
            $table->string('token')->unique();     // Token login untuk memilih
            $table->boolean('has_voted')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
