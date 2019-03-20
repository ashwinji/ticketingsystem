<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKbSiteInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kb_site_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('old_site_id')->nullable();
            $table->string('new_site_id')->nullable();
            $table->string('site_name')->nullable();
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
        Schema::dropIfExists('kb_site_infos');
    }
}
