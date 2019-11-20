<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Plan;
use App\Models\Point;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Requester;
use App\Models\Joiner;
use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\EditPlanRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request, $planId)
    {
        return view('plan.details',
            [
                'plan' => Plan::with(['points', 'user'])->find($planId),
                'followers' => Follower::index($planId),
                'requesters' => Requester::index($planId),
                'joiners' => Joiner::index($planId),
                'comments' => Comment::index($planId),
            ]);
    }

    public function showFormInfo()
    {
        return view('plan.new');
    }

    public function createNewPlanInfo(CreatePlanRequest $request)
    {
        $cover = $request->cover;

        $plan = Plan::createNewPlan($request->all(), $cover);

        $planId = $plan->id;

        return redirect('/plans/' . $planId);
    }

    public function showFormEditInfo(Request $request, $planId)
    {
        return view('plan.edit', ['plan' => Plan::find($planId)]);
    }

    public function store(EditPlanRequest $request, $planId)
    {        
        $cover = $request->cover;

        Plan::storePlan($request->all(), $cover, $planId);

        return redirect('/plans/' . $planId);
    }

    public function run(Request $request, $planId)
    {
        Plan::runPlan($planId);

        return redirect('/plans/' . $planId);
    }

    public function end(Request $request, $planId)
    {
        Plan::endPlan($planId);

        return redirect('/plans/' . $planId);
    }

    public function cancel(Request $request, $planId)
    {
        Plan::cancelPlan($planId);

        return redirect('/plans/' . $planId);
    }

    public function getPlanStatus(Request $request, $planId)
    {
        return json_encode(Plan::getStatus($planId));
    }
}
