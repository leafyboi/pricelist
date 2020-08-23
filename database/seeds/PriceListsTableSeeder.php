<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priceLists = [];

        for ($i = 1; $i <=10; $i++) {
            $name = 'Прайс-лист #'.$i;

            $user_id = 1;

            $description = 'Описание прайс-листа #'.$i;

            $priceLists[] = [
                'name' => $name,
                'description' => $description,
                'user_id' => $user_id,
            ];
        }

        DB::table('price_lists')->insert($priceLists);
    }
}
