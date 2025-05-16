<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mission_templates', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['read', 'quiz']);
            $table->text('deskripsi');
            $table->integer('jumlah_target'); // Misal: 3 buku / 2 kuis
            $table->integer('xp_reward');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mission_templates');
    }
};
