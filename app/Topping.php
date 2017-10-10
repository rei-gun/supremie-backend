<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    //
    protected $table = "topping";
    public $timestamps = false;

    /**
     * Get the order that owns the dish.
     */
    public function dish()
    {
        return $this->belongsTo('App\Mie');
    }
}
