<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Créer la table 'tables' si elle n'existe pas
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('numero_table')->unique();
            $table->string('qr_code')->nullable(); // QR code peut être ajouté ici ou plus tard
            $table->enum('statut', ['disponible', 'occupee'])->default('disponible');
            $table->timestamps();
            $table->uuid('uuid')->nullable();  // Ajout de l'UUID
        });

        // Remplir les UUID pour les enregistrements existants
        \App\Models\Table::whereNull('uuid')->get()->each(function ($table) {
            $table->uuid = (string) Str::uuid();
            $table->save();
        });

        // Maintenant ajouter la contrainte d'unicité sur l'UUID
        Schema::table('tables', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->change();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tables');
    }
};
