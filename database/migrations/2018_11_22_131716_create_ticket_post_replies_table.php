<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketPostRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('ticket_post_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id')->nullable(); 
            $table->integer('client_id')->nullable(); 
            $table->integer('noc_operator')->nullable();   
            $table->text('message')->nullable();   
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('ticket_post_replies');
    }
}
