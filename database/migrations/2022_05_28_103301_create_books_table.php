<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('caption',255);
            $table->string('author',255);
            $table->string('category',255);
            $table->string('country',255);
            $table->text('descr',255);
            $table->text('image')->nullable();
            $table->integer('pages')->unsigned();
            $table->text('isbn');
            $table->text('shtrih');
            $table->string('lang',255);
            $table->bigInteger('user_id');
            $table->integer('quantity')->unsigned()->default(1);
            $table->integer('status')->unsigned()->default(0);
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
        Schema::dropIfExists('books');
    }
}
