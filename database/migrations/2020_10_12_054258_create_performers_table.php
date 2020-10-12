<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('key_results_id');
            $table->unsignedBigInteger('performer_id');

            $table->foreign('performer_id')->references('id')->on('users');
            $table->foreign('key_results_id')->references('id')->on('key_results');

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
        Schema::dropIfExists('performers');
    }
}
