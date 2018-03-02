<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebelevenCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webeleven_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating_id');
            $table->string('title', 35);
            $table->text('description');
            $table->integer('positive_votes')->unsigned();
            $table->integer('negative_votes')->unsigned();
            $table->timestamps();
            $table->boolean('published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('webeleven_comments');
    }
}
