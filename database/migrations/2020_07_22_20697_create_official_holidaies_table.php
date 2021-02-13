<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.4 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.4 | https://it.phpanonymous.com]
class CreateofficialHolidaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_holidaies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('holiday_name');
            $table->date('holiday_month')->nullable();
            $table->date('holiday_month_end')->nullable();
            $table->bigInteger('off_days')->nullable();
            $table->date('odate')->format('M-Y');
            $table->bigInteger('oyear');
            $table->bigInteger('month');
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
        Schema::dropIfExists('official_holidaies');
    }
}
