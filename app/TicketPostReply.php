<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPostReply extends Model
{
    protected $fillable = [
         'id', 'ticket_id', 'client_id', 'noc_operator', 'message','attachment'
    ];

 public function NocEngginfo(){
      return $this->belongsTo('App\User', 'noc_operator', 'id');
   }

}
