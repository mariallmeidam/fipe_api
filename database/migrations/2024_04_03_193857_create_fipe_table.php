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
        Schema::create('fipe', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_fipe',20);
            $table->string('referencia_mes', 40);
            $table->unsignedBigInteger('ano_id');
            $table->foreign('ano_id')->references('id')->on('ano');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fipe');
    }
};
