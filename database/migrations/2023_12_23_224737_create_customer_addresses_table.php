<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('type',20);
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->string('phone',20);
            $table->string('address1',20);
            $table->string('address2',20);
            $table->string('city',20);
            $table->string('zip_code',20);
            $table->string('region',20);
            $table->string('country_code',20);
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
        Schema::dropIfExists('customer_addresses');
    }
};
