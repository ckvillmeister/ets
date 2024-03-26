<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'category',
        'is_with_series_no',
        'is_with_sender',
        'is_with_receiver',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'status'
    ];
}
