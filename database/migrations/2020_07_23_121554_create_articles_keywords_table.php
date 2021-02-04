<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('keyword_Id')->nullable();
            $table->foreign('keyword_Id')->references('id')->on('keywords');
            $table->unsignedBigInteger('article_Id')->nullable();
            $table->foreign('article_Id')->references('id')->on('articles');
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
        Schema::dropIfExists('articles_keywords');
    }
}
