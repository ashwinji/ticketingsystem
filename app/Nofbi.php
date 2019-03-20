<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nofbi extends Model
{
     protected $fillable = [
        'id', 'client_id', 'network', 'section', 'length', 'region_id', 'sla', 'duration'
    ];

	public function RegionData()
	   {
	       return $this->belongsTo('App\Region', 'region_id', 'id');
	   }
	public function Clientinfo()
   {
      return $this->belongsTo('App\Client', 'client_id', 'id');
   } 

}
