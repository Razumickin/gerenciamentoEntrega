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
        Schema::create('rastreamentos', function (Blueprint $table) {
            $table->id();
            $table->string('mensagem');
            $table->dateTimeTz('data');

            $table->string('entrega_id');
            $table->foreign('entrega_id')->references('entrega_id')->on('entregas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rastreamentos');
    }
};
