<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100); //VARCHAR 100
            $table->text('description')->nullable(); //TEXT NULL
            $table->date('start_date')->nullable(); //DATETIME NULL
            $table->date('end_date')->nullable(); //DATETIME NULL
            $table->unsignedDecimal('price', 8, 2)->nullable();
            $table->unsignedInteger('nb_max_student')->nullable();
            $table->enum('post_type', ['stage', 'formation']);
            $table->enum('status', ['published', 'unpublished'])->default('unpublished');

            $table->unsignedInteger('category_id')->nullable(); //UNSIGNED INTEGER un liver peut ne pas avoir de genre
            $table->foreign('category_id')->references('id')->on('categories'); //contrainte référencée sur la table genre.id
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
        Schema::dropIfExists('posts');
    }
}
