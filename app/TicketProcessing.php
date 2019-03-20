<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketProcessing extends Model
{
     protected $fillable = [
        'id', 'ticket_id', 'client_id', 'service_affected', 'region', 'priority', 'opening_time', 'closing_time', 'status', 'contactno', 'update_comments','naturOfFault','acc_request_time','acc_granted_time', 'escort_request_time','escort_granted_time','sla_resolution_time'
    ];


 public function Userinfo()
   {
       return $this->belongsTo('App\User', 'employee_id', 'id');
   }

   public function Statusinfo()
   {
       return $this->belongsTo('App\TicketStatus', 'status', 'id');
   }
   public function Clientinfo()
   {
       return $this->belongsTo('App\Client', 'client_id', 'id');
   }
    public function Serviceinfo()
   {
       return $this->belongsTo('App\Service', 'service_affected', 'id');
   }

   public function Description()
   {
     return $this->belongsTo('App\TicketGenerated','ticket_id','ticket_id');
   }

   


}
