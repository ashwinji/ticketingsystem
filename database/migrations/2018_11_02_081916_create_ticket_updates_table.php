<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('update_id');
            $table->integer('ticket_id');
            $table->integer('client_id');
            $table->integer('employee_id');
            $table->integer('noc_operator')->nullable();         
            $table->timestamp('opening_time');
            $table->timestamp('closing_time')->nullable();
            $table->enum('status',['1','2','3','4'])->default('1')->comment('1=Open, 2=Closed, 3=Pending ,4=Cancelled ');
            $table->string('priority')->nullable();
            $table->string('link_affected')->nullable();
            $table->text('site_address')->nullable();
            $table->integer('new_employee_id')->nullable();
            $table->timestamp('new_opening_time')->nullable();
            $table->timestamp('new_closing_time')->nullable();
            $table->timestamp('acc_request_time')->nullable();  
            $table->timestamp ('acc_granted_time')->nullable();  
            $table->timestamp('escort_request_time')->nullable();  
            $table->timestamp('escort_granted_time')->nullable(); 
            $table->text('comments')->nullable();         
            $table->enum('new_status',['1','2','3','4'])->default('2')->comment('1=Open, 2=Closed, 3=Pending ,4=Cancelled ');
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
        Schema::dropIfExists('ticket_updates');
    }
}
