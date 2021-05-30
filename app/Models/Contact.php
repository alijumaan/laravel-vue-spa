<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'title', 'body', 'user_id', 'is_read'];

    public function scopeIsRead()
    {
        return $this->is_read == 0 ? 'جديد' : 'مقروء';
    }

    public function scopeCreatedAt()
    {
        return $this->created_at->format('Y-m-d');
    }

    use HasFactory;
}
