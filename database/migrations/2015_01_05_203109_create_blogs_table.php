<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('text');
            $table->string('image');
            $table->dateTime('publication_date');
            $table->tinyInteger('online');
            $table->timestamps();

            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('blogs');
    }
}
