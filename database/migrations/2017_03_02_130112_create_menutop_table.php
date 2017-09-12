<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenutopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('menutop', function (Blueprint $table) {
           $table->increments('id');
           $table->string('ten');
           $table->string('slug');
           $table->integer('thutu')->default('1');
           $table->string('hinh')->nullable();
           $table->text('ghichu')->nullable();
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
       Schema::dropIfExists('menutop');
     }
}
