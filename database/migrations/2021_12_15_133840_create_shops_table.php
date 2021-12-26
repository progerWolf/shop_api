<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('phone');
            $table->string('image');
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('opening_hour')->nullable();
            $table->string('closing_hour')->nullable();
            $table->float('delivery_price')->default(0.0);
            $table->float('purchase')->default(0.0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('shops');
    }
}
