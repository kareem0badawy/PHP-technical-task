<?php

namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProductRepository;

class ProductService
{
    
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function autocompleteSearch($_request)
    {
        return $this->productRepository->autocompleteSearch($_request);
    }
    
    public function getAllPharmaciesById($id)
    {
        return $this->productRepository->getAllPharmaciesById($id);
    }

    public function getAllPharmacies()
    {
        return $this->productRepository->getAllPharmacies();
    }
    
    public function storeProduct($_request)
    {
        DB::beginTransaction();
        try {
            $this->productRepository->store($_request);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
        DB::commit();
        return;
    }

    public function updateProduct($_request, $id)
    {
        DB::beginTransaction();
        try {
            $this->productRepository->update($_request, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
        DB::commit();
        return;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $this->productRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
        DB::commit();
        return;
    }

}
