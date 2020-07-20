<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
