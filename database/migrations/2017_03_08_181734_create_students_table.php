<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('fullname');
            $table->string('gender');
            $table->string('reg_no');
            $table->integer('dept_id')->unsigned();
            $table->string('session');
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('dept_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
