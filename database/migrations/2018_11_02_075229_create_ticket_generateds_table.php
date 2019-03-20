<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketGeneratedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_generateds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id')->unique();
            $table->integer('client_id');
            $table->text('region')->nullable();
            $table->integer('noc_engg_id');
            $table->integer('employee_id');
            $table->integer('service_affected');
            $table->integer('department_id');
            $table->string('priority')->nullable();
            $table->string('naturOfFault')->nullable();            
            $table->enum('status',['1','2','3','4'])->default('1')->comment('1=Open, 2=Closed, 3=Pending ,4=Cancelled ');
            $table->text('description');
            $table->text('link_affected');
            $table->timestamps('reporting_time');
            $table->string('clientticketno')->nullable();
            $table->string('fault_reported_by')->nullable();
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
        Schema::dropIfExists('ticket_generateds');
    }
}
