<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'to', 'icon', 'access'];

    public function scopeAccessable($query)
    {
        return $query->whereAccess(1);
    }

    public function getAccessAttribute(): string
    {
        return $this->attributes['access'] == 0 ? 'hide' : 'show';
    }
}
