<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grade')->insert(
            array(
                // Grade invatamant
                ['grad_denumire'  => 'Grad didactic I'],
                ['grad_denumire'  => 'Grad didactic II'],
                ['grad_denumire'  => 'Grad didactic definitiv'],
                ['grad_denumire'  => 'Treapta I'],
                ['grad_denumire'  => 'Treapta II'],
                ['grad_denumire'  => 'Treapta III'],
                ['grad_denumire'  => 'Treapta IA'],
                ['grad_denumire'  => 'Debutant'],

                //
            )
        );
    }
}
