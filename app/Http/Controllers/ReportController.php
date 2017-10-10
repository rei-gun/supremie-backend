<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\StockMie;
use App\StockDrink;
use Carbon\Carbon;
use Excel;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter=array();
        $filter['limit']=$request->get('limit',15);
        $filter['paid']=$request->get('paid',false);
        $filter['cooked']=$request->get('cooked',false);
        $filter['all_status']=$request->get('all_status',true);
        $filter['from']=$request->get('from',null);
        $filter['to']=$request->get('to',null);
        $filter['from_price']=$request->get('from_price',null);
        $filter['to_price']=$request->get('to_price',null);
        $filter['periode']=$request->get('periode','all');
        $query=Order::query();
        if($filter['paid']||$filter['cooked'])
            $filter['all_status']=false;
        if(!$filter['all_status'])
            $query=$query->where([['paid',$filter['paid']],['cooked',$filter['cooked']]]);
        $list=$this->queryPriode($filter['periode'],$query,$filter['from'],$filter['to'])
        ->paginate($filter['limit']);
        return view('reports.order',compact(['list','filter']));
    }

    function queryPriode($type,$query,$from=null,$to=null)
    {
        $today=Carbon::now();
        // dd($type);
        switch ($type) {
            case 'today':
                return $query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = '".$today->format('Y-m-d')."'");
            case 'yesterday':
                return $query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = '".$today->subDay()->format('Y-m-d')."'");
            case 'this_week':
                $dayOfWeek=$today->dayOfWeek;
                $startDate=$today->subDay($dayOfWeek);
                return $query->whereBetween("created_at",[$startDate->format('Y-m-d'),$startDate->addDay(6)->format('Y-m-d')]);
            case 'this_month':
                return $query->whereRaw("DATE_FORMAT(created_at,'%Y-%m') = '".$today->subDay()->format('Y-m')."'");
            case 'this_year':
                return $query->whereYear("created_at",$today->year);
            case 'custom':
                if(isset($from)&&isset($to))
                return $query->whereBetween("created_at",
                    [Carbon::parse($from)->format('Y-m-d'),Carbon::parse($to)->format('Y-m-d')]
                    );
            default:
                return $query;
        }
    }
    public function exportOrder($type, Request $request)
    {
        $filter=array();
        $filter['limit']=$request->input('limit',15);
        $filter['paid']=$request->input('paid',false);
        $filter['cooked']=$request->input('cooked',false);
        $filter['all_status']=$request->input('all_status',true);
        $filter['from']=$request->input('from',null);
        $filter['to']=$request->input('to',null);
        $filter['from_price']=$request->input('from_price',null);
        $filter['to_price']=$request->input('to_price',null);
        $filter['periode']=$request->input('periode','all');
        $query=Order::query();
        if($filter['paid']||$filter['cooked'])
            $filter['all_status']=false;
        if(!$filter['all_status'])
            $query=$query->where([['paid',$filter['paid']],['cooked',$filter['cooked']]]);
        $list=$this->queryPriode($request->input('periode','all'),$query,$filter['from'],$filter['to'])
        // ->selectRaw('id, created_at, total_price, paid, cooked')
        ->get();        
        // Define the Excel spreadsheet headers
        // $orderArray[] = ['id','order date','total price','paid','cooked'];
        // foreach ($list as $order) {
        //     $orderArray[] = $order->toArray();
        // }
                // dd($filter);
        Excel::create('orders_supremie_'.Carbon::now()->format('Ymdhis'), function($excel) use ($list,$filter) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Order');
            $excel->setCreator('Permadi Wibisono')->setCompany('Supremie');
            $excel->setDescription('Order Reports');
            $options=['all'=>'All','yesterday'=>'Yesterday','this_week'=>'This Week','this_month'=>'This Month','this_year'=>'This Year','custom'=>'custom'];
            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($list,$filter,$options) {
                $sub_title='Periode : '.($filter['periode']!='custom'?$options[$filter['periode']]:$filter['from'].' - '.$filter['from']);
                $sheet->loadView('reports.export.order_xls',array('list' => $list,'sub_title'=>$sub_title));
            });

        })->download($type);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStockMie()
    {
        $list=StockMie::
            whereHas('dish.order',function($query){
                $query->where('paid',1);
            })
            ->selectRaw('stock_mie.*, sum(mie.quantity_mie) as total_out, sum(mie.price) as total_price')
            ->join('mie','mie.mie_id', '=', 'stock_mie.id')
            ->join('order','mie.order_id', '=', 'order.id')
            ->where('order.paid',1)
            ->groupBy(['stock_mie.id',
                'stock_mie.brand',
                'stock_mie.flavour',
                'stock_mie.price',
                'stock_mie.active',
                'stock_mie.created_at',
                'stock_mie.updated_at',
                'stock_mie.img_url',
                'stock_mie.stock'])
            ->paginate();
            // dd($list);
        return view('reports.stock_mie',compact('list'));
    }
    public function indexStockDrink()
    {
        $list=StockDrink::
            whereHas('drink.order',function($query){
                $query->where('paid',1);
            })
            ->selectRaw('stock_drink.*, sum(drink.quantity) as total_out')
            ->join('drink','drink.drink_id', '=', 'stock_drink.id')
            ->join('order','drink.order_id', '=', 'order.id')
            ->where('order.paid',1)
            ->groupBy(['stock_drink.id',
                'stock_drink.brand',
                'stock_drink.flavour',
                'stock_drink.price',
                'stock_drink.active',
                'stock_drink.created_at',
                'stock_drink.updated_at',
                'stock_drink.img_url',
                'stock_drink.stock'])
            ->paginate();
            // dd($list);
        return view('reports.stock_drink',compact('list'));
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
