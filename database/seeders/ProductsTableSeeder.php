<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'blue_shirt',
                'product_image' => 'images/blueshirt.jpeg',
                'product_actual_price' => 150.00,
                'product_offer_price' => 120.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'black_shirt',
                'product_image' => 'images/blackshirt.jpeg',
                'product_actual_price' => 150.00,
                'product_offer_price' => 120.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'red_shirt',
                'product_image' => 'images/redshirt.jpeg',
                'product_actual_price' => 150.00,
                'product_offer_price' => 120.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
            [
                'product_name' => 'white_shirt',
                'product_image' => 'images/whiteshirt.jpeg',
                'product_actual_price' => 150.00,
                'product_offer_price' => 120.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'green_shirt',
                'product_image' => 'images/greenshirt.jpeg',
                'product_actual_price' => 150.00,
                'product_offer_price' => 120.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more product entries here
        ]);
    }
}
