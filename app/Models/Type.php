<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Item::class, 'type_id')
            ->where('vendor_id', '=', auth()->id());
    }

    public function getItemsCountAttribute()
    {
        return $this->items()->count() > 0 ? $this->items()->count() : 0;
    }
}
