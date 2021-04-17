<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivIncetareContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motive_incetare_contract')->insert(
            array(
                ['mic_denumire' => 'La cerere'],
                ['mic_denumire' => 'Demisie'],
                ['mic_denumire' => 'Demitere'],
                ['mic_denumire' => 'La numirea intr-o alta functie publica'],
                ['mic_denumire' => 'La implinirea limitei de varsta pentru pensionare'],
                ['mic_denumire' => 'Condamnat prin hotarare'],
                ['mic_denumire' => 'Incompatibil cu statutul functionarului'],
                ['mic_denumire' => 'Acordare drept de pensie anticipat'],
                ['mic_denumire' => 'Acordare drept de pensie anticipat partial'],
                ['mic_denumire' => 'Motiv de invaliditate certificat'],
                ['mic_denumire' => 'Deces'],
                ['mic_denumire' => 'Incetare termen contract']
            )
        );
    }
}
