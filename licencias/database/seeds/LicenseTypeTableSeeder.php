<?php

use Illuminate\Database\Seeder;

class LicenseTypeTableSeeder extends Seeder
{

    public function run()
    {
        factory(CityBoard\Entities\LicenseType::class)->create([
          'name' => 'Declaración responsable - Actividades inocuas',
          'visit' => false,
        ]);

        factory(CityBoard\Entities\LicenseType::class)->create([
          'name' => 'Declaración responsable - Actividades no inocuas',
          'visit' => false,
        ]);

        factory(CityBoard\Entities\LicenseType::class)->create([
          'name' => 'Licencias de actividad',
          'visit' => true,
        ]);
    }
}
