<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CronEntry extends Model
{
    protected $fillable = ['ticket_id','designation','mobile','cronmsg','timepassed'];
}
