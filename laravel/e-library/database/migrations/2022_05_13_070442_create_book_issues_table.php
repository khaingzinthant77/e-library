<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('cat_id');
            $table->integer('book_id');
            $table->date('issue_date');
            $table->string('remark');
            $table->boolean('delete_at')->default(1);
            $table->string('c_by')->nullable();
            $table->string('u_by')->nullable();
            $table->integer('issue_status')->nullable();
            $table->date('return_date');
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
        Schema::dropIfExists('book_issues');
    }
}
