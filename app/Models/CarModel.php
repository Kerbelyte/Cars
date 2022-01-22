<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    public $fillable = ['name', 'horsepower', 'fuel', 'year', 'manufacturer_id'];

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer');
    }
}
