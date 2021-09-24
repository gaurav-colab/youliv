<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->string('address_house');
            $table->string('address_building');
            $table->string('address_street');
            $table->unsignedBigInteger('address_sector');
            $table->unsignedBigInteger('address_city');
            $table->unsignedBigInteger('address_state');
            $table->integer('zipcode');
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('property')->onDelete('cascade');
            $table->foreign('address_sector')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('address_city')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('address_state')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_addresses');
    }
}
