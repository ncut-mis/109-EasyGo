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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();//編號
            $table->unsignedBigInteger('member_id'); //會員編號
            $table->foreign('member_id')->references('id')->on('members');
            $table->integer('number');//卡號
            $table->integer('check');//檢查碼
            $table->date('deadline');//到期日
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
        Schema::dropIfExists('cards');
    }
};
