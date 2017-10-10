<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "order";
    protected $fillable = ['paid'];

    /**
      * Get the dishes under the order
     */
    public function mies()
    {
        return $this->hasMany('App\Mie');
    }
    public function drinks()
    {
        return $this->hasMany('App\Drink');
    }
}
