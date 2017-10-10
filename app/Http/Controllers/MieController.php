<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\StockMie;

class MieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = StockMie::paginate();
        return view('stocks.mie.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('stocks.mie.create');
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
            'stock'=>'required|numeric',
            'price'=>'required|numeric|min:1',

        ];
        $fields=['brand','flavour','stock','price','img_url'];
        $validator=Validator::make($request->only($fields),$rules);
        if($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        $new_mie = new StockMie;
        $new_mie = $request->only($fields);
        $new_mie['img_url'] = "img/url";
        StockMie::create($new_mie);
        return redirect()->back()->withSuccess('Mie data has been successfully added.');
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
        $model=StockMie::findOrFail($id);
        return view('stocks.mie.edit',compact('model'));
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
        $mie=StockMie::findOrFail($id);
        $mie->brand=$request->brand;
        $mie->flavour=$request->flavour;
        $mie->stock=$request->stock;
        $mie->price=$request->price;
        $mie->active=$request->input('active',0);
        $mie->save();
        return redirect()->back()->withSuccess('Updating data mie has been successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mie=StockMie::findOrFail($id);
        $mie->delete();
        return redirect(route('mie.index'))->withSuccess('Deleting data mie has been successfully.');
    }
}
