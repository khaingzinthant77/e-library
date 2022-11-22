<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('author_id');
            $table->integer('cat_id');
            $table->string('cover_path');
            $table->string('cover_photo');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('remark')->nullable();
            $table->string('c_by')->nullable();
            $table->string('u_by')->nullable();
            $table->string('rating_count')->nullable();
            $table->integer('rating_user')->default(0);
            $table->string('file_size')->nullable();
            $table->integer('read_count')->default(0);
            $table->boolean('is_feature')->default(0);
            $table->date('publish_date');
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
        Schema::dropIfExists('ebooks');
    }
}
