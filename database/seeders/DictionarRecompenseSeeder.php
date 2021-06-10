<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionarRecompenseSeeder extends Seeder
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
                ['dr_denumire' => 'Crestere salariala 5%'],
                ['dr_denumire' => 'Crestere salariala 10%'],
                ['dr_denumire' => 'Crestere salariala 15%'],
                ['dr_denumire' => 'Crestere salariala 20%'],
                ['dr_denumire' => 'Crestere salariala 25%'],
                ['dr_denumire' => 'Crestere salariala 35%'],
                ['dr_denumire' => 'Crestere salariala 20% - 3 luni'],
                ['dr_denumire' => 'Crestere salariala 20% - 6 luni'],
                ['dr_denumire' => 'Bonus 100 lei'],
                ['dr_denumire' => 'Bonus 200 lei'],
                ['dr_denumire' => 'Bonus 300 lei'],
                ['dr_denumire' => 'Bonus 500 lei'],
                ['dr_denumire' => 'Bonus 1000 lei'],
                ['dr_denumire' => 'Liber platit 1 zi'],
                ['dr_denumire' => 'Liber platit 3 zile'],
                ['dr_denumire' => 'Liber platit 5 zile'],
                ['dr_denumire' => 'Liber platit 10 zile'],
                ['dr_denumire' => 'Voucher Emag 200 lei'],
                ['dr_denumire' => 'Voucher Emag 500 lei'],
                ['dr_denumire' => 'Voucher Emag 1000 lei'],
                ['dr_denumire' => 'Voucher Teatru 2 persoane'],
                ['dr_denumire' => 'Voucher Teatru 3 persoane'],
                ['dr_denumire' => 'Voucher Teatru 5 persoane'],
            )
        );
    }
}
