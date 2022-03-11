<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\shop;
use Faker\Factory as Faker;

class shopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 100; $i++){
            $shop = new Shop;
            $shop->shop_name = $faker->name;
            $shop->image = $faker->image;
            $shop->address = $faker->address;
            $shop->email = $faker->email;
            $shop->save();
        }


    }
}
