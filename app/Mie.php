<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mie extends Model
{
    //
    protected $table = "mie";
    public $timestamps = false;

    /**
     * Get the order that owns the dish.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function toppings() {
        return $this->hasMany('App\Topping');
    }

    public function mie() {
        return $this->belongsTo('App\StockMie');
    }
}
