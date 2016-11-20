<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = date('Y-m-d H:i:s');
        \DB::table('license_types')->insert([
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
        ]);

        \DB::table('activities')->insert([
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
        ]);

        \DB::table('person_positions')->insert([
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
        ]);

        \DB::table('license_statuses')->insert([
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
        ]);

        \DB::table('time_limits')->insert([
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
        ]);



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
            ]);
        \DB::table('license_stages')->insert(
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
            ]);
        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);
        \DB::table('license_stages')->insert(
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
            ]);
        \DB::table('license_stages')->insert(
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
            ]);
        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);

        \DB::table('license_stages')->insert(
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
            ]);


        // Tipo 1 - Comunicado de Actividad
        $stagesTypeOne = [
            17,
            18,
            19,
            20,
            16
        ];

        $this->createStages($stagesTypeOne, 1);

        // Tipo 2 Licencias Sin Calificación
        $stagesTypeTwo = [
            17,
            18,
            19,
            20,
            16
        ];

        $this->createStages($stagesTypeTwo, 2);

        // Tipo 3 Licencias Con Calificación
        $stagesTypeThree = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16
        ];

        $this->createStages($stagesTypeThree, 3);

    }

    /**
     * @param $stages
     * @param $licenseType
     */
    private function createStages($stages, $licenseType) {
        $weight = 0;
        foreach ($stages as $stage) {
            if ($weight != 0) {

                $licenseTypeStagePrevious = CityBoard\Entities\LicenseTypeStage::where('license_type_id',
                    $licenseType)->where('weight', $weight - 1)->first();
            }


            $licenseTypeStage = new CityBoard\Entities\LicenseTypeStage();
            $licenseTypeStage->license_type_id = $licenseType;
            $licenseTypeStage->license_stage_id = $stage;
            $licenseTypeStage->weight = $weight;


            $licenseTypeStage->previous = NULL;
            if ($weight != 0) {
                $licenseTypeStage->previous = $licenseTypeStagePrevious->license_stage_id;
            }

            $licenseTypeStage->next = NULL;
            if ($weight != 0) {
                $licenseTypeStagePrevious->next = $stage;
                $licenseTypeStagePrevious->save();
            }

            $licenseTypeStage->license_generate = TRUE;
            if ($weight != 0) {
                $licenseTypeStagePrevious->license_generate = FALSE;
                $licenseTypeStagePrevious->save();
            }

            $licenseTypeStage->save();
            $weight++;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
