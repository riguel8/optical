<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eyewear extends Model
{
    use HasFactory;

    protected $table = 'eyewears';

    protected $primaryKey = 'EyewearID';

    // Define the fillable attributes
    protected $fillable = [
        'Brand',
        'Model',
        'FrameType',
        'FrameColor',
        'LensType',
        'LensMaterial',
        'Price',
        'QuantityAvailable',
        'image',
    ];
}
