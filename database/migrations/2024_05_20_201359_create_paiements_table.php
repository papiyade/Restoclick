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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->decimal('montant', 8, 2);
            $table->dateTime('date_heure');
            $table->enum('mode_paiement', ['carte_credit', 'wave', 'om', 'especes']);
            $table->timestamps();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->boolean('same_address')->default(false);
            $table->boolean('save_info')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('cc_name')->nullable();
            $table->string('cc_number')->nullable();
            $table->string('cc_expiration')->nullable();
            $table->string('cc_cvv')->nullable();

            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'username', 'email', 'address', 'address2',
                'country', 'state', 'zip', 'same_address', 'save_info', 'payment_method',
                'cc_name', 'cc_number', 'cc_expiration', 'cc_cvv'
            ]);
        });
    }
};
