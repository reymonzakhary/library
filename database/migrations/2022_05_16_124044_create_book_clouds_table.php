<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('book_clouds', function (Blueprint $table) {
            // $categories = ['Comedy','Funny','Family','Drama','Action and Adventure','senice','futures','programing','Classics','Comic Book or Graphic Novel','Historical Fiction','Fantasy','Detective and Mystery'];

            $table->id();
            $table->string('title');
            $table->string('author');
            $table->text('content')->nullable();
            $table->float('rate')->nullable();
            $table->integer('totalpages')->nullable();
            $table->string('img')->nullable();
            $table->string('audio')->nullable();
            $table->text("tags")->nullable();
            $table->string('file')->nullable();  
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // $table->text("categories")->nullable();
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
        Schema::dropIfExists('book_clouds');
    }
};
