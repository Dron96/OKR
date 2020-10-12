<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dateStart');
            $table->date('dateEnd');
            $table->unsignedBigInteger('author');
            $table->unsignedInteger('percentOfCompletion');
            $table->string('status');
            $table->unsignedBigInteger('executor')->nullable();
            $table->string('descr')->nullable();
            $table->unsignedBigInteger('command')->nullable();

            $table->timestamps();

            $table->foreign('author')->references('id')->on('users');
            $table->foreign('executor')->references('id')->on('users');
            //$table->foreign('command')->references('id')->on('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
