<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_season', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('season_id');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');;
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_season');
    }
};
