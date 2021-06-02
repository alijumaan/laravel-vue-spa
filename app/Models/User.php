<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, SearchableTrait, HasApiTokens;

    protected $searchable = [
        'columns' => [
            'name' => 10,
            'username' => 10
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role_id',
        'password'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role_id == Role::IS_ADMIN;
    }

    public function isSupervisor()
    {
        return  in_array($this->role_id, [Role::IS_ADMIN, Role::IS_SUPERVISOR]);
    }

    public function roleId()
    {
        switch ($this->role_id) {
            case Role::IS_ADMIN:
                return 'مدير';
                break;
            case Role::IS_SUPERVISOR:
                return 'مشرف';
                break;
            case Role::IS_USER:
                return 'مستخدم';
                break;
        }
    }

    public function hasAllow($permission)
    {
        $role = $this->role()->first();

        return $role->permissions()->whereName($permission)->first() ? true : false;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

}
