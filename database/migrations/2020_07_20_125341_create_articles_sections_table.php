<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articleSections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->boolean('in_home');
            $table->boolean('in_menu');
            $table->enum('status', ['published', 'draft','none']);
            $table->unsignedBigInteger('imageId')->nullable();
            $table->foreign('imageId')->references('id')->on('images');
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
        Schema::dropIfExists('articleSections');
    }
}
