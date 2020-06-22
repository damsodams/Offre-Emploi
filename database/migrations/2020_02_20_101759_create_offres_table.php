<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre', 250);
            $table->string('description', 500)->nullable();
            $table->string('intitule_poste');
            $table->enum('niveau', array ('BAC' , 'BTS' , 'Licence' , 'Autre'))->default('BAC');
            $table->string('pdf')->nullable();
            $table->string('salaire')->nullable();
            $table->string('secteur');
            $table->enum('type_contrat', array ('CDD' , 'CDI' , 'Contrat de professionnalisation' , "Contrat d apprentissage"))->default('CDD');
            $table->bigInteger('entreprise_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offres');
    }
}
