<?php

namespace App\Models;

use App\Helper\SlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class Building extends Model
{
    use HasFactory, SearchableTrait, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'number',
        'status',
        'user_id',
        'period_id',
        'notes',
        'checked_at'
    ];

    public const ONE_MONTH = 1;
    public const THREE_MONTHS = 2;
    public const SIX_MONTHS = 3;
    public const YEAR = 4;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [
        'columns' => [
            'name' => 10,
            'number' => 10,
            'period_id' => 10,
            'status' => 10,
        ]
    ];

    public $timestamps = ['checked_at'];

    protected $casts = [
        'checked_at' => 'datetime:Y-m-d',
    ];


//    protected $dispatchesEvents = [
//        'checked-building' => ExtinguisherExpiredPeriod::class,
//    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function extinguishers()
    {
        return $this->belongsToMany(Extinguisher::class, 'building_extinguishers', 'building_id', 'extinguisher_id');
    }

    public function periods()
    {
        return $this->belongsTo(Period::class);
    }

    public function status()
    {
//        return $this->status == 1 ? 'مشيك' : 'منتهي';
        return $this->status == 1 ? __('message.valid') : __('message.invalid');
    }

    public function periodArabic()
    {
        switch ($this->period_id) {
            case Building::ONE_MONTH:
                return 'شهري';

            case Building::THREE_MONTHS:
                return 'كل ثلاث أشهر';

            case Building::SIX_MONTHS:
                return 'كل ستة أشهر';

            case Building::YEAR:
                return 'سنوي';

        }
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = SlugHelper::uniqueSlug($value, 'buildings');
    }
}
