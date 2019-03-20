<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientContactList extends Model
{
     protected $fillable = [
        'id', 'client_id', 'employee_name', 'contact_no'
    ];

  public function Clientinfo()
   {
      return $this->belongsTo('App\Client', 'client_id', 'id');
   } 
    
}
