<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gopy', function (Blueprint $table) {
          $table->increments('id');
          $table->string('hoten');
          $table->string('diachi');
          $table->string('dienthoai');
          $table->string('email');
          $table->string('tieude');
          $table->string('slug');
          $table->text('noidung');
          $table->boolean('active')->default('0');
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
        Schema::dropIfExists('gopy');
    }
}
