<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attachments;
use App\Models\Category;
use App\Models\User;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = [
        'category',
        'series',
        'title',
        'description',
        'doc_date',
        'sender',
        'datetimesent',
        'recipient',
        'datetimereceived',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'status'
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category');
    }

    public function attachments(){
        return $this->hasMany(Attachments::class, 'document_id', 'id');
    }

    public function creator(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
