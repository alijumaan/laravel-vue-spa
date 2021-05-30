<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = ['period'];

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function timeNameArabic()
    {
        switch ($this->period) {
            case 'month':
                return 'شهري';

            case 'three_months':
                return 'كل ثلاث أشهر';

            case 'six_months':
                return 'كل ستة أشهر';

            case 'year':
                return 'سنوي';

        }
    }
}
