<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnggDriver extends Model
{
    protected $fillable = [
        'id','region_id', 'designation', 'desName', 'desId', 'desContactno_one', 'desContact_two', 'desContact_three', 'driverAssginName', 'driver_no', 'car_no'
    ];

	public function RegionData()
	   {
	       return $this->belongsTo('App\Region', 'region_id', 'id');
	   }

}
