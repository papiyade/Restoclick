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
        Schema::table('commandes', function (Blueprint $table) {
            //
            $table->enum('mode_commande', ['à emporter', 'sur place'])->after('statut');
            $table->unsignedBigInteger('table_id')->nullable()->after('mode_commande');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
            $table->dropColumn('mode_commande');
            $table->dropForeign(['table_id']);
            $table->dropColumn('table_id');
        });
    }
};
