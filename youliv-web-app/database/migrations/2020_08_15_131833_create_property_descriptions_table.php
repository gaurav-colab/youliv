<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('property_id');
            $table->integer('room_type')->comment('1 => Single Room, 2 => Double Room, 3 => Triple Room, 4 => Other Room, 5 => 1 RK, 6 => 1 BHK,7 => 2 BHK, 8 => Other Flat');
            $table->mediumText('description');
            $table->integer('quantity');
            $table->integer('rent');
            $table->integer('security');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('property')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_descriptions');
    }
}
