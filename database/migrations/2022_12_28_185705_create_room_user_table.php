<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('room_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->timestamp('checkin')->nullable();
            $table->timestamp('checkout')->nullable();
        });

        Schema::table('room_user', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('room_user');
    }
}
