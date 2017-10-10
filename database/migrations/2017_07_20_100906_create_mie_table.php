    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order')->onUpdate('CASCADE')->onDelete("CASCADE");
            $table->integer('mie_id')->unsigned();
            $table->foreign('mie_id')->references('id')->on('stock_mie')->onUpdate('CASCADE')->onDelete("CASCADE");
            $table->string('name',100);
            $table->enum('extra_chili', [0, 1, 2, 3, 4])->nullable();
            $table->tinyInteger('quantity_mie');
            $table->tinyInteger('quantity_whole');
            $table->mediumInteger('price');
            $table->string('note', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mie');
    }
}
