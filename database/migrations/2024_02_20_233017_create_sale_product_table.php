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
        Schema::create('sale_product', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('sale_id');
            $table->integer('product_id');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on("sale")->onDelete('cascade');;
            $table->foreign('product_id')->references('id')->on("product")->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_product');
    }
};
