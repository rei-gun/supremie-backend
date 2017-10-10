<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Log;
use App\Order;
use App\mie;
use App\Topping;
use DB;

use Datatables;
use Yajra\Datatables\Html\Builder;

class KitchenController extends Controller
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
                return Datatables::of(Order::query()->where('cooked', false)->where('paid', true))
                ->addColumn('cook', function($order) {
                    $url = route('kitchen_cooked', ['id'=>$order->id]);
                    return "<a href={$url}>Di Masak</a>";
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
                ->rawColumns(['mies', 'cook'])
                ->make(true);
            }

            $html = $this->builder->columns([
                        ['data' => 'order_number', 'name' => 'order_number', 'title' => 'Order No.'],
                        ['data' => 'total_price', 'name' => 'total_price', 'title' => 'Total'],
                        ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                        ['data' => 'dining_method', 'name' => 'dining_method', 'title' => 'Cara Makan'],
                        ['data' => 'mies', 'name' => 'order.mies.name', 'title' => 'Details',
                            'render'         => null,
                            'orderable'      => false,
                            'searchable'     => true,
                            'exportable'     => false,
                            'printable'      => true,
                            'footer'         => '',
                        ],
                        [
                            'defaultContent' => '',
                            'data'           => 'cook',
                            'name'           => 'cook',
                            'title'          => 'Dimasak',
                            'render'         => null,
                            'orderable'      => false,
                            'searchable'     => false,
                            'exportable'     => false,
                            'printable'      => true,
                            'footer'         => '',
                        ]
                    ]);

            return view('kitchen', compact('html'));
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
        public function mark_cooked($id)
        {
            Order::where('id', $id)->update(['cooked' => true]);
            return redirect()->to('/kitchen/orders');
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
