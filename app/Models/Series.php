<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = [
        'series_name',
        'filename',
    ];

    public function seriesvariety(){
    	return $this->hasMany(SeriesVariety::class);
    }
}
