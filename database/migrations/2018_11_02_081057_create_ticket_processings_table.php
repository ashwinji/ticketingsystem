<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketProcessingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_processings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unique();
            $table->integer('client_id');
            $table->integer('service_affected');
            $table->text('region')->nullable();
            $table->string('priority')->nullable();
            $table->string('naturOfFault')->nullable();            
            $table->timestamp('opening_time');
            $table->timestamp('closing_time')->nullable();
            $table->timestamp('acc_request_time')->nullable();  
            $table->timestamp ('acc_granted_time')->nullable();  
            $table->timestamp('escort_request_time')->nullable();  
            $table->timestamp('escort_granted_time')->nullable();  
            $table->string('sla_resolution_time')->nullable();                   
            $table->string('contactno')->nullable();
            $table->text('update_comments')->nullable();
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
        Schema::dropIfExists('ticket_processings');
    }
}
