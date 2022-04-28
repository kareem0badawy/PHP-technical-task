<?php

namespace App\Console\Commands;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use App\Models\PharmacyProducts;

class ProductsSearchCheapest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest {product_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that takes product id and returns cheapest 5 pharmacies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $product_id = $this->argument('product_id');
         $pharmacies = PharmacyProducts::orderBy('price','asc')
                        ->whereProductId($product_id)
                        ->limit(5)->get()->map(function($pharmacy) {
                        return [
                            'id' => $pharmacy->pharmacy_id,
                            'title' => $pharmacy->pharmacy->title,
                            'price' => $pharmacy->price
                        ];
                    });
        dd($pharmacies);
    }
}
