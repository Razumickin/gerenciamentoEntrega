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
            $table->integer ('volume');

            $table->unsignedBigInteger('transportadora_id');
            $table->foreign('transportadora_id')->references('id')->on('transportadoras');

            $table->unsignedBigInteger('remetente_id');
            $table->foreign('remetente_id')->references('id')->on('remetentes');

            $table->unsignedBigInteger('destinatario_id');
            $table->foreign('destinatario_id')->references('id')->on('destinatarios');
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
