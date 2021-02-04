<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question_head');
            $table->text('answer_1');
            $table->integer('answer_1_value');
            $table->text('answer_2');
            $table->integer('answer_2_value');
            $table->text('answer_3')->nullable();
            $table->integer('answer_3_value')->nullable();
            $table->text('answer_4')->nullable();
            $table->integer('answer_4_value')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
