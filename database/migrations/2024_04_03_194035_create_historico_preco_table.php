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
        Schema::create('historico_preco', function (Blueprint $table) {
            $table->id();
            $table->string('mes', 40);
            $table->decimal('preco');
            $table->string('referencia', 20);
            $table->unsignedBigInteger('fipe_id');
            $table->foreign('fipe_id')->references('id')->on('fipe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_preco');
    }
};
