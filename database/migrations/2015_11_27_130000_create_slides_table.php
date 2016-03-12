<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('position')->unsigned()->default(1);
            $table->integer('page_id')->unsigned();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });

        Schema::create('slide_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('slide_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->text('body');
            $table->timestamps();
            $table->unique(['slide_id', 'locale']);
            $table->foreign('slide_id')->references('id')->on('slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slide_translations');
        Schema::drop('slides');
    }
}
