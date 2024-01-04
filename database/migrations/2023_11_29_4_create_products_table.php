<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\user_management\User;
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
           
          //  foreign key for category
           // $table->unsignedBigInteger('products_category_id')->index()->nullable();
        //    $table->foreign('products_category_id')->references('id')->on('product_categories')->cascadeOnDelete();
             //foreign key for inventory
          //  $table->unsignedBigInteger('product_inventory_id')->index()->nullable();
          //  $table->foreign('product_inventory_id')->references('id')->on('product_inventories')->cascadeOnDelete();
            //foreign key for product discount
         //   $table->unsignedBigInteger('product_discount_id')->index()->nullable();
            //$table->foreign('product_discount_id')->references('id')->on('product_discounts')->cascadeOnDelete();

            // add other fields
           
           // $table->string('image')->nullable();
          //  $table->string('image_mime')->nullabe();
          //  $table->integer('image_size')->nullable();
            $table->id();
            $table->string('name',2000);
            $table->string('slug',2000);
            $table->text('description')->nullable();
            $table->decimal('price',10,2);
            $table->boolean('is_hot_deal_of_the_day')->default(false); //New column
            $table->timestamps();
           
            
           // $table->foreignIdFor(User::class,'created_by')->nullable();
            //$table->foreignIdFor(User::class,'updated_by')->nullable();
           // $table->softDeletes();
            
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
