<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addfk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('offres', function (Blueprint $table) {
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
       
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
