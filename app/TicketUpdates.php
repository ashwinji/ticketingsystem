<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketUpdates extends Model
{
  protected $fillable = [
        'id', 'update_id', 'ticket_id', 'client_id', 'employee_id','noc_operator', 'opening_time', 'closing_time','status','new_employee_id', 'new_opening_time', 'new_closing_time','acc_request_time','acc_granted_time','escort_request_time','escort_granted_time','new_status','comments','link_affected','priority','site_address'
    ];
                
   
   public function Statusinfo()
   {
       return $this->belongsTo('App\TicketStatus', 'status', 'id');
   }
   public function Clientinfo()
   {
       return $this->belongsTo('App\Client', 'client_id', 'id');
   }
 
   public function Userinfo()
   {
      return $this->belongsTo('App\User', 'employee_id', 'id');
   }
   public function NocEngginfo(){
      return $this->belongsTo('App\User', 'noc_operator', 'id');
   }


}
