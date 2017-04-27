<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->integer('floor_id')
                ->unsigned();
            $table->foreign('floor_id')
                ->references('id')
                ->on('floors')
                ->onDelete('cascade');

            $table->integer('room_type_id')
                ->unsigned();
            $table->foreign('room_type_id')
                ->references('id')
                ->on('room_types')
                ->onDelete('cascade');

            $table->string('time_scheduled');
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
        Schema::dropIfExists('reservations');
    }
}
