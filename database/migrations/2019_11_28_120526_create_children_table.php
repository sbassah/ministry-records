<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('photo')->nullable();
            $table->string('school_name')->nullable();
            $table->text('home_address');
            $table->unsignedBigInteger('school_class_id');
            $table->unsignedBigInteger('church_class_id');
            $table->foreign('school_class_id')->references('id')->on('school_classes');
            $table->foreign('church_class_id')->references('id')->on('church_classes');
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
        Schema::dropIfExists('children');
    }
}
