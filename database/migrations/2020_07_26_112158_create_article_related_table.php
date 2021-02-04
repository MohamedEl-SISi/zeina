<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_Id')->nullable();
            $table->foreign('article_Id')->references('id')->on('articles');
            $table->unsignedBigInteger('related_Id')->nullable();
            $table->foreign('related_Id')->references('id')->on('articles');

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
        Schema::dropIfExists('article_related');
    }
}
