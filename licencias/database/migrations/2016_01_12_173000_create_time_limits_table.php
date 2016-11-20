<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_limits', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('weight');
            $table->integer('days');
            #JGT Se agregan los campos de codigo y nombre
            $table->string('name');
            $table->string('code');

            $table->timestamps();
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('time_limits')->insert(
            [
                'weight' => 1,
                'days' => 10,
                'name' => 'Tiempo alerta reparo',
                'code' => 'LTAR',
                'created_at' => $now,
            ],
            [
                'weight' => 2,
                'days' => 5,
                'name' => 'Tiempo alerta reparo N2',
                'code' => 'LTARN2',
                'created_at' => $now,
            ],
            [
                'weight' => 3,
                'days' => 20,
                'name' => 'Tiempo alerta plazo',
                'code' => 'LTAP',
                'created_at' => $now,
            ],
            [
                'weight' => 4,
                'days' => 5,
                'name' => 'Tiempo alerta información pública',
                'code' => 'LTAIP',
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
        Schema::drop('time_limits');
    }
}
