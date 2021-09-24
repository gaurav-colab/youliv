<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('added_by');
            $table->integer('added_by_type')->comment('1=>super admin,2=>area manager');
            $table->unsignedBigInteger('area_manager_id');
            $table->string('property_code')->unique();
            $table->string('deals');
            $table->integer('status')->default(1)->comment('1:active,2:inactive');
            $table->timestamps();

            $table->foreign('area_manager_id')->references('id')->on('area_managers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
