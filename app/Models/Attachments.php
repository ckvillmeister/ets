<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Attachments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'document_attachments';
    protected $fillable = [
        'document_id',
        'file_id',
    ];

    public function info(){
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
