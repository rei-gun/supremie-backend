<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockDrinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_drink', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand', 30);
            $table->string('flavour', 50);
            $table->integer('stock')->default(0);
	        $table->mediumInteger('price')->nullable();
            $table->boolean('active')->default(true);
            $table->string('img_url', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_drink');
    }
}
