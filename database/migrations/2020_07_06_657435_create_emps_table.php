<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [It V 1.4 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.4 | https://it.phpanonymous.com]
class CreateempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('emp_name');
            $table->string('second_name');

            $table->string('third_name')->nullable();

            $table->string('last_name')->nullable();
            $table->bigInteger('motivation')->default('0');
            $table->bigInteger('salary')->default('0');
            $table->bigInteger('work_nature')->default('0');
            $table->text('level')->nullable();
            $table->bigInteger('transportation')->default('0');
            $table->bigInteger('degree')->default('0');
            $table->text('activity')->nullable();

            $table->string('major')->nullable();
            $table->string('qulification')->nullable();
            $table->bigInteger('department_id')->nullable()->unsigned();
            $table->bigInteger('administration_id')->nullable()->unsigned();
            $table->bigInteger('publicadmin_id')->nullable()->unsigned();
            $table->bigInteger('sector_id')->nullable()->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->bigInteger('job_id')->nullable()->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('photo_profile')->nullable();
            $table->string('contract')->nullable();

            $table->text('gender')->nullable();
            $table->string('status')->nullable();
            $table->date('start_date')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->bigInteger('emergency_number')->nullable();
            $table->text('emergency_person')->nullable();
            $table->string('email')->nullable();
            $table->string('cv')->nullable();
            $table->string('social')->nullable();
            $table->string('nationality')->nullable();
            $table->bigInteger('snn')->nullable();
            $table->bigInteger('fingerprint')->nullable();
            $table->bigInteger('account_num')->nullable();
            $table->bigInteger('passport')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->bigInteger('sons')->nullable();
            $table->bigInteger('employment_number')->nullable();









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
        Schema::dropIfExists('emps');
    }
}
