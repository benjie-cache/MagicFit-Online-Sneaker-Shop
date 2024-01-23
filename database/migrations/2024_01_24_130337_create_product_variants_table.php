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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_color_id')->index();
            
            $table->foreign('product_color_id')->references('id')->on('product_colors')->cascadeOnDelete();
            $table->unsignedBigInteger('size_id')->index();
            $table->foreign('size_id')->references('id')->on('sizes')->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->unsignedInteger('quantity_in_stock');
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
        Schema::dropIfExists('stocks');
    }
};
