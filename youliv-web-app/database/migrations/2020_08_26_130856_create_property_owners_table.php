<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('property_id');
            $table->integer('property_owned')->comment('1=>yes,2=>no');
            $table->integer('lease_unit')->nullable()->comment('1=>Month,2=>Year');
            $table->string('lease_duration')->nullable();
            $table->string('lease_expiry')->nullable();
            $table->string('lease_deed')->nullable();
            $table->integer('id_proof_is_same_address')->default(1)->comment('1=>yes,2=>no');
            $table->integer('property_diff_address')->nullable()->comment('1=>Electricity Bill,2=>Registration Document','3=>Water bill');
            $table->string('property_address_img')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
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
        Schema::dropIfExists('property_owners');
    }
}
