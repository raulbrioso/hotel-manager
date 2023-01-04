<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $user = User::with('rooms')->find(auth()->user()->id);
        $reservations = $user->rooms;
        return view('user.index', compact('user','reservations'));
    }
}
