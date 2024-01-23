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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_color_id')->index();
            $table->foreign('product_color_id')->references('id')->on('product_colors')->cascadeOnDelete();
            $table->string('image_path', 2048);  
            $table->enum('view', ['front', 'top', 'rear', 'side', 'side2', 'bottom'])->default('side');
            $table->string('alt_text', 20)->nullable();  
            $table->integer('order')->default(0); 
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
        Schema::dropIfExists('product_images');
    }
};
