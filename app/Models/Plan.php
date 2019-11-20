<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'author_id', 'status', 'cover', 'start_date', 'end_date', 'member_num',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function points()
    {
    	return $this->hasMany('App\Models\Point');
    }

    public static function createNewPlan(array $data, $cover)
    {
        $coverName = 'default cover.jpg';

        if ($cover != null) {
            
            $coverName = $request->name . ' cover.' . $cover->getClientOriginalExtension();
            $cover->move(public_path() . '/images/covers/', $coverName);
        }


    	$plan = Plan::create([
            'name' => $data['name'],
            'author_id' => Auth::user()->id,
            'status' => 'planning',
            'start_date' => $data['start_date'],
            'cover' => '/images/covers/' . $coverName,
            'end_date' => $data['end_date'],
            'member_num' => $data['member_num'],
        ]);

    	return $plan;
    }

    public static function storePlan(array $data, $cover, $planId)
    {

        $coverName = 'default cover.jpg';

        if ($cover != null) {

            $coverName = $request->name . ' cover.' . $cover->getClientOriginalExtension();
            $cover->move(public_path() . '/covers/', $coverName);
        }


        $plan = Plan::find($planId);

        $plan->update([
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'cover' => '/images/covers/' . $coverName,
            'end_date' => $data['end_date'],
            'member_num' => $data['member_num'],
        ]);
    }

    public static function runPlan($planId)
    {
        $plan = Plan::find($planId);

        $plan->status = 'running';

        $plan->save();
    }

    public static function endPlan($planId)
    {
        $plan = Plan::find($planId);

        $plan->status = 'ended';

        $plan->save();
    }

    public static function cancelPlan($planId)
    {
        $plan = Plan::find($planId);

        $plan->status = 'cancelled';

        $plan->save();
    }

    public static function getStatus($planId)
    {
        $plan = Plan::find($planId);
        
        return $plan->status;
    }
}
