<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CloseTicket extends Model
{
    protected $table = 'close_tickets';
    protected $fillable = ['ticket_id','client_id','resolution_time','closing_noc_engineer','clearence_officer_onclient_side','cause_of_fault','resolution_remark','pendingtime_min','status']; 

   public function NocEngginfo(){
      return $this->belongsTo('App\User', 'closing_noc_engineer', 'id');
   }
     
   public function Statusinfo()
   {
       return $this->belongsTo('App\TicketStatus', 'status', 'id');
   }
   
 }
