<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->unsigned();
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('content')->nullable();
            $table->integer('status')->default(0);
            $table->date('dop');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('procs')->onUpdate('cascade')->onDelete('cascade');
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
