<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'address' => '東京都',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'address' => '大阪府',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'address' => '福岡市',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('addresses')->insert($addresses);
    }
}
