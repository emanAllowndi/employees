<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.4 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.4 | https://it.phpanonymous.com]
class CreateholidayPalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_palances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('holidayPalance')->nullable();
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('emps');
            $table->bigInteger('holidaytype_id')->unsigned();
            $table->foreign('holidaytype_id')->references('id')->on('holidaytypes');
            $table->longtext('note')->nullable();
            $table->bigInteger('palyear');
            $table->bigInteger('month');
            $table->date('paldate');
            $table->string('updating_reason')->nullable();




            $table->softDeletes();

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
        Schema::dropIfExists('holiday_palances');
    }
}
