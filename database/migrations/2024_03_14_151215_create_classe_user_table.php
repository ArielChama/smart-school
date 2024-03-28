<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe_user', function (Blueprint $table) {
            $table->id();
            $table->json('lesson');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('classe_user', function (Blueprint $table) {
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classe_user');
    }
}
