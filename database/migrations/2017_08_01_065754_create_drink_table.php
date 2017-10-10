<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drink', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order')->onUpdate('CASCADE')->onDelete("CASCADE");
            $table->integer('drink_id')->unsigned();
            $table->foreign('drink_id')->references('id')->on('stock_drink')->onUpdate('CASCADE')->onDelete("CASCADE");
            $table->string('name', 50);
            $table->smallInteger('quantity');
            $table->mediumInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drink');
    }
}
