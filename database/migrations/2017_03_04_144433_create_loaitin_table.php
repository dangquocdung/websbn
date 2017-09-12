<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaitinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('loaitin', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('menutop_id')->unsigned();
          $table->foreign('menutop_id')->references('id')->on('menutop')->onDelete('cascade');

          $table->string('ten');
          $table->string('slug');
          $table->text('ghichu')->nullable();
          $table->integer('thutu')->default('1');
          $table->string('hinh')->nullable();

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
        Schema::dropIfExists('loaitin');
    }
}
