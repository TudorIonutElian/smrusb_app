<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinistereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ministere')->insert(
            array(
                ['minister_denumire'  => 'Ministerul Finantelor Publice', 'minister_prescurtare' => 'MFP'],
                ['minister_denumire'  => 'Ministerul Afacerilor Interne', 'minister_prescurtare' => 'MAI'],
                ['minister_denumire'  => 'Ministerul Afacerilor Externe', 'minister_prescurtare' => 'MAE'],
                ['minister_denumire'  => 'Ministerul Justitiei', 'minister_prescurtare' => 'MJ'],
                ['minister_denumire'  => 'Ministerul Apararii Nationale', 'minister_prescurtare' => 'MApN'],
                ['minister_denumire'  => 'Ministerul Economiei, Energiei si Mediului de Afaceri', 'minister_prescurtare' => 'MEEMA'],
                ['minister_denumire'  => 'Ministerul Transporturilor, Infrastructurii si Comunicatiilor', 'minister_prescurtare' => 'MTIC'],
                ['minister_denumire'  => 'Ministerul Agriculturii si Dezvoltarii Rurale', 'minister_prescurtare' => 'MADR'],
                ['minister_denumire'  => 'Ministerul Lucrarilor Publice, Dezvoltarii si Administratiei', 'minister_prescurtare' => 'MLPDA'],
                ['minister_denumire'  => 'Ministerul Fondurilor Europene', 'minister_prescurtare' => 'MFE'],
                ['minister_denumire'  => 'Ministerul Sanatatii', 'minister_prescurtare' => 'MS'],
                ['minister_denumire'  => 'Ministerul Educatiei si Cercetarii', 'minister_prescurtare' => 'MEC'],
                ['minister_denumire'  => 'Ministerul Culturii', 'minister_prescurtare' => 'MC'],
                ['minister_denumire'  => 'Ministerul Tineretului si Sportului', 'minister_prescurtare' => 'MTS'],
                ['minister_denumire'  => 'Ministerul Muncii si Protectiei Sociale', 'minister_prescurtare' => 'MMPS']
            )
        );
    }
}
