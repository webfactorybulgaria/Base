<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('homepage')->default(0);
            $table->integer('position')->unsigned()->default(1);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('partner_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('partner_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('website')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['partner_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partner_translations');
        Schema::drop('partners');
    }
}
