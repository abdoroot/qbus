<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provider_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->bigInteger('bus_id')->unsigned()->nullable();
            $table->bigInteger('trip_order_id')->unsigned()->nullable();
            $table->bigInteger('package_order_id')->unsigned()->nullable();
            $table->bigInteger('bus_order_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('trip_id')->references('id')->on('trips')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('package_id')->references('id')->on('packages')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('bus_id')->references('id')->on('buses')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('trip_order_id')->references('id')->on('trip_orders')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('package_order_id')->references('id')->on('package_orders')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('bus_order_id')->references('id')->on('bus_orders')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
