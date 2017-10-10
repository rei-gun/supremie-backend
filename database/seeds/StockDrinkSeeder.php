<?php

use Illuminate\Database\Seeder;
use App\StockDrink;

class StockDrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockDrink::create(['brand'=>'Supremie Coffee', 'flavour'=>'blabla', 'stock'=>10, 'price'=>8000, 'img_url'=>'drink/coffee']);
        StockDrink::create(['brand'=>'Coca Cola', 'flavour'=>'Plain', 'stock'=>10, 'price'=>6000, 'img_url'=>'drink/coke']);
        StockDrink::create(['brand'=>'Teh Botol Kotak', 'flavour'=>'Plain', 'stock'=>10, 'price'=>6000, 'img_url'=>'drink/teh_botol']);
        StockDrink::create(['brand'=>'Sprite', 'flavour'=>'Plain', 'stock'=>10, 'price'=>6000, 'img_url'=>'drink/sprite']);
        StockDrink::create(['brand'=>'Fanta', 'flavour'=>'Orange', 'stock'=>10, 'price'=>6000, 'img_url'=>'drink/fanta']);
        StockDrink::create(['brand'=>'Fruit Tea Apple', 'flavour'=>'Apple', 'stock'=>10, 'price'=>6000, 'img_url'=>'drink/fanta']);
        StockDrink::create(['brand'=>'Nestea', 'flavour'=>'Apel', 'stock'=>10, 'price'=>5000, 'img_url'=>'drink/fruit_tea', 'active'=>false]);
        StockDrink::create(['brand'=>'Prima 330ml', 'flavour'=>'Air Putih', 'stock'=>10, 'price'=>5000, 'img_url'=>'drink/air_putih']);
        StockDrink::create(['brand'=>'Es Teh', 'flavour'=>'Es Teh Manis (refill)', 'stock'=>10, 'price'=>5000, 'img_url'=>'drink/teh']);
        StockDrink::create(['brand'=>'Teh', 'flavour'=>'Es Teh Tawar (refill)', 'stock'=>10, 'price'=>4000, 'img_url'=>'drink/teh']);
    }
}