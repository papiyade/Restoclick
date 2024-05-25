<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('reservations', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('client_id')->nullable();
    //         $table->unsignedBigInteger('table_id')->nullable();
    //         $table->string('client_name');
    //         $table->string('client_phone_number');
    //         $table->dateTime('date_time');
    //         $table->integer('num_people');
    //         $table->dateTime('date_heure');
    //         $table->timestamps();

    //         $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
    //         $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
    //     });
    // }
    public function up(): void
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('client_id')->nullable(); // facultatif si vous voulez associer à un utilisateur
        $table->string('client_name');
        $table->string('client_phone_number');
        $table->dateTime('date_time');
        $table->integer('num_people');
        $table->unsignedBigInteger('restaurant_id');
        $table->timestamps();

        // Foreign keys
        $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
