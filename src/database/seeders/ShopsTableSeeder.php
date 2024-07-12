<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // ['name' => '', 'address' => '', 'category' => '', 'overview' =>'', 'image' => ''],
    public function run()
    {
        $shops = [
            ['name' => '仙人', 'address' => '東京都', 'category' => '寿司', 'overview' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。', 'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'],
            ['name' => '牛助', 'address' => '大阪府', 'category' => '焼肉', 'overview' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。', 'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'],
            ['name' => '戦慄', 'address' => '福岡県', 'category' => '居酒屋', 'overview' => '気軽に立ち寄れる昔懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。仕事帰りに是非御来店ください。', 'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg'],
            ['name' => 'ルーク', 'address' => '東京都', 'category' => 'イタリアン', 'overview' =>'都心にひっそりとたたずむ、古民家を改築した落ち着いた空間です。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。ゆっくりと上質な時間をお楽しみください。', 'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg'],
        ];

        DB::table('shops')->insert($shops);
    }
}
