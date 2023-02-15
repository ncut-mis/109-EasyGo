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
        Schema::create('order_detalis', function (Blueprint $table) {
            $table->id();//編號
            $table->unsignedBigInteger('order_id');//訂單編號
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id');//商品編號
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');//數量
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
        Schema::dropIfExists('order_detalis');
    }
};
