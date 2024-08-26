<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category' => '寿司',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category' => '焼肉',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category' => '居酒屋',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category' => 'イタリアン',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category' => 'ラーメン',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
