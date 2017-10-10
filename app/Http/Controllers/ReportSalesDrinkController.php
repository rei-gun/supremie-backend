<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;
use Carbon\Carbon;
use Excel;

class ReportSalesDrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter=array();
        $filter['limit']=$request->input('limit',15);
        $filter['from']=$request->input('from',null);
        $filter['to']=$request->input('to',null);
        $filter['periode']=$request->input('periode','all');
        $query=Drink::
            join('order','order.id','=','drink.order_id')
            ->whereHas('order',function($query){
                $query->where([['paid',1],['cooked',1]]);
            });
        $list=$this->queryPriode($filter['periode'],$query,$filter['from'],$filter['to'])
            ->paginate($filter['limit']);
        return view('reports.sales_drink',compact(['list','filter']));
    }

    public function export($type, Request $request)
    {
        $filter=array();
        $filter['limit']=$request->input('limit',15);
        $filter['from']=$request->input('from',null);
        $filter['to']=$request->input('to',null);
        $filter['periode']=$request->input('periode','all');
        $query=Drink::join('order','order.id','=','drink.order_id')
            ->whereHas('order',function($query){
                $query->where([['paid',1],['cooked',1]]);
            });
        $list=$this->queryPriode($filter['periode'],$query,$filter['from'],$filter['to'])
        ->get();        
        // Define the Excel spreadsheet headers
        // $orderArray[] = ['id','order date','total price','paid','cooked'];
        // foreach ($list as $order) {
        //     $orderArray[] = $order->toArray();
        // }
                // dd($filter);
        Excel::create('sales_drink_supremie_'.Carbon::now()->format('Ymdhis'), function($excel) use ($list,$filter) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Sale Drink Reports');
            $excel->setCreator('Permadi Wibisono')->setCompany('Supremie');
            $excel->setDescription('Sale Drink Reports');
            $options=['all'=>'All','yesterday'=>'Yesterday','this_week'=>'This Week','this_month'=>'This Month','this_year'=>'This Year','custom'=>'custom'];
            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($list,$filter,$options) {
                $sub_title='Periode : '.($filter['periode']!='custom'?$options[$filter['periode']]:$filter['from'].' - '.$filter['from']);
                $sheet->loadView('reports.export.sales_drink_xls',array('list' => $list,'sub_title'=>$sub_title));
            });

        })->download($type);
    }

    function queryPriode($type,$query,$from=null,$to=null)
    {
        $today=Carbon::now();
        // dd($type);
        switch ($type) {
            case 'today':
                return $query->whereRaw("DATE_FORMAT(order.created_at,'%Y-%m-%d') = '".$today->format('Y-m-d')."'");
            case 'yesterday':
                return $query->whereRaw("DATE_FORMAT(order.created_at,'%Y-%m-%d') = '".$today->subDay()->format('Y-m-d')."'");
            case 'this_week':
                $dayOfWeek=$today->dayOfWeek;
                $startDate=$today->subDay($dayOfWeek);
                return $query->whereBetween("order.created_at",[$startDate->format('Y-m-d'),$startDate->addDay(6)->format('Y-m-d')]);
            case 'this_month':
                return $query->whereRaw("DATE_FORMAT(order.created_at,'%Y-%m') = '".$today->subDay()->format('Y-m')."'");
            case 'this_year':
                return $query->whereYear("order.created_at",$today->year);
            case 'custom':
                if(isset($from)&&isset($to))
                return $query->whereBetween("order.created_at",
                    [Carbon::parse($from)->format('Y-m-d'),Carbon::parse($to)->format('Y-m-d')]
                    );
            default:
                return $query;
        }
    }
}
