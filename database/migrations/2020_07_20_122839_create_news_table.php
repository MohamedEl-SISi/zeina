<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('publisher_name')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->boolean('paragraph_body');
            $table->enum('status', ['published', 'draft']);
            $table->text('desc')->nullable();
            $table->longText('body')->nullable();
            $table->boolean('in_home');
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->foreign('editor_id')->references('id')->on('users');
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->foreign('publisher_id')->references('id')->on('users');
            $table->unsignedBigInteger('imageId')->nullable();
            $table->foreign('imageId')->references('id')->on('images');
            $table->unsignedBigInteger('sectionId')->nullable();
            $table->foreign('sectionId')->references('id')->on('sections');
            $table->unsignedBigInteger('subSectionId')->nullable();
            $table->foreign('subSectionId')->references('id')->on('sections');
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
        Schema::dropIfExists('news');
    }
}
