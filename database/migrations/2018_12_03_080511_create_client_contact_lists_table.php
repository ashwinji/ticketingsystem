<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientContactListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_contact_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('contact_no')->nullable();           
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
        Schema::dropIfExists('client_contact_lists');
    }
}
