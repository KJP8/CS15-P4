<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('food_user', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
    
            # `food_id` and `user_id` will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # `food_id` will reference the `foods' table and `user_id` will reference the `users` table.
            $table->integer('food_id')->unsigned();
            $table->integer('user_id')->unsigned();
    
            # Make foreign keys
            $table->foreign('food_id')->references('id')->on('foods');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('food_user');
    }
}
