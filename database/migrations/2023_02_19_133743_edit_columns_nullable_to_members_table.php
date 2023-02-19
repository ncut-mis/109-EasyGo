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
        Schema::table('members', function (Blueprint $table) {
            $table->string('nickname',255)->nullable()->change();//暱稱
            $table->integer('phone')->nullable()->change();//電話
            $table->string('address',255)->nullable()->change();//地址
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('nickname',255)->change();
            $table->integer('phone')->change();
            $table->string('address',255)->change();
        });
    }
};
