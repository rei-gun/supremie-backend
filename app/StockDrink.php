<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDrink extends Model
{
    //
    protected $table = "stock_drink";

    // Set empty array to enable mass assignment, that mean there is no black list (allow all column)
    protected $guarded=[];
    
    /**
      * Get the dishes under the order
     */
    public function drink()
    {
        return $this->hasMany('App\Drink','drink_id');
    }

    public function getBrandFlavourAttribute()
    {
        return trim($this->attributes['brand'].' '.$this->attributes['flavour']);
    }

    public function getLastOrderAttribute()
    {
        $last_order= $this->drink()->with(['order'=>function($query){
            $query->orderBy('order.created_at');
        }])->get()->first();
        if($last_order)
            return $last_order->order->created_at;
        return null;
    }
}
