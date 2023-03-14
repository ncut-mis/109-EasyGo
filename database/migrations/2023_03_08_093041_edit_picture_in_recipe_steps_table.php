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
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->string('picture',255)->nullable()->change();//圖片
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_steps', function (Blueprint $table) {
            $table->string('picture',255)->change();
        });
    }
};
