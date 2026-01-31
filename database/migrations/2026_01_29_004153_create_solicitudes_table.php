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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_solicitud')->unique();

            $table->foreignId('estudiantes_id')
                  ->constrained('estudiantes')
                  ->onDelete('cascade');

            $table->date('fecha_solicitud');
            $table->date('fecha_expedicion')->nullable();

            $table->foreignId("estados_id")
                    ->constrained("estados")
                    ->onDelete("cascade");

            $table->foreignId('vouchers_id')
                  ->constrained('vouchers')
                  ->onDelete('cascade');

            $table->foreignId("fotos_id")
                  ->constrained("fotos")
                  ->onDelete("cascade");

            $table->foreignId('semestres_id')
                  ->constrained('semestres')
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
        Schema::dropIfExists('solicitudes');
    }
};
