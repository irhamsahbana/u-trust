<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesVariety extends Model
{
    use HasFactory;
    protected $fillable = [
    	'series_id',
        'series_variety_name',
    ];

    public function series(){
    	return $this->belongsTo(Series::class, 'series_id');
    }
}
