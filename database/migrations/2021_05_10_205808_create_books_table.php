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
            $table->foreignId('publisher_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('title', 100)->index();
            $table->string('isbn', 13)->unique();
            $table->smallInteger('pages');
            $table->text('description');
            $table->timestamps();
            $table->date('publishing_date')->nullable();
            $table->string('file')->nullable();
            $table->string('cover')->nullable();
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
