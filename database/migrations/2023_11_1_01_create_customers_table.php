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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->string('phone',30)->nullable()->change();
            $table->enum('type',['guest','authenticated'])->default('authenticated');
            
            $table->timestamps();
            
              //foreign keys
              $table->foreignId('user_id')->index()->constrained()->onDelete('cascade')->change();
              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
