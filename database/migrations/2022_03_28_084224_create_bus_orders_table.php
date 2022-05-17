<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_orders', function (Blueprint $table) {
            $table->id('id');
            $table->string('date');
            $table->string('time');
            $table->string('lat');
            $table->string('lng');
            $table->integer('zoom');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->bigInteger('bus_id')->unsigned()->nullable();
            $table->double('fees');
            $table->enum('status', ['pending','canceled','approved','rejected','complete'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('setNull');
            $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('setNull');
            $table->foreign('bus_id')->references('id')->on('buses')->onUpdate('cascade')->onDelete('setNull');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bus_orders');
    }
}
