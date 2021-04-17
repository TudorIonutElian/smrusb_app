<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DateBancaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('date_banci')->insert(
            array(
                [
                    'db_denumire'   => 'Alpha Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'BRCI',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Banca FEROVIARA',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Intesa Sanpaolo',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'BCR',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Eximbank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Banca Românească',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Banca Transilvania',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Leumi',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'BRD',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'CEC Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Crédit Agricole',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Idea Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Libra Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Vista Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Patria Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'First Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Porsche Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'ProCredit Bank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Raiffeisen',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'UniCredit',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'BNP Paribas',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'Citibank',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'ING',
                    'db_status'     => true,

                ],
                [
                    'db_denumire'   => 'TBI Bank',
                    'db_status'     => true,

                ],

            )
        );
    }
}
