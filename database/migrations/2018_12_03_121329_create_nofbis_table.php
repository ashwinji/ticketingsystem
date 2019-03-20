<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNofbisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nofbis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->string('network')->nullable();
            $table->string('section')->nullable();
            $table->string('length')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('sla')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('nofbis');
    }
}
