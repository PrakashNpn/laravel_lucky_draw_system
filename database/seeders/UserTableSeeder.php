<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'users' ) -> insert( [
            [
                'name'              => 'Admin',
                'email'             => 'admin@ucsm.com',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
            ],
        ] ) ;
    }
}
