<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCloseTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        Schema::create('close_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id');
            $table->integer('client_id');
            $table->datetime('resolution_time');
            $table->integer('closing_noc_engineer');
            $table->string('clearence_officer_onclient_side');
            $table->string('cause_of_fault');
            $table->string('resolution_remark');
            $table->datetime('pendingtime_min')->nullable();
            
          $table->enum('status',['1','2','3','4'])->default('1')->comment('1=Open, 2=Closed, 3=Pending ,4=Cancelled ');
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
        Schema::dropIfExists('close_tickets');
    }
}
