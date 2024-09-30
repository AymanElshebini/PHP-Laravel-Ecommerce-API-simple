<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detials', function (Blueprint $table) {
            $table->id();
            $table->foreignid('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignid('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->double('unit_price');
            $table->integer('quantity');
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
        Schema::dropIfExists('order_detials');
    }
};
