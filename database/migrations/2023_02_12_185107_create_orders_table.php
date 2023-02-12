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
            $table->id();//編號
            $table->unsignedBigInteger('member_id');//會員編號
            $table->foreign('member_id')->references('id')->on('members');
            $table->integer('remit');//是否匯款
            $table->integer('status');//訂單狀態
            $table->string('receiver',10);//收貨人
            $table->string('address',50);//收貨地址
            $table->integer('tel');//收貨人電話
            $table->timestamps();//成立時間
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
