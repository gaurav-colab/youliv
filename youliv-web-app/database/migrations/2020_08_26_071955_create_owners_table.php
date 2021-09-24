<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner_name');
            $table->string('owner_number')->unique();
            $table->string('alernate_number')->nullable();
            $table->string('owner_email');
            $table->string('password',255);
            $table->string('property_owner_image');
            $table->integer('property_owner_id_drop')->comment('1=>Aadhar Card,2=>Driving License','3=>Passport,4=>Voter Id');
            $table->string('property_owner_id_front');
            $table->string('property_owner_id_back');
            $table->string('property_gst')->nullable();
            $table->string('digital_signature')->nullable();
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
        Schema::dropIfExists('owners');
    }
}
