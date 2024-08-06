<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogoAndSignatureToRestaurants extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->string('signature')->nullable();
        });
    }

    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->dropColumn('signature');
        });
    }
}
