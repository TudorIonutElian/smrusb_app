<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctiiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('functii')->insert(
            array(
                // Funcțiile de conducere din învățământul superior
                [
                    'functie_denumire'  => 'Rector gradul I',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 5.48,
                    'functie_suma'  => 13705,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Rector gradul II',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 6.49,
                    'functie_suma'  => 16232,
                    'functie_status'  => true
                ],

                [
                    'functie_denumire'  => 'Prorector gradul I',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.63,
                    'functie_suma'  => 11582,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Prorector gradul II',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 5.97,
                    'functie_suma'  => 14916,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Rector',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 5.48,
                    'functie_suma'  => 13705,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director General Administrativ Universitate',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.40,
                    'functie_suma'  => 11003,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Decan',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.40,
                    'functie_suma'  => 11003,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Prodecan',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.01,
                    'functie_suma'  => 10037,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Departament',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.17,
                    'functie_suma'  => 10423,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director General Adjunct Administrativ',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.40,
                    'functie_suma'  => 8493,
                    'functie_status'  => true
                ],
                // 2. Funcțiile de conducere, de îndrumare și control din învățământul preuniversitar
                [
                    'functie_denumire'  => 'Inspector Scolar General',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.84,
                    'functie_suma'  => 7100,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Inspector Scolar General Adjunct',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.82,
                    'functie_suma'  => 7050,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Casa Corpului Didactic',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.82,
                    'functie_suma'  => 7050,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Inspector scolar de specialitate',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.80,
                    'functie_suma'  => 7000,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Unitate Invatamant',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.80,
                    'functie_suma'  => 7000,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Adjunct Unitate Invatamant',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.79,
                    'functie_suma'  => 6975,
                    'functie_status'  => true
                ],
                // 3. Funcțiile de conducere pentru funcțiile didactice auxiliare
                [
                    'functie_denumire'  => 'Director',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.81,
                    'functie_suma'  => 7019,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Administrator Sef Facultate',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.63,
                    'functie_suma'  => 6580,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Secretar Sef Universitate',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.40,
                    'functie_suma'  => 8493,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Secretar Sef Facultate',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.61,
                    'functie_suma'  => 6520,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Sef Serviciu',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.61,
                    'functie_suma'  => 6520,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Sef Birou',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.38,
                    'functie_suma'  => 5950,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Contabil Sef',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.08,
                    'functie_suma'  => 5212,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Secretar Sef Unitate',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.08,
                    'functie_suma'  => 5212,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Contabil Sef',
                    'functie_nivel_studii'  => 'M',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.70,
                    'functie_suma'  => 4259,
                    'functie_status'  => true
                ],
                // 4. Salarii de bază învățământ universitar

                [
                    'functie_denumire'  => 'Profesor Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 25,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.35,
                    'functie_suma'  => 10880,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Profesor Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 20,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.65,
                    'functie_suma'  => 9125,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Profesor Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 15,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.90,
                    'functie_suma'  => 7250,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Profesor Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 10,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.38,
                    'functie_suma'  => 5950,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Profesor Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 5,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.25,
                    'functie_suma'  => 5625,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Conferentiar Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 25,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.02,
                    'functie_suma'  => 7546,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Conferentiar Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 20,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.63,
                    'functie_suma'  => 6580,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Conferentiar Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 15,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.21,
                    'functie_suma'  => 5517,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Conferentiar Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 10,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.04,
                    'functie_suma'  => 5101,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Conferentiar Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 5,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.93,
                    'functie_suma'  => 4828,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Conferentiar Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 3,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.80,
                    'functie_suma'  => 4508,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 25,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.08,
                    'functie_suma'  => 5212,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 20,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.93,
                    'functie_suma'  => 4828,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 15,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.82,
                    'functie_suma'  => 4554,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 5,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.93,
                    'functie_suma'  => 4828,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 10,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.77,
                    'functie_suma'  => 4417,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 5,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.75,
                    'functie_suma'  => 4372,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Lector Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 3,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.73,
                    'functie_suma'  => 4326,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 25,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.82,
                    'functie_suma'  => 4554,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 20,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.77,
                    'functie_suma'  => 4417,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 15,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.73,
                    'functie_suma'  => 4326,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 10,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.70,
                    'functie_suma'  => 4259,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 5,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.69,
                    'functie_suma'  => 4216,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 3,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.67,
                    'functie_suma'  => 4173,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent Universitar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => 0,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.65,
                    'functie_suma'  => 4130,
                    'functie_status'  => true
                ],

                // Unități de cercetare științifică, dezvoltare tehnologică și proiectare

                [
                    'functie_denumire'  => 'Director General Institut de Cercetare',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 4.00,
                    'functie_suma'  => 10002,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director General Adjunct Institut de Cercetare',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.86,
                    'functie_suma'  => 9651,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Institutit de Cercetare',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.86,
                    'functie_suma'  => 9651,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Adjunct Institut de Cercetare',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.79,
                    'functie_suma'  => 9476,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Director Centru de Cercetare',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.65,
                    'functie_suma'  => 9125,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Secretar Stiintific Institut de Cercetare',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.65,
                    'functie_suma'  => 9125,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Cercetator Stiintific I',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 3.02,
                    'functie_suma'  => 7546,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Cercetator Stiintific II',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 2.39,
                    'functie_suma'  => 5966,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Cercetator Stiintific III',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.69,
                    'functie_suma'  => 4216,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Cercetator Stiintific',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.65,
                    'functie_suma'  => 4130,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent de Cercetare Stiintifica',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.63,
                    'functie_suma'  => 4087,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent de Cercetare Stiintifica stagiar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.58,
                    'functie_suma'  => 3950,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent I',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.54,
                    'functie_suma'  => 3850,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent II',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.50,
                    'functie_suma'  => 3750,
                    'functie_status'  => true
                ],
                [
                    'functie_denumire'  => 'Asistent stagiar',
                    'functie_nivel_studii'  => 'S',
                    'functie_nivel_vechime' => NULL,
                    'functie_grad_prevazut' => NULL,
                    'functie_coeficient'  => 1.44,
                    'functie_suma'  => 3610,
                    'functie_status'  => true
                ]

            )
        );
    }
}
