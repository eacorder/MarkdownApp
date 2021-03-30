<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $casts = [
        'tags' => 'array',
        'created_at' => 'datetime:Y-m-d',
    ];

    
}
