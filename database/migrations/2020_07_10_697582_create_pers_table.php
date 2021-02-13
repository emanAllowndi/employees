<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.4 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.4 | https://it.phpanonymous.com]
class CreatepersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longtext('per_cause');
            $table->time('from')->nullable();
             $table->time('to')->nullable();
             $table->date('pdate')->format('M-Y');
            $table->bigInteger('pyear');
            $table->bigInteger('month');
            $table->Integer('status');




            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('emps');
			$table->softDeletes();
            $table->string('updating_reason')->nullable();

            $table->string('per_pic')->nullable();


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
        Schema::dropIfExists('pers');
    }
}
