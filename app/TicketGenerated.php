<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketGenerated extends Model
{
       protected $fillable = [
         'id', 'ticket_id', 'client_id', 'noc_engg_id','employee_id', 'service_affected','department_id', 'region', 'status','priority','naturOfFault','link_affected','description','reporting_time','clientticketno','fault_reported_by'
    ];

   public function NOCUserinfo() 
   {
       return $this->belongsTo('App\User', 'noc_engg_id', 'id');
   }
   public function AssignEngginfo()
   {
       return $this->belongsTo('App\User', 'employee_id', 'id');
   }
   public function Departmentsinfo()
   {
       return $this->belongsTo('App\Department', 'department_id', 'id');
   }
   public function ClientData()
   {
       return $this->belongsTo('App\Client', 'client_id', 'id');
   }
   public function Statusinfo()
   {
       return $this->belongsTo('App\TicketStatus', 'status', 'id');
   }
    public function Userinfo()
   {
       return $this->belongsTo('App\User', 'employee_id', 'id');
   }
   public function Serviceaffected()
   {
     return $this->belongsTo('App\Service','service_affected','id');
   }
   /*public function servicename()
   {
     return $this->belongsTo('App\Service','service_affected','id');
   }
   */

 
}


