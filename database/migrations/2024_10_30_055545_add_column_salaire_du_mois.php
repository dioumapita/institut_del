<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSalaireDuMois extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement_enseignant', function (Blueprint $table) {
            //
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
        Schema::table('paiement_enseignant', function (Blueprint $table) {
            //
            $table->dropColumn('salaire_du_mois');
        });
    }
}
