<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('file_Id')->nullable();
            $table->foreign('file_Id')->references('id')->on('files');
            $table->unsignedBigInteger('news_Id')->nullable();
            $table->foreign('news_Id')->references('id')->on('news');
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
        Schema::dropIfExists('files_news');
    }
}
