<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

}
