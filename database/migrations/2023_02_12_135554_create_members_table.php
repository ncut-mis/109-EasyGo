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
        Schema::create('members', function (Blueprint $table) {
            $table->id();//編號
            $table->unsignedBigInteger('user_id'); //使用者編號
            $table->foreign('user_id')->references('id')->on('users');
			$table->string('nickname',255);//暱稱
            $table->integer('phone');//電話
			$table->string('address',255);//地址
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
        Schema::dropIfExists('members');
    }
};
