<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.4 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.4 | https://it.phpanonymous.com]
class CreatetasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('task_name');
            $table->string('note')->nullable();
            $table->string('type')->nullable();

            $table->longtext('task_desc')->nullable();
            $table->bigInteger('days');
            $table->string('status');
            $table->bigInteger('task_rate')->nullable();
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('emps');
            $table->date('tdate');
            $table->bigInteger('tyear');
            $table->bigInteger('month');
            $table->string('updating_reason')->nullable();




			$table->softDeletes();

			$table->timestamps();
        });
         // Create table for associating tasks to employees (Many-to-Many)
        // Schema::create('employee_task', function (Blueprint $table) {
         //   $table->unsignedInteger('emp_id');
         //   $table->unsignedInteger('task_id');

          //  $table->foreign('emp_id')->references('id')->on('emps');

          //  $table->foreign('task_id')->references('id')->on('tasks');


          //  $table->primary(['emp_id', 'task_id']);
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
