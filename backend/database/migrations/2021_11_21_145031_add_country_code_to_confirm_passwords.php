<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryCodeToConfirmPasswords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confirm_passwords', function (Blueprint $table) {
            $table->foreignId('country_code_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('confirm_passwords', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_code_id');
        });
    }
}
