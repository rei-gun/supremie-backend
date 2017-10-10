<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

use Datatables;
use Yajra\Datatables\Html\Builder;

class OrderController extends Controller
{
    function __construct(Builder $builder)
    {
        $this->builder=$builder;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $fields=['order.id','order.total_price','order.created_at','order.updated_at','paid','cancelled','cooked'];
            return Datatables::of(Order::with(['mies','drinks','mies.toppings'])
                // ->where([['cooked', false],['paid', true]])
                ->leftJoin('mie','order.id','=','mie.order_id')
                ->leftJoin('drink','order.id','=','drink.order_id')
                ->leftJoin('topping','mie.id','=','topping.mie_id')
                ->groupBy($fields)
                ->select($fields))
            ->filterColumn('details', function($query, $keyword) {
                $query->whereRaw("topping.name like ?", ["%{$keyword}%"]);
                $query->orWhereRaw("mie.name like ?", ["%{$keyword}%"]);
                $query->orWhereRaw("drink.name like ?", ["%{$keyword}%"]);
                $query->orWhereRaw("mie.note like ?", ["%{$keyword}%"]);
            })
            ->addColumn('status', function($order) {
                $status='<ul style="list-style-type:none; padding: 0; font-size:14px;">';
                $status.='<li><i class="fa fa-'.($order->paid?'check':'times').'"></i> Paid</li>';
                $status.='<li><i class="fa fa-'.($order->cancelled?'check':'times').'"></i> Cancel</li>';
                $status.='<li><i class="fa fa-'.($order->cooked?'check':'times').'"></i> Cooked</li>';
                $status.='</ul>';
                return $status;
            })
            // ->addColumn('cook', function($order) {
            //     $url = route('kitchen_cooked', ['id'=>$order->id]);
            //     return "<a href={$url}>Order Cooked</a>";
            // })
            ->editColumn('details', function($order) {
                $mies = $order->mies;
                $output = "<ul id='details'>";
                foreach($mies as $mie) {
                    $output .= "<li><b>".$mie['quantity_whole']." piring: </b>".$mie['quantity_mie']." ".$mie['name']." <span>||</span> ".$mie['firmness'].
                    "<ul><u>bubuk cabe:</u> ".$mie['chili_powder']." <span>||</span> <u>cabe rawit:</u> ".$mie['extra_chili']." <span>||</span> ";
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
            // ->rawColumns(['details', 'cook','status'])
            ->rawColumns(['details','status'])
            ->make(true);
        }

        $html = $this->builder->columns([
                    ['data' => 'id', 'name' => 'id', 'title' => 'Order ID'],
                    ['data' => 'total_price', 'name' => 'total_price', 'title' => 'Total'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Tgl. Order'],
                    ['data' => 'details', 'name' => 'details', 'title' => 'Detail',
                        'render'         => null,
                        'orderable'      => false,
                        'searchable'     => true,
                        'exportable'     => false,
                        'printable'      => true,
                        'footer'         => '',
                    ],
                    [   
                        'data'          => 'status',
                        'name'          => 'status', 
                        'title'         => 'Status',
                        'render'        => null,
                        'orderable'     => false,
                        'searchable'    => true,
                        'exportable'    => false,
                        'printable'     => true,
                        'footer'        => ''
                    ],
                    // ['data' => 'toppings', 'name' => 'dishes.toppings.name',
                    //     'render'         => null,
                    //     'searchable'     => true,
                    //     'visible'       =>false
                    // ],
                    // [
                    //     'defaultContent' => '',
                    //     'data'           => 'cook',
                    //     'name'           => 'cook',
                    //     'title'          => 'Cook Order',
                    //     'render'         => null,
                    //     'orderable'      => false,
                    //     'searchable'     => false,
                    //     'exportable'     => false,
                    //     'printable'      => true,
                    //     'footer'         => '',
                    // ]
                ]);

        return view('orders', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
