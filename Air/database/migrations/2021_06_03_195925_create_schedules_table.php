<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->unsigned();//Flight Id
            $table->integer('rid')->unsigned();//Route ID
            $table->integer('seats')->unsigned()->default(0);
            $table->double('fare',10,2)->unsigned()->default(0);
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->string('landedTime')->nullable();
            $table->string('landedDate')->nullable();
            $table->string('recieved')->nullable();
            $table->integer('status')->default(0);//0 Scheduled 1 Departed 2 Landed
            $table->integer('sttype')->default(0);//0 onschedule 1 Delayed 2 Early
            $table->double('netcost',12,2)->default(0);
            $table->longText('desc')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
