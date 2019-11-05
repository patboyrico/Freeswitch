<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->integer('currency_id')->unsigned();
            // $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set_null')->onUpdate('cascade');

            $table->integer('country_id')->unsigned();
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('set_null')->onUpdate('cascade');

            $table->float('balance', 8, 2)->default(0.00);
            $table->string('phone_number');
            $table->string('four_digit_pin');

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
        Schema::dropIfExists('user_configurations');
    }
}
