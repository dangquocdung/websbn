<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLichcongtacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('lichcongtac', function (Blueprint $table) {
           $table->increments('id');

           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

           $table->string('tieude');
           $table->string('slug');
           $table->date('ngay');
           $table->time('gio');
           $table->string('thanhphan');
           $table->string('diadiem');
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
         Schema::dropIfExists('lichcongtac');
     }
}
