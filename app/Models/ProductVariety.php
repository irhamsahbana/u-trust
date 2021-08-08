<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariety extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'no_part_or_material',
        'price'
    ];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
