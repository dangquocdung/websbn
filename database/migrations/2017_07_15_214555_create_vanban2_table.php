<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVanban2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('vanban2', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

          $table->date('ngaybanhanhvb');

          $table->integer('loaivb_id')->unsigned();
          $table->foreign('loaivb_id')->references('id')->on('loaivb')->onDelete('cascade');

          $table->integer('menuvb_id')->unsigned();
          $table->foreign('menuvb_id')->references('id')->on('menuvb')->onDelete('cascade');

          $table->string('sovb');
          $table->string('trichyeuvb');
          $table->string('slug');
          $table->string('tepvanban');
          $table->string('nguoiki');
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
        Schema::dropIfExists('vanban2');
    }
}
