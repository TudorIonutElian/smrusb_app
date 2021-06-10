<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionarSanctiuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dc_recompense')->insert(
            array(
                ['dr_denumire' => 'Scadere salariala 5%'],
                ['dr_denumire' => 'Scadere salariala 10%'],
                ['dr_denumire' => 'Scadere salariala 15%'],
                ['dr_denumire' => 'Scadere salariala 20%'],
                ['dr_denumire' => 'Scadere salariala 25%'],
                ['dr_denumire' => 'Scadere salariala 35%'],
                ['dr_denumire' => 'Scadere salariala 20% - 3 luni'],
                ['dr_denumire' => 'Scadere salariala 20% - 6 luni'],
                ['dr_denumire' => 'Scadere salariu 100 lei'],
                ['dr_denumire' => 'Scadere salariu 200 lei'],
                ['dr_denumire' => 'Scadere salariu 300 lei'],
                ['dr_denumire' => 'Scadere salariu 500 lei'],
                ['dr_denumire' => 'Scadere salariu 1000 lei']
            )
        );
    }
}
