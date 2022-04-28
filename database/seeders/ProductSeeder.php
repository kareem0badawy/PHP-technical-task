<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
    *
     * @return void
     */
    public function run()
    {
        // This file contains 20k real drug names
        $products = json_decode(file_get_contents(storage_path() . "/json/products.json"), true); 

        collect($products)->map(function ($product) {
            return Product::create($product);
        });
    }

    
}
