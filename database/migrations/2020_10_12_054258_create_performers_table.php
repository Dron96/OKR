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
//        Schema::table('performers_user', function (Blueprint $table) {
//            $table->dropForeign('performers_user_performers_id_foreign');
//        });
        Schema::dropIfExists('performers');
    }
}
