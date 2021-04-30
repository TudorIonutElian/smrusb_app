<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionarCalificativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dc_calificative')->insert(
            array(
                ['dc_denumire' => 'Excelent', 'dc_status' => true],
                ['dc_denumire' => 'Foarte Bine', 'dc_status' => true],
                ['dc_denumire' => 'Bine', 'dc_status' => true],
                ['dc_denumire' => 'Satisfacator', 'dc_status' => true],
                ['dc_denumire' => 'Nesatisfacator', 'dc_status' => true],
                ['dc_denumire' => 'Neevaluat', 'dc_status' => true],
            )
        );
    }
}
