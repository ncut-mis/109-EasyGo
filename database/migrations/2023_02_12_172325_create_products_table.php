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
            $table->id();//編號
            $table->unsignedBigInteger('category_id');//種類編號
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name',255);//名稱
            $table->string('brand',255);//品牌
            $table->integer('stock');//存貨
            $table->string('origin_place',255);//產地
            $table->string('norm',255);//規格
            $table->integer('price');//價格
            $table->string('text',255);//說明
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
