<?php

use Illuminate\Database\Seeder;
use App\StockTopping;

class StockToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockTopping::create(['name'=>'Rendang', 'stock'=>10, 'price'=>10000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Saus Telor Asin', 'stock'=>10, 'price'=>7000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Ayam Jamur', 'stock'=>10, 'price'=>7000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Bakso Sapi', 'stock'=>10, 'price'=>5000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Abon Sapi', 'stock'=>10, 'price'=>5000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Nugget Ayam', 'stock'=>10, 'price'=>5000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Ayam Popcorn', 'stock'=>10, 'price'=>5000, 'img_url'=>'topping/coke']);
	StockTopping::create(['name'=>'Sambal Matah', 'stock'=>10, 'price'=>5000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Sosis', 'stock'=>10, 'price'=>5000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Keju Mozarella', 'stock'=>10, 'price'=>4000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Telor Ceplok', 'stock'=>10, 'price'=>4000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Kol Goreng', 'stock'=>10, 'price'=>3000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Caisim', 'stock'=>10, 'price'=>2000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Kacang Pilus', 'stock'=>10, 'price'=>2000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Jagung', 'stock'=>10, 'price'=>2000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Rumput Laut', 'stock'=>10, 'price'=>2000, 'img_url'=>'topping/coke']);
        StockTopping::create(['name'=>'Kerupuk Bawang', 'stock'=>10, 'price'=>2000, 'img_url'=>'topping/coke']);
    }
}
