<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockTopping extends Model
{
    //
    protected $table = "stock_topping";

    // Set empty array to enable mass assignment, that mean there is no black list (allow all column)
    protected $guarded=[];
    
    /**
      * Get the dishes under the order
     */
    public function topping()
    {
        return $this->hasMany('App\Topping');
    }
}
