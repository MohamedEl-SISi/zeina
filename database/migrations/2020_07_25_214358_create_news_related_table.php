<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('news_Id')->nullable();
            $table->foreign('news_Id')->references('id')->on('news');
            $table->unsignedBigInteger('related_Id')->nullable();
            $table->foreign('related_Id')->references('id')->on('news');

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
        Schema::dropIfExists('news_related');
    }
}
