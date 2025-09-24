<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileable_type',
        'fileable_id',  
        'type',         
        'file_path',    
        'title',         
    ];

    
    public function fileable()
    {
        return $this->morphTo();
    }
}
