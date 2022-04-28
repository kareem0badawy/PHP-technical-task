<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Pharmacy;
use Illuminate\Database\Seeder;
use App\Models\PharmacyProducts;

use Faker\Generator as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Product::factory(30000)->create();
        $this->call([
            ProductSeeder::class,
        ]);
        Pharmacy::factory(20000)->create();

            
        Product::pluck('id')->each(function ($id) {
            $pharmacyIds = Pharmacy::pluck('id')->random(rand(1, 5));
            $pharmacyIds->each(function ($pharmacyId) use ($id) {
                Pharmacy::find($pharmacyId)->products()->attach([
                    $id => [
                        'price' => rand(20.5, 250.6),
                    ],
                ]);
            });
        });
    }
}
