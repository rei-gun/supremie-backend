<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\StockDrink;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = StockDrink::paginate();
        return view('stocks.drink.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('stocks.drink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'brand'=>'required|max:80',
            'flavour'=>'required|max:255',
            'stock'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
        ];
        $fields=['brand','flavour','stock','price','img_url'];
        $validator=Validator::make($request->only($fields),$rules);
        if($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        $new_drink = new StockDrink;
        $new_drink = $request->only($fields);
        $new_drink['img_url'] = "img/url";
        StockDrink::create($new_drink);
        return redirect()->back()->withSuccess('Adding data drink has been successfully.');
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
        $model=StockDrink::findOrFail($id);
        return view('stocks.drink.edit',compact('model'));
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
        $rules=[
            'brand'=>'required|max:80',
            'flavour'=>'required|max:255',
            'stock'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
        ];
        $fields=['brand','flavour','stock','price'];
        $validator=Validator::make($request->only($fields),$rules);
        if($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        $drink=StockDrink::findOrFail($id);
        $drink->brand=$request->brand;
        $drink->flavour=$request->flavour;
        $drink->stock=$request->stock;
        $drink->price=$request->price;
        $drink->active=$request->input('active',0);
        $drink->save();
        return redirect()->back()->withSuccess('Updating data drink has been successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drink=StockDrink::findOrFail($id);
        $drink->delete();
        return redirect(route('drink.index'))->withSuccess('Deleting data drink has been successfully.');
    }
}
