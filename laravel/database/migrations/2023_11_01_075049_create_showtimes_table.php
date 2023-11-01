<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->double('price')->default(0);
            $table->string('room')->nullable(true);
            $table->integer('limit')->default(50);
            $table->timestamps();
    
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
