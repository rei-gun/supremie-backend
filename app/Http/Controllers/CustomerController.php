<?php

namespace App\Http\Controllers;



use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Log;
use App\Order;
use App\Mie;
use App\Topping;
use App\Drink;
use App\StockDrink;
use App\StockMie;
use App\StockTopping;
use App\Events\NewOrder;
use DB;
use Event;

class CustomerController extends Controller
{

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
            try {
                DB::beginTransaction();
                $order = $request->get('order');
    		    $tmp_order = new Order;
                $tmp_order->payment_method = $order['payment_method'];
                //if payment_method is card, then order must be paid already
                //if ($tmp_order->payment_method == "card") {
                  //  $tmp_order->paid = true;
               // }
                $tmp_order->dining_method = $order['dining_method'];
    		$tmp_order->total_price = $order['total_price'];
                $tmp_order->save();
		if (strlen(strval($tmp_order->id)) > 1) {
		    $order_number = substr(strval($tmp_order->id), -2);
		} else {
		    $order_number = (string)$tmp_order->id;
		}
		$tmp_order->order_number = strval($order_number);
		$tmp_order->save();
                $mies = $order['mies'];
                foreach ($mies as $mie) {
                    $tmp_mie = new Mie;
                    $tmp_mie->mie_id = $mie['id'];
                    $tmp_stock_mie = StockMie::findOrFail($mie['id']);
                    $tmp_mie->name = $tmp_stock_mie['brand'].": ".$tmp_stock_mie['flavour'];
                    //since enums in mySQL are strings, convert to string if extra_chili 
                    //is an integer
                    if (is_string($mie['extra_chili'])) {
                        $tmp_mie->extra_chili = $mie['extra_chili'];
                    } else {
                        $tmp_mie->extra_chili = (string)$mie['extra_chili'];
                    }
                    $tmp_mie->quantity_mie = $mie['quantity_mie'];
                    $tmp_mie->quantity_whole = $mie['quantity_whole'];
		    $tmp_mie->price = $mie['price'];
		    // $discount = $mie['price']/2;
		    // $tmp_order->total_price -= $discount;
		    // $tmp_order->save();
                    $tmp_mie->note = $mie['note'];
                    $tmp_order->mies()->save($tmp_mie);
                    $tmp_stock_mie->stock -= $tmp_mie->quantity_mie;
                    $tmp_stock_mie->save();
                    $toppings = $mie['toppings'];
                    foreach ($toppings as $topping) {
                        $tmp_topping = new Topping;
                        $tmp_topping->topping_id = $topping['id'];
                        $tmp_stock_topping = StockTopping::findOrFail($topping['id']);
                        $tmp_topping->name = $tmp_stock_topping['name'];
                        $tmp_topping->quantity = $topping['quantity'];
                        $tmp_topping->price = $topping['price'];
                        //check if the topping has extra detail: type e.g. telur "dadar"
                        if (array_key_exists('type', $topping)) {
                            $tmp_topping->type = $topping['type'];
                            $tmp_topping->name .= " ".$topping['type'];
                        }
                        $tmp_mie->toppings()->save($tmp_topping);
                        $tmp_stock_topping->stock -= $tmp_topping->quantity;
                        $tmp_stock_topping->save();
                    }
                }
                $drinks = $order['drinks'];
                foreach ($drinks as $drink) {
                    $tmp_drink = new Drink;
                    $tmp_drink->drink_id = $drink['id'];
                    $tmp_stock_drink = StockDrink::findOrFail($drink['id']);
                    $tmp_drink->name = $tmp_stock_drink['brand']." ";
                    $tmp_drink->quantity = $drink['quantity'];
                    $tmp_drink->price = $drink['price'];
                    $tmp_order->drinks()->save($tmp_drink);
                    $tmp_stock_drink->stock -= $tmp_drink->quantity;
                    $tmp_stock_drink->save();
                }
                DB::commit();
                Event::fire(new NewOrder("HERP")); //fire NewOrder signal
                return response()->json(['status_code'=>200,"message"=>'Order Success!',"id"=>$tmp_order->order_number],200);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['status_code'=>500,"message"=>$e->getMessage()],500);
            }
        }

        /**
        * Update the specified order's "paid" column to true
        * @param  int  $id
        * @return Response
        */
        public function mark_paid($id)
        {
            DB::table('order')
                ->where('id', $id)
                ->update(['paid' => true]);

            return $this->index();;
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
