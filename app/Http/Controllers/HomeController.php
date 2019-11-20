<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Plan;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.me', [
            'user' => $user,
            'myPlans' => Plan::where('author_id', $user->id)->get()
        ]);
    }

    public function show()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function store(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $pathAvatar = $user->avatar;

        if ($request->avatar) {
            $avatar = $request->avatar;
            $avaName = 'user_' . $user->id . '_avatar.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path() . '/images/avatars/', $avaName);
            $pathAvatar = '/images/avatars/' . $avaName;
        }

        $user->storeUpdate($user, $request->all(), $pathAvatar);

        return redirect('/profile/me');
    }
}
