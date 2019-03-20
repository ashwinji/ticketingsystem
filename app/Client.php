<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'phone', 'location'
    ];
    protected $dates = ['deleted_at'];
}
