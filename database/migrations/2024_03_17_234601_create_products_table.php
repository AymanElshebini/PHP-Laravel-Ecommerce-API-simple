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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->foreignid('supplierid')->references('id')->on('suppliers')->onDelete('cascade');
            $table->decimal('purchase_price',8,2);
            $table->foreignid('categoryid')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->decimal('sell_price',8,2);
            $table->decimal('offer_price',8,2)->nullable();
            $table->integer('stock')->nullable();
            $table->text('fullDesc');
            $table->text('meta_keywords');
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
        Schema::dropIfExists('products');
    }
};
