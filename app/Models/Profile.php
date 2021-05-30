<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'avatar', 'bio'];

    public function avatar()
    {
        return asset('storage/assets/avatars/'. $this->avatar);
    }
}
