<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('author_id');
            $table->integer('qty');
            $table->integer('price');
            $table->string('code_no')->nullable();
            $table->string('path')->nullable();
            $table->string('cover_photo')->nullable();
            $table->integer('cat_id');
            $table->integer('book_no');
            $table->integer('rack_id');
            $table->string('edition_number')->nullable();
            $table->date('edition_date')->nullable();
            $table->string('publisher')->nullable();
            $table->date('publish_date')->nullable();
            $table->integer('book_expire')->default(0);
            $table->string('qr_photo')->nullable();
            $table->integer('rent_count');
            $table->integer('read_day')->default(0);
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
        Schema::dropIfExists('physical_books');
    }
}
