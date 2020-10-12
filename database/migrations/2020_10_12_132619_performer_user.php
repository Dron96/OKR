<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PerformerUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performers_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('performers_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('performers_id')->references('id')->on('performers');
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
        Schema::dropIfExists('performers_user');
    }
}
