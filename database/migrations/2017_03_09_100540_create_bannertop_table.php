<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannertopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bannertop', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('menutop_id')->unsigned();
          $table->foreign('menutop_id')->references('id')->on('menutop')->onDelete('cascade');

          $table->string('ten');
          $table->string('slug');
          $table->integer('thutu')->default('1');
          $table->boolean('hienthi')->default('1');
          $table->string('urlhinh');
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
        Schema::dropIfExists('bannertop');
    }
}
