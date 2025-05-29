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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_evento'); 
            $table->time('hora_evento'); 
            $table->integer('asistentes')->default(0);
            $table->string('estado');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('lugar_id')->unsigned();
            $table->foreign('lugar_id')->references("id")->on('lugars')->onDelete('cascade');
            $table->foreign('user_id')->references("id")->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
