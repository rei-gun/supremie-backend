<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Log;
use App\Order;
use App\Dish;
use App\Topping;
use App\Drink;
use App\StockDrink;
use App\StockMie;
use App\StockTopping;
use DB;

class StockController extends Controller
{


    	/**
        * Display a listing of Orders that have not been paid.
        * @return Response
        */
        public function index()
        {
            $stockDrink = StockDrink::select('id', 'brand', 'flavour', 'stock', 'price', 'img_url')->where('active', true)->orderBy('price', 'desc')->get();
            $stockMie = StockMie::select('id', 'brand', 'flavour', 'stock', 'price', 'img_url')->where('active', true)->orderBy('price', 'desc')->get();
            $stockTopping = StockTopping::select('id', 'name', 'stock', 'price', 'img_url')->where('active', true)->orderBy('price', 'desc')->get();
            $json_response = array("mie"=>$stockMie, "drinks"=>$stockDrink, "toppings"=>$stockTopping);

            return json_encode($json_response);
        }
        
        /**
        * Show the form for creating a new resource.
        * @return Response
        */
        public function create()
        {
        }
        
        /**
        * Store a newly created order.
        * @return Response
        */
        public function store(Request $request)
        {

        }

    
        /**
        * Display the specified resource.
        * @param  int  $id
        * @return Response
        */
        public function show($id)
        {
        }
    
        /**
        * Show the form for editing the specified resource.
        * @param  int  $id
        * @return Response
        */
        public function edit($id)
        {
        }
    
        /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
        public function update($id)
        {
        }
    
        /**
        * Remove the specified resource from storage.
        * @param  int  $id
        * @return Response
        */
        public function destroy($id)
        {
        }

}
