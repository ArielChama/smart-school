<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('process_number')->unique();
            $table->string('email')->default("");
            $table->date('birthday');
            $table->integer('number_phone');
            $table->string('number_bi');
            $table->string('gender');
            $table->string('address');
            $table->string('nationality');
            $table->string('language_option');
            $table->unsignedBigInteger('course_id');
            $table->string('image');
            $table->timestamps();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
