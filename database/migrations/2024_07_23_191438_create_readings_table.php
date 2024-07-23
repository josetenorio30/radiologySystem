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
        Schema::create('readings', function (Blueprint $table) {
            $table->id();
            $table->string('id_paciente');
            $table->string('id_orden');
            $table->unsignedBigInteger('user_id');
            $table->float('intensidad_media');
            $table->string('birads');
            $table->float('vol_agua');
            $table->float('vol_tot');
            $table->text('hallazgos');
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readings');
    }
};
