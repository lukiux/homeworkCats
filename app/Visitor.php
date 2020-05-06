<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model 
{

    protected $fillable = ['page_id', 'session_id'];
    
}
