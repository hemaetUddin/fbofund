<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentinfo extends Model
{
    //

    protected $table = 'paymentinfos';
    protected $fillable = ['user_id','deposit_id','member_account','amount','paid_from','date','batch_num'];
}
