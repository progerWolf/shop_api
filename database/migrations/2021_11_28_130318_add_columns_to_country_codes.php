<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCountryCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('country_codes', function (Blueprint $table) {
            $table->integer('maxlength');
            $table->integer('minlength');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country_codes', function (Blueprint $table) {
            $table->dropColumn('maxlength');
            $table->dropColumn('minlength');
        });
    }
}
