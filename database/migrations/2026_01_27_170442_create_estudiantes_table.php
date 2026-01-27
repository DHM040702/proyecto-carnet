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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_estudiante', 12)->unique();
            $table->date('creado en');
            $table->string('correo')->unique();
            //Claves foraneas
            $table->foreignId('persona_id')
                  ->constrained('personas')
                  ->onDelete('cascade');

            $table->foreignId('escuela_id')
                  ->constrained('escuelas')
                  ->onDelete('cascade');

            $table->foreignId('matricula_id')
                  ->constrained('matriculas')
                  ->onDelete('cascade');

            $table->string('usercreacion', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
