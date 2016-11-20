<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('description');
            $table->boolean('visit');

            $table->timestamps();
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('license_types')->insert(
            [
                'name' => 'Declaración responsable - Actividades inocuas',
                'description' => '',
                'visit' => false,
                'created_at' => $now,
            ],
            [
                'name' => 'Declaración responsable - Actividades no inocuas',
                'description' => '',
                'visit' => false,
                'created_at' => $now,
            ],
            [
                'name' => 'Licencias de actividad',
                'description' => '',
                'visit' => true,
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
        Schema::drop('license_types');
    }
}
