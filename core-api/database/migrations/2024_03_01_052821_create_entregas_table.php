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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('entrega_id')->unique();
            $table->integer ('volumes');
            $table->string('remetente');

            $table->string('transportadora_id');
            $table->foreign('transportadora_id')->references('transportadora_id')->on('transportadoras');

            $table->string('destinatario_cpf');
            $table->foreign('destinatario_cpf')->references('cpf')->on('destinatarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
