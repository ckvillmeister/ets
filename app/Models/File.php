<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $fillable = [
        'filename',
        'type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'status'
    ];
}
