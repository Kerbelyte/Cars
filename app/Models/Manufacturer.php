<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function carmodel()
    {
        return $this->hasMany('App\Models\CarModel');
    }
}
