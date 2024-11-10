<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInfo extends Model
{
    use HasFactory;

    protected $table = 'system_info';

    protected $fillable = [
        'carousel_images',
        'about',
        'description',
        'address',
        'about_images',
        'services',
        'ophthalmologists',
    ];

    protected $casts = [
        'carousel_images' => 'array',
        'about_images' => 'array',
        'services' => 'array',
        'ophthalmologists' => 'array',
    ];
}
