<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->importCountries();
        $this->importStates();
    }

    private function importCountries()
    {
        $reader = SimpleExcelReader::create(database_path('seeders/files/country-instituciones.xlsx'))
            ->fromSheetName("country") // Primera hoja (index 0)
            ->trimHeaderRow();

        $reader->getRows()
            ->each(function (array $rowProperties) {
                $model = new Country();
                $model->name = $rowProperties['name'];
                $model->cod_num = $rowProperties['cod_num'];
                $model->cod_alf3 = $rowProperties['cod_alf3'];
                $model->cod_alf2 = $rowProperties['cod_alf2'];
                $model->save();
            });
    }

    private function importStates()
    {
        $reader = SimpleExcelReader::create(database_path('seeders/files/country-instituciones.xlsx'))
            ->fromSheetName("estados")
            ->trimHeaderRow();

        $reader->getRows()
            ->each(function (array $rowProperties) {
                $model = new State();
                $model->name = $rowProperties['name'];
                $model->cod_state = $rowProperties['cod_state'];
                $model->country_id = $rowProperties['id_country'];
                $model->save();
            });
    }
}
