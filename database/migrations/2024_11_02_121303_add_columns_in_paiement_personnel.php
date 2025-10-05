<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInPaiementPersonnel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement_personnel', function (Blueprint $table) {
            //
            $table->integer('mois_paiement')->nullable();
            $table->integer('salaire_du_mois')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_personnel', function (Blueprint $table) {
            //
            $table->dropColumn(['mois_paiement','salaire_du_mois']);
        });
    }
}
