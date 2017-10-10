<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Order;
use App\mie;
use App\Topping;
use App\StockDrink;
use App\StockMie;
use App\StockTopping;
use App\Events\OrderPaid;
use DB;


use Datatables;
use Yajra\Datatables\Html\Builder;

class CashierController extends Controller
{

        public function __construct(Builder $builder)
        {
            $this->builder=$builder;
        }
    	/**
        * Display a listing of Orders that have not been paid.
        * @return Response
        */
        public function index()
        {
            if (request()->ajax()) {
                return Datatables::of(Order::query()->where([['paid', false],['cancelled',false]]))
                ->addColumn('payment', function($order) {
                    $url = route('cashier_payment', ['id'=>$order->id]);
                    return "<a href={$url}>Uang Diterima</a>";
                })
                ->addColumn('cancel', function($order) {
                    $url = route('cancel_payment', ['id'=>$order->id]);
                    return "<a href={$url}>Cancel</a>";
                })
                ->editColumn('mies', function($order) {
                    $mies = $order->mies;
                    $output = "<ul id='details'>";
                    foreach($mies as $mie) {
                        $output .= "<li>".$mie['quantity_mie']." ".$mie['name']." <span>||</span> "."<ul><u>level cabe:</u> ".$mie['extra_chili']." <span>||</span> ";
                        $toppings = $mie->toppings;
                        foreach ($toppings as $topping) {
                            $output .= "<u>".$topping['name']."</u>: ".$topping['quantity']." <span>||</span> ";
                        }
                        $output .= " ".$mie['note']."</ul>";
                    }
                    $drinks = $order->drinks;
                    foreach($drinks as $drink) {
                        $output .= $drink['quantity']. " ".$drink['name']." <span>||</span> ";
                    }
                    return $output."</ul>";
                })
                ->rawColumns(['mies', 'payment', 'cancel'])
                ->make(true);
            }

            $html = $this->builder->columns([
                        ['data' => 'order_number', 'name' => 'order_number', 'title' => 'Order No.', 'searchable' => true],
                        ['data' => 'total_price', 'name' => 'total_price', 'title' => 'Total'],
                        ['data' => 'dining_method', 'name' => 'dining_method', 'title' => 'Cara Makan'],
                        ['data' => 'mies', 'name' => 'details', 'title' => 'Detail', 'searchable' => true],
                        [
                            'defaultContent' => '',
                            'data'           => 'cancel',
                            'name'           => 'cancel',
                            'title'          => 'Batalkan',
                            'render'         => null,
                            'orderable'      => false,
                            'searchable'     => false,
                            'exportable'     => false,
                            'printable'      => true,
                            'footer'         => '',
                        ],
                        [
                            'defaultContent' => '',
                            'data'           => 'payment',
                            'name'           => 'payment',
                            'title'          => 'Pembayaran',
                            'render'         => null,
                            'orderable'      => false,
                            'searchable'     => false,
                            'exportable'     => false,
                            'printable'      => true,
                            'footer'         => '',
                        ],


                    ]);

            return view('cashier', compact('html'));
        }

        public function approvePaymentAction()
        {
            return redirect()->to('/cashier/orders');
        }
        
        /**
        * Show the form for creating a new resource.
        * @return Response
        */
        public function create()
        {
        }
        

        /**
        * Update the specified order's "paid" column to true
        * @param  int  $id
        * @return Response
        */
        public function mark_paid($id)
        {
            $order = Order::where([['id',$id],['paid',false]])->get()->first();
            if($order)
            {
                $order->update(['paid' => true]);
                // update stock
                $mies = $order->mies;
                foreach ($mies as $mie) {
                    StockMie::findOrFail($mie->mie_id)->decrement('stock',$mie->quantity_mie);
                    $toppings = $mie->toppings;
                    foreach ($toppings as $topping) {
                        StockTopping::findOrFail($topping->topping_id)->decrement('stock', $topping->quantity);
                    }
                }
                $drinks = $order->drinks;
                foreach ($drinks as $drink) {
                    StockDrink::findOrFail($drink->drink_id)->decrement('stock', $drink->quantity);
                }
            }
            event(new OrderPaid("HERP")); 
            return redirect()->to('/cashier/orders');
        }

                /**
        * Update the specified order's "paid" column to true
        * @param  int  $id
        * @return Response
        */
        public function mark_cancelled($id)
        {
            Order::where('id',$id)->update(['cancelled'=>true]);
            return redirect()->to('/cashier/orders');
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
