<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('worth')->default(0);
            $table->foreignId('start_address_id');
            $table->integer('quantity')->nullable();
            $table->string('weight');
            $table->string('first_phone');
            $table->integer('country_code_id');
            $table->string('status');
            $table->foreignId('customer_product_id');
            $table->foreignId('order_id');
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
        Schema::dropIfExists('order_detailes');
    }
}
