<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KbSiteInfo extends Model
{
    protected $fillable = [ 'id', 'old_site_id', 'new_site_id', 'site_name'   ];

}
