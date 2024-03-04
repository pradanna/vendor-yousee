<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_rent',
        'rent_until'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function rent()
    {
        return $this->hasOne(ItemRent::class, 'item_id')
            ->orderBy('end', 'DESC');
    }

    public function rents()
    {
        return $this->hasMany(ItemRent::class, 'item_id')
            ->orderBy('end', 'DESC');
    }

    public function incoming_rent()
    {
        $now = Carbon::now()->format('Y-m-d');
        return $this->hasOne(ItemRent::class, 'item_id')
            ->where('end', '>', $now)
            ->orderBy('end', 'ASC');
    }

    public function getStatusOnRentAttribute()
    {
        $now = Carbon::now()->format('Y-m-d');
        $rents = $this->rents()->where('end', '>', $now)->get();
        $result = 'empty';
        if (count($rents) > 0) {
            foreach ($rents as $rent) {
                $dateNow = Carbon::now();
                $dateStart = date('Y-m-d', strtotime($rent->start));
                $dateEnd = date('Y-m-d', strtotime($rent->end));
                if (($dateNow > $dateStart) && ($dateNow < $dateEnd)) {
                    $result = 'used';
                    break;
                } else {
                    $result = 'will used';
                }
            }
            return $result;
        }
        return $result;
    }
}
