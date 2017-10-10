<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topping', function (Blueprint $table) {
            $table->integer('mie_id')->unsigned();
            $table->foreign('mie_id')->references('id')->on('mie')->onUpdate('CASCADE')->onDelete("CASCADE");
            $table->integer('topping_id')->unsigned();
            $table->foreign('topping_id')->references('id')->on('stock_topping')->onUpdate('CASCADE')->onDelete("CASCADE");
            $table->string('name', 50);
            $table->string('type', 30)->nullable();
            $table->string('price', 50);
            $table->smallInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topping');
    }
}
