<?php

use Illuminate\Database\Seeder;

class LicenseTypeTableSeeder extends Seeder
{

    public function run()
    {
        factory(CityBoard\Entities\LicenseType::class)->create([
          'name' => 'Actividades inocuas',
          'visit' => false,
        ]);

        factory(CityBoard\Entities\LicenseType::class)->create([
          'name' => 'Actividades sujetas a declaración responsable',
          'visit' => false,
        ]);

        factory(CityBoard\Entities\LicenseType::class)->create([
          'name' => 'Licencias de actividad',
          'visit' => true,
        ]);
    }
}
