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
        Schema::create('products', function (Blueprint $table) {
          
           //DEAL WITH FOREIGN KEYS AND RELATIONSHIPS
           $table->id();
          //  foreign keys
           $table->unsignedBigInteger('products_category_id')->index()->nullable();
           $table->foreign('products_category_id')->references('id')->on('product_categories')->cascadeOnDelete();
           
           $table->unsignedBigInteger('brand_id')->index()->nullable();
           $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            
            $table->string('name',2000);
            $table->string('slug',2000);
            $table->text('description')->nullable();
            $table->decimal('price',10,2);
            $table->boolean('is_hot_deal_of_the_day')->default(false); //New column
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
        Schema::dropIfExists('products');
    }
};
