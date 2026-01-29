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
        Schema::create('semestres', function (Blueprint $table) {
            $table->id();
            $table->string("semestre", 50)->unique();
            $table->date("fecha_inicio");
            $table->date("fecha_fin")->nullable();
            $table->date("fecha_inicio_solicitud");
            $table->date("fecha_fin_solicitud")->nullable();
            $table->string('usercreacion', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestres');
    }
};
