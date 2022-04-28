<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyProducts;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('web.home')->with([
           'products' => $this->productService->getAll()
        ]);
    }

    public function autocompleteSearch(Request $request)
    {
        $filterResult = $this->productService->autocompleteSearch($request);
        return response()->json($filterResult);
    } 


    public function create()
    {
        $pharmacies = $this->productService->getAllPharmacies();
        return view('web.products.manage',compact('pharmacies'));
    }
    
    public function store(ProductRequest $request)
    {
        $this->productService->storeProduct($request);
        toast('Product Added','success');
        return redirect()->route('products.index');
    }

 
    public function edit($id)
    {
        $product =  $this->productService->getById($id);
        $pharmacies = $this->productService->getAllPharmacies();
        return view('web.products.manage' ,compact('product','pharmacies'));
    }

    public function show($id)
    {
        $product =  $this->productService->getById($id);
        $pharmacies = $this->productService->getAllPharmaciesById($id);
        return view('web.details',compact('product','pharmacies'));
    }
    
    public function update(ProductRequest $request, $id)
    {
        $this->productService->updateProduct($request,$id);
        toast('Product Updated','success');
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->productService->deleteById($id);
        toast('Product Deleted','error');
        return redirect()->route('products.index');
    }
}
