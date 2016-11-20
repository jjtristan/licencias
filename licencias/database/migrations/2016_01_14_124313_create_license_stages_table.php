<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_stages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->boolean('date');
            $table->boolean('date_required')->default(false);
            $table->boolean('person');
            $table->boolean('person_required')->default(false);
            $table->boolean('number');
            $table->boolean('number_required')->default(false);
            $table->boolean('file');
            $table->boolean('file_required')->default(false);
            $table->boolean('objection');
            $table->boolean('objection_required')->default(false);
            $table->boolean('optional')->default(false);
            $table->integer('person_position_id')->nullable();
            #JGT: Se agregan los campos para las modificaciones
            $table->boolean('proceeds_visit')->default(false);
            $table->boolean('date_firsh_visit');

            $table->timestamps();
        });
        $now = date('Y-m-d H:i:s');
        \DB::table('license_stages')->insert(
            [
                'name' => 'Encargo Informe Urbanismo',
                'date' => true,
                'date_required' => true,
                'person' => true,
                'person_required' => true,
                'number' => false,
                'file' => false,
                'objection' => true,
                'objection_required' => false,
                'person_position_id' => 1,
                'created_at' => $now,
            ],
            // id = 2
            [
                'name' => 'Informe Urbanístico',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'file_required' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 3
            [
                'name' => 'Adminisión Trámite',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 4
            [
                'name' => 'Edicto Remisión',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 5
            [
                'name' => 'Edicto Recepción',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 6
            [
                'name' => 'Informe Alegaciones',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => true,
                'number_required' => true,
                'file' => false,
                'file_required' => false,
                'objection' => false,
                'optional' => true,
                'created_at' => $now,
            ],
            // id = 7
            [
                'name' => 'Encargo Informe Industrial',
                'date' => true,
                'date_required' => true,
                'person' => true,
                'person_required' => true,
                'number' => false,
                'file' => false,
                'objection' => true,
                'objection_required' => false,
                'person_position_id' => 2,
                'created_at' => $now,
            ],
            // id = 8
            [
                'name' => 'Informe Industrial',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'file_required' => false,
                'objection' => false,
            ],
            // id = 9
            [
                'name' => 'Encargo Informe Ambiental',
                'date' => true,
                'date_required' => true,
                'person' => true,
                'person_required' => true,
                'number' => false,
                'file' => false,
                'objection' => true,
                'objection_required' => false,
                'person_position_id' => 3,
                'created_at' => $now,
            ],
            // id = 10
            [
                'name' => 'Informe Ambiental',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'file_required' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 11
            [
                'name' => 'Informe De Calificación Y Propuesta De Resolución',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 12
            [
                'name' => 'Número de Resolución',
                'date' => false,
                'person' => false,
                'number' => true,
                'number_required' => true,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 13
            [
                'name' => 'Fecha de Resolución',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // di = 14
            [
                'name' => 'Entrega Notificador',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 15
            [
                'name' => 'Notificación',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 16
            [
                'name' => 'Finalizar Licencia',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'created_at' => $now,
            ],
            // id = 17
            [
                'name' => 'Procede Visita',
                'date' => false,
                'date_required' => false,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'proceeds_visit' => true,
                'created_at' => $now,
            ],
            // id = 18
            [
                'name' => 'Encargo Informe Urbanistico *',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => true,
                'optional' => true,
                'created_at' => $now,
            ],
            // id = 19
            [
                'name' => 'Informe Urbanistico *',
                'date' => true,
                'date_required' => true,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,#JGT: Se quita el reparo
                'optional' => true,
                'created_at' => $now,
            ],
            // id = 20
            [
                'name' => 'Visita',
                'date' => false,
                'date_required' => false,
                'person' => false,
                'number' => false,
                'file' => false,
                'objection' => false,
                'date_firsh_visit' => true,
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
        Schema::drop('license_stages');
    }
}
