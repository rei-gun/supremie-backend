<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('orders', 'CustomerController@store');
Route::get('cashier/orders', 'CashierController@index')->name('cashier.orders');
Route::get('kitchen/orders', 'KitchenController@index')->name('kitchen.orders');
// Route::get('orders', 'CashierController@mark_paid')->name('cashier_payment');
Route::get('orders/payments/{id}', 'CashierController@mark_paid')->name('cashier_payment');
Route::get('orders/cancellations/{id}', 'CashierController@mark_cancelled')->name('cancel_payment');
Route::get('orders/cooked/{id}', 'KitchenController@mark_cooked')->name('kitchen_cooked');
Route::get('orders', 'OrderController@index')->name('orders.index');

Route::get('stock', 'StockController@index')->name('stocks.index');
Route::group(['prefix'=>'stocks'],function(){
	Route::resource('topping','ToppingController');
	Route::resource('mie','MieController');
	Route::resource('drink','DrinkController');
});
Route::group(['prefix'=>'reports'],function(){
	Route::get('order','ReportController@index')->name('reports.order');
	Route::post('order/export/{type}','ReportController@exportOrder')->name('reports.export.order');
	Route::get('mie','ReportController@indexStockMie')->name('reports.mie');
	Route::get('drink','ReportController@indexStockDrink')->name('reports.drink');

	Route::get('sales_mie','ReportSalesMieController@index')->name('reports.sales_mie');
	Route::post('sales_mie/export/{type}','ReportSalesMieController@export')->name('reports.export.sales_mie');
	
	Route::get('sales_drink','ReportSalesDrinkController@index')->name('reports.sales_drink');
	Route::post('sales_drink/export/{type}','ReportSalesDrinkController@export')->name('reports.export.sales_drink');
});