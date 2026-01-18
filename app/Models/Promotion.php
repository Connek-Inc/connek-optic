<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'type',
        'features',
        'active',
    ];

    protected $cast = [
        'features' => 'array',
        'active' => 'boolean',
    ];

    // Ensure features is always an array
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'active' => 'boolean',
        ];
    }
}
