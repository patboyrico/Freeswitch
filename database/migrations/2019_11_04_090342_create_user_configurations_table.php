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

            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->integer('currency_id');
            $table->foreign('currency_id')->references('id')->on('currency')->onDelete('set null')->onUpdate('cascade');

            $table->integer('country_id');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('delete')->onUpdate('cascade');

            $table->string('phone_number');
            $table->string('4-digit-pin');
            $table->string('J-Number');
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
