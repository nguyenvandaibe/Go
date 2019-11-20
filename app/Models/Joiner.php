<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joiner extends Model
{
    public static function index($planId)
    {
    	return Joiner::where('plan_id', $planId)->get();
    }
}
