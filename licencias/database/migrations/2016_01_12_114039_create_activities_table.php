<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->timestamps();
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('activities')->insert(
            [
                'name' => 'Bar',
                'created_at' => $now,
            ],
            [
                'name' => 'Industria',
                'created_at' => $now,
            ],
            [
                'name' => 'Academia',
                'created_at' => $now,
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
    }
}
