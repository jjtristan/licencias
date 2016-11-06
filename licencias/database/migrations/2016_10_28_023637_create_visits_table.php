<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('license_id')->unsigned();
            $table->foreign('license_id')->references('id')->on('licenses');
            $table->date('date_visit');
            $table->string('sanctions');
            $table->boolean('act');
            $table->string('type_visit')->default('Paso');

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
        Schema::drop('visits');
    }
}
