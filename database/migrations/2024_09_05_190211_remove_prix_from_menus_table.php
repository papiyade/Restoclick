<?php
// database/migrations/xxxx_xx_xx_remove_prix_from_menus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePrixFromMenusTable extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('prix');
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->decimal('prix', 8, 2)->nullable();
        });
    }
}
