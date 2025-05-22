<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daily_missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('mission_templates')->onDelete('cascade');
            $table->date('tanggal');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_missions');
    }
};
