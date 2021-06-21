<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('fid')->unsigned();
            $table->integer('tid')->unsigned();
            $table->integer('distance')->unsigned();//flight assigned ID
            $table->integer('netmaincost')->unsigned();// Net Maintanance Cost
            $table->double('travelcost',12,2)->unsigned();// Flight Cost
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
        Schema::dropIfExists('routes');
    }
}
