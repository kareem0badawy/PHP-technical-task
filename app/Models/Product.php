<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function pharmacyProduct()
    {
        return $this->hasOne(PharmacyProducts::class, 'product_id', 'id');
    } 

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, PharmacyProducts::class, 'product_id', 'pharmacy_id');
    }
    
    public function getImageAttribute($value)
    {
        if(File::extension($value)) return 'images/'.$value;
        return $value;
    }
}
