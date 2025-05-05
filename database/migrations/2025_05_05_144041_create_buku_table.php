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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->char('judul')->nullable();
            $table->char('pengarang')->nullable();
            $table->char('sinopsis');
            $table->unsignedBigInteger('id_genre');
            $table->foreign('id_genre')->references('id')->on('genre');
            $table->char('cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
