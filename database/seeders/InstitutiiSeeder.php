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
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Nationala de Administrare Fiscala',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => null
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Alba',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Arad',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Arges',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Bacau',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Bihor',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Bistrita-Nasaud',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Botosani',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Braila',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Brasov',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Bucuresti',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Buzau',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Calarasi',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Caras Severin',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Bucuresti',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Cluj',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Constanta',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Covasna',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Dambovita',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Dolj',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Galati',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Giurgiu',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Gorj',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Harghita',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Hunedoara',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Ialomita',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Iasi',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Ilfov',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Maramures',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Mehedinti',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Neamt',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Olt',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Prahova',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Salaj',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Satu-Mare',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Sibiu',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Suceava',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Teleorman',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Timis',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Tulcea',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Valcea',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Vaslui',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 1,
                    'institutie_denumire'  => 'Agentia Judeteana de Administrare Fiscala Vrancea',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                // Institutii ale Ministerului Afacerilor Interne
                [
                    'institutie_minister_id'  => 2,
                    'institutie_denumire'  => 'Ministerul Afacerilor Interne - Aparat Central',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 2,
                    'institutie_denumire'  => 'Inspectoratul General al Politiei Romane',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 2,
                    'institutie_denumire'  => 'Inspectoratul General al Politiei de Frontiera Romane',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
                [
                    'institutie_minister_id'  => 2,
                    'institutie_denumire'  => 'Inspectoratul General al Jandarmeriei Romane',
                    'institutie_este_ordonator'  => true,
                    'institutie_ordonator_id'  => 1
                ],
            )
        );
    }
}
