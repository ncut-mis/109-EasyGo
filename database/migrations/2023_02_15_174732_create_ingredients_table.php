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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();//編號
            $table->unsignedBigInteger('recipe_id');//食譜編號
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->unsignedBigInteger('category_id');//商品種類編號
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('quantity');//數量
            $table->string('unit',20);//單位
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
        Schema::dropIfExists('ingredients');
    }
};
