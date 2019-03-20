<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastName', 'email', 'password', 'userType', 'address','city','zipcode', 'phone', 'status', 'avatar', 'access_token' , 'userRole'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //protected $dates = ['deleted_at'];

    
}
