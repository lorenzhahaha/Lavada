<?php

use Illuminate\Database\Seeder;

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
            'product_name' => 'Scarborough Bag',
            'product_picture' => 'bag.jpg',
            'product_price' => '15',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);

        DB::table('products')->insert([
            'product_name' => 'Leather-O Belt-O',
            'product_picture' => 'belt.jpg',
            'product_price' => '5',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),               
        ]);

        DB::table('products')->insert([
            'product_name' => 'Formal-in Pants',
            'product_picture' => 'pants.jpg',
            'product_price' => '8',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),              
        ]);

        DB::table('products')->insert([
            'product_name' => 'White Poloporma',
            'product_picture' => 'polo.jpeg',
            'product_price' => '9',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),              
        ]);

        DB::table('products')->insert([
            'product_name' => 'Leather Shoes',
            'product_picture' => 'shoes.jpg',
            'product_price' => '23',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),              
        ]);

        DB::table('products')->insert([
            'product_name' => 'Endless-Timeless Watch',
            'product_picture' => 'watch.jpg',
            'product_price' => '39',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),              
        ]);
    }
}
