<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_results', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('goal_id');
            $table->unsignedInteger('weight');
            $table->unsignedBigInteger('executor')->nullable();
            $table->unsignedInteger('percent')->default(0);

            $table->foreign('executor')->references('id')->on('users');
            $table->foreign('goal_id')->references('id')->on('goals');

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
        Schema::dropIfExists('key_results');
    }
}
