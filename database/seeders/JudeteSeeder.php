<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JudeteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserare Judete in tabel
        DB::table('judete')->insert(
            array(
                // Inserare judete Regiunea Nord Est
                ['denumire' => 'Bacau', 'regiune'=> 1],
                ['denumire' => 'Botosani', 'regiune'=> 1],
                ['denumire' => 'Iasi', 'regiune'=> 1],
                ['denumire' => 'Neamt', 'regiune'=> 1],
                ['denumire' => 'Suceava', 'regiune'=> 1],
                ['denumire' => 'Vaslui', 'regiune'=> 1],

                // Inserare judete Regiunea Sud Est
                ['denumire' => 'Braila', 'regiune'=> 2],
                ['denumire' => 'Buzau', 'regiune'=> 2],
                ['denumire' => 'Constanta', 'regiune'=> 2],
                ['denumire' => 'Galati', 'regiune'=> 2],
                ['denumire' => 'Tulcea', 'regiune'=> 2],
                ['denumire' => 'Vrancea', 'regiune'=> 2],

                // Inserare judete Regiunea Sud Est
                ['denumire' => 'Argeș', 'regiune'=> 3],
                ['denumire' => 'Calarasi', 'regiune'=> 3],
                ['denumire' => 'Dambovia', 'regiune'=> 3],
                ['denumire' => 'Giurgiu', 'regiune'=> 3],
                ['denumire' => 'Ialomita', 'regiune'=> 3],
                ['denumire' => 'Prahova', 'regiune'=> 3],
                ['denumire' => 'Teleorman', 'regiune'=> 3],

                // Inserare judete Regiunea Sud Vest Oltenia
                ['denumire' => 'Dolj', 'regiune'=> 4],
                ['denumire' => 'Gorj', 'regiune'=> 4],
                ['denumire' => 'Mehedinti', 'regiune'=> 4],
                ['denumire' => 'Olt', 'regiune'=> 4],
                ['denumire' => 'Valcea', 'regiune'=> 4],


                // Inserare judete Regiunea Vest
                ['denumire' => 'Arad', 'regiune'=> 5],
                ['denumire' => 'Caras-Severin', 'regiune'=> 5],
                ['denumire' => 'Hunedoara', 'regiune'=> 5],
                ['denumire' => 'Timis', 'regiune'=> 5],

                // Inserare judete Regiunea Nord-Vest
                ['denumire' => 'Bihor', 'regiune'=> 6],
                ['denumire' => 'Bistrita-Nasaud', 'regiune'=> 6],
                ['denumire' => 'Cluj', 'regiune'=> 6],
                ['denumire' => 'Maramures', 'regiune'=> 6],
                ['denumire' => 'Satu-Mare', 'regiune'=> 6],
                ['denumire' => 'Salaj', 'regiune'=> 6],

                // Inserare judete Regiunea Centru
                ['denumire' => 'Alba', 'regiune'=> 7],
                ['denumire' => 'Brașov', 'regiune'=> 7],
                ['denumire' => 'Covasna', 'regiune'=> 7],
                ['denumire' => 'Harghita', 'regiune'=> 7],
                ['denumire' => 'Mures', 'regiune'=> 7],
                ['denumire' => 'Sibiu', 'regiune'=> 7],

                // Inserare judete Regiunea Bucuresti Ilfov
                ['denumire' => 'Ilfov', 'regiune'=> 8],
                ['denumire' => 'Bucuresti', 'regiune'=> 8]

            )
        );
    }
}
