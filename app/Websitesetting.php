<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websitesetting extends Model
{
    protected $fillable = [
        'id', 'website_name', 'website_logo', 'watermark', 'email', 'locktimeout', 'address', 'mobilenum', 'openingTime', 'fb_link', 'tw_link', 'li_link', 'yt_link', 'in_link', 'gp_link', 'ga',
        'sms_username','sms_senderid','sms_passwrd','sms_message','sms_after_four_hr','sms_after_resolution','sla_escalation_3hrs_sms'
    ];
}
