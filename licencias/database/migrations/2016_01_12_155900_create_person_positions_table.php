<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_positions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->timestamps();
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('person_positions')->insert(
            [
                'name' => 'Arquitecto',
                'created_at' => $now,
            ],
            [
                'name' => 'Ingeniero',
                'created_at' => $now,
            ],
            [
                'name' => 'Técnico ambiental',
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
        Schema::drop('person_positions');
    }
}
