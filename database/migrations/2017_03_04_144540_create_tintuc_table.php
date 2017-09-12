<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTintucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tintuc', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

          $table->integer('loaitin_id')->unsigned();
          $table->foreign('loaitin_id')->references('id')->on('loaitin')->onDelete('cascade');

          $table->string('tieude');
          $table->string('tieudekhongdau');
          $table->string('urlhinh')->nullable();
          $table->text('tomtat');
          $table->text('noidung');
          $table->text('ghichu')->nullable();
          $table->boolean('tinnoibat');
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
        Schema::dropIfExists('tintuc');
    }
}
