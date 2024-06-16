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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('telephone_client');
            $table->enum('statut', ['en_cours', 'terminee', 'annulee']);
            $table->timestamps();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('restaurant_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
