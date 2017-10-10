<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Mie;
use App\Topping;
use App\Drink;
// require_once '/path/to/Faker/src/autoload.php';

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
	for ($i=0; $i<99; $i++) {
        Order::create(['total_price'=>20000, 'payment_method'=>'cash', 'dining_method'=>"makan sini", 'order_number'=>'A11']);
        $order_ids = Order::pluck('id')->all();
        Mie::create(['order_id'=>$faker->randomElement($order_ids), 'mie_id'=>3, 'name'=>"herpderp", 'extra_chili'=>'1',
            'quantity_mie'=>1, 'quantity_whole'=>1, 'price'=>5000]);
        $mie_ids = Mie::pluck('id')->all();
        Topping::create(['mie_id'=>$faker->randomElement($mie_ids), 'topping_id'=>3,'name'=>'great topping', 'price'=>1000, 'quantity'=>1]);
        Drink::create(['order_id'=>$faker->randomElement($order_ids), 'drink_id'=>4, 'quantity'=>1, 'name'=>'cool drink', 
		'price'=>1000]);
	}
    }
}
