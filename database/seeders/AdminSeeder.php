<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'                          => 'Administrator SMRUSB',
                'email'                         => 'admin@smrusb.ro',
                'password'                      => Hash::make("password"),
                'remember_token'                => Str::random(10),
                'isActive'                      => 1,
                'userType'                      => 1
            ]
        );
    }
}
