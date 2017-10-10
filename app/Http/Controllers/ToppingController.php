<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\StockTopping;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = StockTopping::paginate();
        return view('stocks.topping.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('stocks.topping.create');
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
            'name'=>'required|max:255',
            'stock'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
        ];
        $fields=['name','stock','price','img_url'];
        $validator=Validator::make($request->only($fields),$rules);
        if($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        $new_topping = new StockTopping;
        $new_topping = $request->only($fields);
        $new_topping['img_url'] = "img/url";
        StockTopping::create($new_topping);
        return redirect()->back()->withSuccess('Adding data topping has been successfully.');
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
        $model=StockTopping::findOrFail($id);
        return view('stocks.topping.edit',compact('model'));
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
            'name'=>'required|max:255',
            'stock'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
        ];
        $fields=['name','stock','price'];
        $validator=Validator::make($request->only($fields),$rules);
        if($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        $topping=StockTopping::findOrFail($id);
        $topping->name=$request->name;
        $topping->stock=$request->stock;
        $topping->price=$request->price;
        $topping->active=$request->input('active',0);
        $topping->save();
        return redirect()->back()->withSuccess('Updating data topping has been successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topping=StockTopping::findOrFail($id);
        $topping->delete();
        return redirect(route('topping.index'))->withSuccess('Deleting data topping has been successfully.');
    }
}
