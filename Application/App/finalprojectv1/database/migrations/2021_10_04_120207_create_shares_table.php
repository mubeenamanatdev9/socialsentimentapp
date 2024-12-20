<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            
            $table->id();
            $table->BigInteger('shared_by')->unsigned();
            $table->BigInteger('shared_with');
            $table->BigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('shared_by')->references('id')->on('users');

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
        Schema::dropIfExists('shares');
    }
}
