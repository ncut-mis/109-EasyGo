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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();//編號
            $table->unsignedBigInteger('member_id'); //會員編號
            $table->foreign('member_id')->references('id')->on('members');
            $table->unsignedBigInteger('recipe_id'); //食譜編號
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->unsignedBigInteger('comment_id'); //留言編號
           	$table->foreign('comment_id')->references('id')->on('comments');
            $table->string('content',255);//內容
            $table->time('time');//時間
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
        Schema::dropIfExists('comments');
    }
};
