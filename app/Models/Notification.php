<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id', 
        'type',    
        'message',  
        'read',     
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function isRead(): bool
    {
        return (bool) $this->read;
    }

    public function isUnread(): bool
    {
        return !(bool) $this->read;
    }

    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('read', true);
    }
}
