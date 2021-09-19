<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role'];

    public const ADMIN = 1;
    public const SUPERVISOR = 2;
    public const USER = 3;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
