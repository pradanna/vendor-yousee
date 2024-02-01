<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

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
}
