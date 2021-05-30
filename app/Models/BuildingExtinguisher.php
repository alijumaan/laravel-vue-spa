<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingExtinguisher extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'building_id', 'extinguisher_id'];
}
