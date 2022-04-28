<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyProducts extends Model
{
    use HasFactory;

    protected $guarded = [];

    function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
