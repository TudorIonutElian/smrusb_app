<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutiiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutii')->insert(
            array(
                // Institutii ale Ministerului de Finante
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Nationala de Administrare Fiscala',
                    'institutie_cod_acces'                  => 10000,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => null
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Alba',
                    'institutie_cod_acces'                  => 10001,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Arad',
                    'institutie_cod_acces'                  => 10002,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Arges',
                    'institutie_cod_acces'                  => 10003,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Bacau',
                    'institutie_cod_acces'                  => 10004,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Bihor',
                    'institutie_cod_acces'                  => 10005,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Bistrita-Nasaud',
                    'institutie_cod_acces'                  => 10006,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Botosani',
                    'institutie_cod_acces'                  => 10007,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Braila',
                    'institutie_cod_acces'                  => 10008,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Brasov',
                    'institutie_cod_acces'                  => 10009,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Bucuresti',
                    'institutie_cod_acces'                  => 10010,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Buzau',
                    'institutie_cod_acces'                  => 10011,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Calarasi',
                    'institutie_cod_acces'                  => 10012,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Caras Severin',
                    'institutie_cod_acces'                  => 10013,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Bucuresti',
                    'institutie_cod_acces'                  => 10014,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Cluj',
                    'institutie_cod_acces'                  => 10015,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Constanta',
                    'institutie_cod_acces'                  => 10016,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Covasna',
                    'institutie_cod_acces'                  => 10017,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Dambovita',
                    'institutie_cod_acces'                  => 10018,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Dolj',
                    'institutie_cod_acces'                  => 10019,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Galati',
                    'institutie_cod_acces'                  => 10020,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Giurgiu',
                    'institutie_cod_acces'                  => 10021,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Gorj',
                    'institutie_cod_acces'                  => 10022,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Harghita',
                    'institutie_cod_acces'                  => 10023,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Hunedoara',
                    'institutie_cod_acces'                  => 10024,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Ialomita',
                    'institutie_cod_acces'                  => 10025,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Iasi',
                    'institutie_cod_acces'                  => 10026,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Ilfov',
                    'institutie_cod_acces'                  => 10027,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Maramures',
                    'institutie_cod_acces'                  => 10018,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Mehedinti',
                    'institutie_cod_acces'                  => 10029,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Neamt',
                    'institutie_cod_acces'                  => 10030,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Olt',
                    'institutie_cod_acces'                  => 10031,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Prahova',
                    'institutie_cod_acces'                  => 10032,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Salaj',
                    'institutie_cod_acces'                  => 10033,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Satu-Mare',
                    'institutie_cod_acces'                  => 10034,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Sibiu',
                    'institutie_cod_acces'                  => 10035,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Suceava',
                    'institutie_cod_acces'                  => 10036,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Teleorman',
                    'institutie_cod_acces'                  => 10037,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Timis',
                    'institutie_cod_acces'                  => 10038,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Tulcea',
                    'institutie_cod_acces'                  => 10039,
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Valcea',
                    'institutie_cod_acces'                  => 10040,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Vaslui',
                    'institutie_cod_acces'                  => 10041,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 1,
                    'institutie_denumire'                   => 'Agentia Judeteana de Administrare Fiscala Vrancea',
                    'institutie_cod_acces'                  => 10042,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                // Institutii ale Ministerului Afacerilor Interne
                [
                    'institutie_minister_id'                => 2,
                    'institutie_denumire'                   => 'Ministerul Afacerilor Interne - Aparat Central',
                    'institutie_cod_acces'                  => 20000,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 2,
                    'institutie_denumire'                   => 'Inspectoratul General al Politiei Romane',
                    'institutie_cod_acces'                  => 21000,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 2,
                    'institutie_denumire'                   => 'Inspectoratul General al Politiei de Frontiera Romane',
                    'institutie_cod_acces'                  => 22000,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
                [
                    'institutie_minister_id'                => 2,
                    'institutie_denumire'                   => 'Inspectoratul General al Jandarmeriei Romane',
                    'institutie_cod_acces'                  => 23000,
                    'institutie_este_ordonator'             => true,
                    'institutie_ordonator_id'               => 1
                ],
            )
        );
    }
}
