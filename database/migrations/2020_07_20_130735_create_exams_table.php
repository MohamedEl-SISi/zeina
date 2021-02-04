<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->enum('type', ['oneQuestion', 'multipleQuestions']);
            $table->text('result')->nullable();
            $table->unsignedBigInteger('sectionId')->nullable();
            $table->foreign('sectionId')->references('id')->on('exams_section');
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
        Schema::dropIfExists('exams');
    }
}
