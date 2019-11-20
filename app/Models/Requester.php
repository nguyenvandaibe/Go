<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requester extends Model
{
    public static function index($planId)
    {
    	return Requester::where('plan_id', $planId)->get();
    }
}
