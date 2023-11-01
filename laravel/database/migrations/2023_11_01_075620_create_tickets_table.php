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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('showtime_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('price', 8, 2);
            $table->dateTime('purchased_at');
            $table->dateTime('used_at')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('showtime_id')->references('id')->on('showtimes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
