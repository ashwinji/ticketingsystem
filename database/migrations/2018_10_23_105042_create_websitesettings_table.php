<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websitesettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website_name')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('watermark')->nullable();
            $table->string('email')->nullable();
            $table->string('locktimeout')->nullable();
            $table->string('address')->nullable();
            $table->string('mobilenum')->nullable();
            $table->string('openingTime')->nullable();
            $table->string('fb_link', 500)->nullable();
            $table->string('tw_link', 500)->nullable();
            $table->string('li_link', 500)->nullable();
            $table->string('yt_link', 500)->nullable();
            $table->string('in_link', 500)->nullable();
            $table->string('gp_link', 500)->nullable();
            $table->text('ga')->nullable();
            $table->string('sms_username')->nullable();
            $table->string('sms_senderid')->nullable();
            $table->string('sms_passwrd')->nullable();
            $table->string('sms_message')->nullable();
            $table->string('sms_after_four_hr')->nullable();
            $table->string('sms_after_resolution')->nullable();
            $table->string('sla_escalation_3hrs_sms')->nullable();
            $table->timestamps();
        });

        // Insert 1st record
        DB::table('websitesettings')->insert(
            array(
                'website_name'  => 'Ticketing System',
                'locktimeout'   => '30'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websitesettings');
    }
}
