<?php

use Illuminate\Database\Seeder;
use App\StockMie;

class StockMieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockMie::create(['brand'=>'Indomie', 'flavour'=>'Mie Goreng Rendang', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Indomie', 'flavour'=>'Ayam Bawang', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Indomie', 'flavour'=>'Mie Goreng Cabe Ijo', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Indomie', 'flavour'=>'Soto Mie', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Indomie', 'flavour'=>'Original', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Indomie', 'flavour'=>'Kari Ayam', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);

        StockMie::create(['brand'=>'Mie Sedaap', 'flavour'=>'Original', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Mie Sedaap', 'flavour'=>'Sambal Goreng', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Mie Sedaap', 'flavour'=>'White Curry', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Mie Sedaap', 'flavour'=>'Baso Spesial', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'MI ABC', 'flavour'=>'Ayam Pedas Limau', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke', 'active'=>false]);
        StockMie::create(['brand'=>'MI ABC', 'flavour'=>'Ayam Bawang', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'MI ABC', 'flavour'=>'Gulai Ayam Pedas', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'MI ABC', 'flavour'=>'Semur Ayam Pedas', 'stock'=>10, 'price'=>8000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'NISSIN', 'flavour'=>'Gekikara Ramen Seafood', 'stock'=>10, 'price'=>12000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'NISSIN', 'flavour'=>'Mikuya Ramen (Kedelai Hitam)', 'stock'=>10, 'price'=>12000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'NISSIN', 'flavour'=>'Gekikara Ramen Pedas', 'stock'=>10, 'price'=>12000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Nongshim', 'flavour'=>'Shin Ramyun', 'stock'=>10, 'price'=>18000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Nongshim', 'flavour'=>'Chapagetti', 'stock'=>10,  'price'=>18000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Nongshim', 'flavour'=>'Neoguri', 'stock'=>10,  'price'=>18000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Samyang', 'flavour'=>'Original', 'stock'=>10, 'price'=>22000/2, 'img_url'=>'mie/coke']);
        StockMie::create(['brand'=>'Samyang', 'flavour'=>'Cheese', 'stock'=>10, 'price'=>22000/2, 'img_url'=>'mie/coke']);
    }
}
