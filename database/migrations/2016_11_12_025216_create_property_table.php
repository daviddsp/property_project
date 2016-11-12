<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('description', 50);
            $table->string('address',255);
            $table->string('town',50);
            $table->string('country',50);

            $table->foreign('state_id')
                ->references('id')->on('state');

            $table->integer('state_id');

            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->integer('user_id');
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
        Schema::drop('property');
    }
}