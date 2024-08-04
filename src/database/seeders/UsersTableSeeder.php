<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => '管理者',
                'email' => 'admin@example.com',
                'password' => Hash::make('adminexample'),
                'role' => 3,
            ],
            [
                'name' => 'オーナー',
                'email' => 'owner@example.com',
                'password' => Hash::make('ownerexample'),
                'role' => 2,
            ],
        ];
        DB::table('users')->insert($user);
    }
}
