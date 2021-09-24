<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->integer('property_type')->default(1)->comment('1 => Flat, 2 => PG');
            $table->integer('property_available')->default(1)->comment('1 => Men, 2 => Women, 3 => Unisex');
            $table->integer('furnishing')->default(1)->comment('1 => Furnished, 2 => Semi Furnished, 3 => Fully Furnished');
            $table->integer('owner_free')->default(1)->comment('1 => yes, 2 => no');
            $table->integer('total_room_for_rent')->nullable();
            $table->integer('total_bed_for_rent')->nullable();
            $table->integer('food_inclusive')->default(1)->comment('1 => Yes, 2 => No');
            $table->integer('electricity_inclusive')->default(1)->comment('1 => Yes, 2 => No');
            $table->integer('food_exclusive_rent')->nullable()->comment('rent without food');
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
        Schema::dropIfExists('property_details');
    }
}
