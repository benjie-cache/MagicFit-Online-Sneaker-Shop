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
        Schema::create('products',function (Blueprint $table) {
          
      
           $table->id();
          //  foreign keys
           $table->unsignedBigInteger('products_category_id')->index()->nullable();
           $table->foreign('products_category_id')->references('id')->on('product_categories')->cascadeOnDelete();
           
           $table->unsignedBigInteger('brand_id')->index()->nullable();
           $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            
            $table->string('name',2000);
            $table->string('slug',2000);
            $table->text('description')->nullable();
            $table->string('sku')->unique(); 
       
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
