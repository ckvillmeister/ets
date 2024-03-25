<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Document;

class DocumentHistory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'document_histories';
    protected $fillable = [
        'document_id',
        'action',
        'executed_by',
        'execution_date'
    ];

    public function executor(){
        return $this->hasOne(User::class, 'id', 'executed_by');
    }

    public function document_info(){
    	return $this->hasOne(Document::class, 'id', 'document_id');
    }
}
