<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('post_client_id');
            $table->string('country')->nullable();
            $table->string('city');
            $table->string('address');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pos_user_id')->references('id')->on('post_user');
            $table->foreign('post_client_id')->references('id')->on('post_client');
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
        Schema::dropIfExists('address');
    }
}
