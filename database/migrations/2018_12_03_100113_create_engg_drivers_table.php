<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnggDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engg_drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('desName')->nullable();
            $table->string('desId')->nullable();
            $table->string('desContactno_one')->nullable();
            $table->string('desContact_two')->nullable();
            $table->string('desContact_three')->nullable();
            $table->string('driverAssginName')->nullable();            
            $table->string('driver_no')->nullable();
            $table->string('car_no')->nullable();
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
        Schema::dropIfExists('engg_drivers');
    }
}
