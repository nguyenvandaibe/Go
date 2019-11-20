<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Plan;
use App\Models\Point;
use App\Models\Follower;
use App\Models\Requester;
use App\Models\Joiner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AddPointRequest;
use App\Http\Requests\EditPointRequest;
use App\Http\Requests\DeletePointRequest;

class PointController extends Controller
{
	public function createNewPoint(AddPointRequest $request, $planId)
    {
		$point = Point::createPoint($planId, $request->all());

        return redirect('/plans/' . $planId);
    }
    
    public function editPoint(EditPointRequest $request, $planId)
    {
        Point::editPoint($planId, $request->all());

        return redirect('/plans/' . $planId);
    }

    public function deletePoint(Request $request, $planId)
    {
        Point::deletePoint($planId, $request->order);

        return redirect('/plans/' . $planId);
    }

    public function getArrayOfPoints(Request $request, $planId)
    {
        $points = Point::getPoints($planId);
        
        return json_encode($points);
    }
}
