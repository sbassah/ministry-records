<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('salutation');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_no');
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('class_assigned_id');
            $table->foreign('class_assigned_id')->references('id')->on('church_classes');
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
        Schema::dropIfExists('teachers');
    }
}
