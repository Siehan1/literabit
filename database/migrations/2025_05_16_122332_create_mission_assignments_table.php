<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mission_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_mission_id')->constrained()->onDelete('cascade');
            $table->foreignId('template_id')->constrained('mission_templates')->onDelete('cascade');
            $table->integer('jumlah_selesai')->default(0);
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mission_assignments');
    }
};
