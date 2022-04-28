<?php 
namespace App\Repositories;

use App\Models\Product;
use App\Models\Pharmacy;
use App\Models\PharmacyProducts;
use Illuminate\Support\Facades\Storage;
// use App\Repositories\ProductRepositoryInterface;


class ProductRepository
{
    protected $product;

	public function __construct(Product $product) {
        $this->product = $product;
    }

    public function getAll() : object
    {
        return $this->product->latest()->paginate(24);
    }

    public function autocompleteSearch($_request) : object 
    {
        return Product::select("id","title as name")->where("title","LIKE","%{$_request->word}%")->paginate(20); 
    }

    public function getById($id)
    {
        return $this->product->find($id);
    }

    public function getAllPharmaciesById($id)
    {
        return PharmacyProducts::orderBy('price','asc')->where('product_id',$id)->get();
    }


    public function getAllPharmacies()
    {
        return Pharmacy::pluck('title', 'id');
    }

    public function store($_request) : void
    {
        $pharmacies = $_request->pharmacies;
        $price = $_request->price;

        $_request = request()->except('_token','pharmacies','price');
        if (isset($_request['image']) && $_request['image']) {
            $_request['image'] = $this->uploadImages(request());
        }
        $product =  $this->product->create($_request);
        $this->attachPrice(null,$pharmacies,$product, $price);
       
        return;
    }

    public function update($_request,$id)
    {
        $pharmacies = $_request->pharmacies;
        $price = $_request->price;

        $_request = request()->except('_token','_method','pharmacies','price');
        if (isset($_request['image']) && $_request['image']) {
            $this->deleteImagesFromStorage($id);
            $_request['image'] = $this->uploadImages(request());
        }
        $product = $this->product->find($id);
        $product->update($_request);

        $this->attachPrice($id,$pharmacies,$product, $price);

        return;
    }
    
    public function attachPrice($id=null,$pharmacies,$product, $price)
    {
        if ($id) {
            PharmacyProducts::where('product_id',$id)->delete();
        }
        collect($pharmacies)->each(function ($pharmacy) use ($product, $price) {
            PharmacyProducts::create([
                'pharmacy_id' => $pharmacy,
                'product_id' => $product->id,
                'price' => $price
            ]);
        });
    }

    public function delete($id) : void
    {
        $this->deleteImagesFromStorage($id);
        $this->product->find($id)->delete();
        return;
    }

    private function uploadImages($request) {
        $request->file('image')->store('public/images');
        return request()->file('image')->hashName();
    }

    private function deleteImagesFromStorage($id) {
        $old_file = $this->product->find($id)->image;
        Storage::delete('public/'.$old_file);
    }
    

}