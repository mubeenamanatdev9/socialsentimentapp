<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('likes')->nullable();
            $table->integer('comments')->nullable();
            $table->integer('emojes')->nullable();
            $table->integer('shares')->nullable();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('post_ratings');
    }
}
