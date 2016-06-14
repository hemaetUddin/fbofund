<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ccrequest extends Model
{
    //contacts change request

    protected $table = 'ccrequests';

    public $timestamps=false;

    protected $fillable = ['user_id', 'upline_id', 'email', 'req_email', 'phone', 'req_phone'];



    
}
