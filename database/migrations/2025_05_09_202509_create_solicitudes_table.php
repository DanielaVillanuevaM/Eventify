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
            $table->string('estado')->default('pendiente');
            $table->bigInteger('evento_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('evento_id')->references("id")->on('eventos')->onDelete('cascade');
            $table->foreign('usuario_id')->references("id")->on('users')->onDelete('cascade');
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
