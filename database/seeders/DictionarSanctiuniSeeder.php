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
        DB::table('dc_sanctiuni')->insert(
            array(
                ['ds_denumire' => 'Scadere salariala 5%'],
                ['ds_denumire' => 'Scadere salariala 10%'],
                ['ds_denumire' => 'Scadere salariala 15%'],
                ['ds_denumire' => 'Scadere salariala 20%'],
                ['ds_denumire' => 'Scadere salariala 25%'],
                ['ds_denumire' => 'Scadere salariala 35%'],
                ['ds_denumire' => 'Scadere salariala 20% - 3 luni'],
                ['ds_denumire' => 'Scadere salariala 20% - 6 luni'],
                ['ds_denumire' => 'Scadere salariu 100 lei'],
                ['ds_denumire' => 'Scadere salariu 200 lei'],
                ['ds_denumire' => 'Scadere salariu 300 lei'],
                ['ds_denumire' => 'Scadere salariu 500 lei'],
                ['ds_denumire' => 'Scadere salariu 1000 lei']
            )
        );
    }
}
