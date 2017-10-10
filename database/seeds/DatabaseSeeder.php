<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(OrderTableSeeder::class);
        $this->call(StockMieSeeder::class);
        $this->call(StockToppingSeeder::class);
        $this->call(StockDrinkSeeder::class);
        //$this->call(OrderSeeder::class);
    }
}
