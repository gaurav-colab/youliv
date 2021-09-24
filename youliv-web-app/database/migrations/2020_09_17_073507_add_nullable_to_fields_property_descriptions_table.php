<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToFieldsPropertyDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_descriptions', function (Blueprint $table) {
            $table->string('description')->nullable()->change();           
            $table->string('quantity')->nullable()->change();
            $table->string('rent')->nullable()->change();
			$table->string('security')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_descriptions', function (Blueprint $table) {
            //
        });
    }
}
