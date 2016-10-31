<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objections', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('license_current_stage_id')->unsigned();
            $table->foreign('license_current_stage_id')->references('id')->on('licenses');
            $table->integer('license_id')->unsigned();
            $table->foreign('license_id')->references('id')->on('licenses');

            $table->integer('license_stage_id')->unsigned();

            $table->integer('first_person_position_id')->unsigned()->nullable();

            $table->integer('second_person_position_id')
              ->unsigned()
              ->nullable();

            $table->date('report_date')->nullable();

            $table->date('correction_date')->nullable();

            $table->integer('file_id')->unsigned()->nullable();

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
        Schema::drop('objections');
    }
}
