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
            $table->foreignId('customer_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('type',20);
           
            $table->string('estate',20);
            $table->string('address2', 20)->nullable();
            
            $table->string('street_address',20);
            $table->string('apartment_name',20);
            $table->string('house_number',20);
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
