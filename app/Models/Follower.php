<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public static function index($planId)
    {
    	return Follower::where('plan_id', $planId)->get();
    }
}
