<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goods = [];

        for ($i = 1; $i <=10; $i++) {
            $name = 'Прайс-лист #'.$i;
            $price_list_id = ($i > 4) ? rand(1, 4) : 1;
            $description = 'Описание товара #'.$i;
            $article_code = $i+1000;
            $price = rand(1000,10000);

            $priceLists[] = [
                'name' => $name,
                'description' => $description,
                'article_code' => $article_code,
                'price' => $price,
                'price_list_id' => $price_list_id,
            ];
        }

        DB::table('goods')->insert($goods);
    }
}
