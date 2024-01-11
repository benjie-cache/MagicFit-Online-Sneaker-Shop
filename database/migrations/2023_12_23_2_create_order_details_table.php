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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->index()->constrained()->onDelete('cascade');

            $table->foreignId('order_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('billing_address_id')->nullable()->index();
            $table->foreign('billing_address_id')->references('id')->on('customer_addresses')->onDelete('set null');
            
            $table->unsignedBigInteger('shipping_address_id')->nullable()->index();
            $table->foreign('shipping_address_id')->references('id')->on('customer_addresses')->onDelete('set null');
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
        Schema::dropIfExists('order_details');
    }
};
