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
        Schema::table('tables', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();  // Ajout sans contrainte unique pour éviter les erreurs
        });

        // Remplir les UUID pour les enregistrements existants
        \App\Models\Table::whereNull('uuid')->get()->each(function ($table) {
            $table->uuid = (string) Str::uuid();
            $table->save();
        });

        // Maintenant ajouter la contrainte d'unicité
        Schema::table('tables', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }

};
