<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number', 4)->nullable();
            $table->mediumInteger('total_price');
            $table->boolean('paid')->default(false);
            $table->boolean('cooked')->default(false);
            $table->enum('payment_method', ["card", "cash"]);
            $table->enum('dining_method', ["makan sini", "bungkus"]);
            $table->boolean('cancelled')->default(false);
            $table->string('cashlez_id', 50)->nullable();
            $table->string('tax_id', 50)->nullable();
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
        Schema::dropIfExists('order');
    }
}
