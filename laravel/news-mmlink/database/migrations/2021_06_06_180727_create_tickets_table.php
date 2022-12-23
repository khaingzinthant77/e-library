<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('issue_id');
            $table->string('issue_name'); 
            $table->string('problem_id');
            $table->string('problem_name');
            $table->string('title'); 
            $table->integer('priority')->defautl(0);
            $table->string('assign_tech_id')->nullable();
            $table->string('assign_tech_name')->nullable();
            $table->datetime('assign_date')->nullable();
            $table->datetime('solved_date')->nullable();
            $table->string('remark');
            $table->string('description');
            $table->boolean('is_suspend')->default(0);
            $table->string('site_id');
            $table->string('site_code');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('ts_code');
            $table->string('ts_name');
            $table->string('qt_code')->nullable();
            $table->string('qt_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('address')->nullable();
            $table->string('cby_id');
            $table->string('cby_name');
            $table->string('uby_id')->nullable();
            $table->string('uby_name')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
