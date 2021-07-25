<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use HasFactory;
    protected $fillable = [
        'product_name',
        'type',
        'id_video',
        'filename',
        'filepath',
        'description'
    ];
}
