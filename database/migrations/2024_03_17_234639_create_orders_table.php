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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');// order id 
            $table->foreignid('costomer_id')->references('id')->on('costomers')->onDelete('cascade'); //customer
            $table->date('date');
            $table->double('discount')->default(0);
            $table->double('total');/*أجمالي سعر الطلب */
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
        Schema::dropIfExists('orders');
    }
};
