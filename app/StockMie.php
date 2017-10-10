<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockMie extends Model
{
    //
    protected $table = "stock_mie";
    protected $fillable=['brand','flavour','stock','price','img_url'];
    /**
      * Get the dishes under the order
     */
    public function dish()
    {
        return $this->hasMany('App\Mie','mie_id');
    }

    public function getBrandFlavourAttribute()
    {
        return trim($this->attributes['brand'].' '.$this->attributes['flavour']);
    }

    public function getLastOrderAttribute()
    {
        $last_order= $this->dish()->with(['order'=>function($query){
            $query->orderBy('order.created_at');
        }])->get()->first();
        if($last_order)
            return $last_order->order->created_at;
        return null;
    }
}
