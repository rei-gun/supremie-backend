<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    //
    protected $table = "drink";
    public $timestamps = false;

    /**
     * Get the order that owns the dish.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function stock_drink() {
        return $this->belongsTo('App\StockDrink');
    }
}
