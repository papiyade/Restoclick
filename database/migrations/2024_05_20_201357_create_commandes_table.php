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
            // $table->unsignedBigInteger('client_id');
            // $table->unsignedBigInteger('serveur_id');
            // $table->unsignedBigInteger('table_id');
            $table->enum('statut', ['en_cours', 'terminee', 'annulee']);
            $table->timestamps();

            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('serveur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade');



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
