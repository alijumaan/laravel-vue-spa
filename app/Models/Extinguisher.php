<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extinguisher extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'notes'];

    public function extinguisherBuildings()
    {
        return $this->belongsToMany(Building::class, 'building_extinguishers');
    }

    public function extinguisherType()
    {
        switch ($this->type) {
            case 'water':
                return 'ماء';

            case 'foam':
                return 'رغوة';

            case 'powder':
                return 'بودرة';

            case 'co2':
                return 'ثاني اكسيد الكربون';
        }
    }

}
