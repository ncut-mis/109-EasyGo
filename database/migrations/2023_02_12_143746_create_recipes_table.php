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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();//編號
            $table->unsignedBigInteger('recipe_category_id'); //食譜種類編號
            $table->foreign('recipe_category_id')->references('id')->on('recipe_categories');
            $table->unsignedBigInteger('member_id'); //會員編號
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('name',255);//食譜名稱
            $table->string('text',255);//內文
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
        Schema::dropIfExists('recipes');
    }
};
