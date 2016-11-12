<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProperiesFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properies_facilities', function (Blueprint $table) {

            $table->increments('id');
            $table->foreign('id_property')
                ->references('id')->on('property');
            $table->integer('id_property');

            $table->foreign('id_facility')
                ->references('id')->on('facilities');
            $table->integer('id_facility');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('properies_facilities');
    }
}
