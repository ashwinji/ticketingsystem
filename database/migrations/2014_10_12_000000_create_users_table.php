<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userType')->default('1')->comment('0-admin, 1-Network Operation Centre (NOC), 2-Service Centre, 3-Field Engineer');
            
            $table->string('name');
            $table->string('lastName')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->integer('category')->nullable();
            $table->text('access_token')->nullable();            
            $table->string('address')->nullable()->comment('full address');
            $table->string('city')->nullable()->comment('City');
            $table->string('zipcode')->nullable()->comment('Zip code');
            $table->string('phone', 15)->nullable()->comment('phone number');
            
            $table->enum('status',['0','1'])->default('0')->comment('0=Active, 1=Deactive');
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
