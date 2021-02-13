<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.4 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.4 | https://it.phpanonymous.com]
class CreateholidaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidaies', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('holiday_type');
            $table->longtext('holiday_desc')->nullable();
            $table->bigInteger('holidays_days')->nullable();
            $table->softDeletes();
            $table->bigInteger('holidaytype_id')->unsigned();
            $table->foreign('holidaytype_id')->references('id')->on('holidaytypes');
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('emps');
            $table->bigInteger('attendance_id')->unsigned();
            $table->foreign('attendance_id')->references('id')->on('attendances');
            $table->date('hdate');
            $table->date('fromdate');
            $table->date('todate');
            $table->bigInteger('hyear');
            $table->bigInteger('month');
            $table->Integer('status');

            $table->string('updating_reason')->nullable();


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
        Schema::dropIfExists('holidaies');

    }
}
