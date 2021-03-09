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
                ['minister_denumire'  => 'Ministerul Finantelor Publice'],
                ['minister_denumire'  => 'Ministerul Afacerilor Interne'],
                ['minister_denumire'  => 'Ministerul Afacerilor Externe'],
                ['minister_denumire'  => 'Ministerul Justitiei'],
                ['minister_denumire'  => 'Ministerul Apararii Nationale'],
                ['minister_denumire'  => 'Ministerul Economiei, Energiei si Mediului de Afaceri'],
                ['minister_denumire'  => 'Ministerul Transporturilor, Infrastructurii si Comunicatiilor'],
                ['minister_denumire'  => 'Ministerul Agriculturii si Dezvoltarii Rurale'],
                ['minister_denumire'  => 'Ministerul Lucrarilor Publice, Dezvoltarii si Administratiei'],
                ['minister_denumire'  => 'Ministerul Fondurilor Europene'],
                ['minister_denumire'  => 'Ministerul Sanatatii'],
                ['minister_denumire'  => 'Ministerul Educatiei si Cercetarii'],
                ['minister_denumire'  => 'Ministerul Culturii'],
                ['minister_denumire'  => 'Ministerul Tineretului si Sportului'],
                ['minister_denumire'  => 'Ministerul Muncii si Protectiei Sociale']
            )
        );
    }
}
