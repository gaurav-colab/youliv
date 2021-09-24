<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToFieldsOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
			$table->string('owner_name')->nullable()->change();           
            $table->string('property_owner_image')->nullable()->change();
            $table->string('owner_email')->nullable()->change();
			$table->string('property_owner_id_front')->nullable()->change();
            $table->string('property_owner_id_back')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            //
        });
    }
}
