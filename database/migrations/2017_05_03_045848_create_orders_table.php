<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->string('status')->default('waiting-payment');
            $table->string('bank');
            $table->string('sender');
            $table->decimal('total_payment', 18, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        Schema::create('order_details', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('order_id')->unsigned();
          $table->integer('product_id')->unsigned();
          $table->integer('quantity')->unsigned();
          $table->decimal('price', 10, 2)->unsigned();
          $table->decimal('fee', 10, 2)->unsigned();
          $table->decimal('total_price', 18, 2);
          $table->timestamps();

          $table->foreign('order_id')->references('id')->on('orders');
          $table->foreign('product_id')->references('id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
    }
}
