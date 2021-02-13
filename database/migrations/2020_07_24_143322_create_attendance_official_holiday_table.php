<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceOfficialHolidayTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_official', function (Blueprint $table) {
            $table->unsignedInteger('attendance_id');
            $table->unsignedInteger('official_id');

            $table->foreign('attendance_id')->references('id')->on('attendances');;
            $table->foreign('official_id')->references('id')->on('official_holidaies');;
            $table->primary(['attendance_id', 'official_id']);
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
        Schema::dropIfExists('attendance_official');
    }
}
