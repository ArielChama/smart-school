<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('letter');
            $table->string('shift');
            $table->string('grade');
            $table->text('course');
            $table->unsignedBigInteger('school_year_id');
            $table->timestamps();
        });

        Schema::table('classes', function (Blueprint $table) {
            $table->foreign('school_year_id')->references('id')->on('school_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
