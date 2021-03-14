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
                'user_first_name'                    => 'Administrator',
                'user_last_name'                     => 'System',
                'user_username'                      => 'system.admin',
                'user_email'                         => 'admin@smrusb.ro',
                'user_password'                      => Hash::make("password"),
                'remember_token'                     => Str::random(10),
                'user_is_active'                     => 1,
                'user_type'                          => 1
            ]
        );
    }
}
