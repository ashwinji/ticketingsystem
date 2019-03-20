<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms_setting extends Model
{
	// protected $table = 'sms_settings';
    protected $fillable = ['stage','decision'];
}
