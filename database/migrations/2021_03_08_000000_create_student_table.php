<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdd_students', function (Blueprint $table) {
            $table->increments('stu_id',20);
            $table->string('stu_fname',20);
            $table->string('stu_mname',20)->nullable();
            $table->string('stu_lname',20);
            $table->date('stu_dob')->nullable();
            $table->bigInteger('stu_age');
            $table->string('stu_gender',10);
            $table->string('stu_f_occupation',20)->nullable();
            $table->text('stu_adhar_no')->nullable();
            $table->text('stu_insu_no')->nullable();
            $table->string('stu_deworming_his',10);
            $table->text('stu_school_id');
            $table->longText('stu_address');
            $table->string('stu_state',10);
            $table->bigInteger('stu_district');
            $table->bigInteger('stu_tahsil');
            $table->bigInteger('stu_city');
            $table->string('stu_area',30)->nullable(); 
            $table->text('stu_landmark')->nullable(); 
            $table->text('stu_lane_street')->nullable(); 
            $table->bigInteger('stu_house_no')->nullable(); 
            $table->bigInteger('stu_pincode'); 
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->enum('stu_is_deleted', array('0', '1'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdd_students');
    }
}
