<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_statuses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 100);
            $table->boolean('initial')->nullable()->default(null);
            $table->boolean('reopen')->nullable()->default(null);
            $table->boolean('identifier')->nullable()->default(null);
            $table->boolean('success')->nullable()->default(null);
            $table->boolean('reject')->nullable()->default(null);
            

            $table->timestamps();
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('license_statuses')->insert(
            [
                'name' => 'Solicitada',
                'initial' => TRUE,
                'reopen' => FALSE,
                'identifier' => FALSE,
                'success' => FALSE,
                'reject' => FALSE,
                'created_at' => $now,
            ],
            [
                'name' => 'Modificada',
                'initial' => FALSE,
                'reopen' => TRUE,
                'identifier' => FALSE,
                'success' => FALSE,
                'reject' => FALSE,
                'created_at' => $now,
            ],
            [
                'name' => 'Concedida',
                'initial' => FALSE,
                'reopen' => FALSE,
                'identifier' => TRUE,
                'success' => TRUE,
                'reject' => FALSE,
                'created_at' => $now,
            ],
            [
                'name' => 'Caducada',
                'initial' => FALSE,
                'reopen' => FALSE,
                'identifier' => FALSE,
                'success' => TRUE,
                'reject' => FALSE,
                'created_at' => $now,
            ],
            [
                'name' => 'Denegada',
                'initial' => FALSE,
                'reopen' => FALSE,
                'identifier' => FALSE,
                'success' => FALSE,
                'reject' => TRUE,
                'created_at' => $now,
            ],
            [
                'name' => 'Desistida',
                'initial' => FALSE,
                'reopen' => FALSE,
                'identifier' => FALSE,
                'success' => FALSE,
                'reject' => TRUE,
                'created_at' => $now,
            ],
            [
                'name' => 'Renuncia',
                'initial' => FALSE,
                'reopen' => FALSE,
                'identifier' => FALSE,
                'success' => FALSE,
                'reject' => TRUE,
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
        Schema::drop('license_statuses');
    }
}
