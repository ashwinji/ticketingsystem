<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $table = 'todolists';
    protected $fillable = ['noc_id','task_dtl','scheduled_date','status'];
}
