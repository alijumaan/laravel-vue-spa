<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'title', 'body', 'user_id', 'is_read'];

    public function getIsReadAttribute()
    {
        return $this->attributes['is_read'] == 0 ? 'جديد' : 'مقروء';

    }
}
