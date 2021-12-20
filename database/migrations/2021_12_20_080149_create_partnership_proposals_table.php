<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnershipProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnership_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('passport_front_side');
            $table->string('passport_back_side');
            $table->string('selfie_with_passport');
            $table->enum('type', [
                'courier',
                'store'
            ])->default('courier');
            $table->enum('status', [
                'moderation',
                'cancelled',
                'accepted'
            ])->default('moderation');
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
        Schema::dropIfExists('partnership_proposals');
    }
}
