<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if (Auth::check()) {
            if (auth()->user()->isAdmin()) {
                $lessons =   DB::table('users')
                    ->join('user_group', 'users.id', '=', 'user_group.user_id')
                    ->join('studygroup', 'user_group.group_id', '=', 'studygroup.id')
                    ->join('lessons', 'lessons.group_id', '=', 'studygroup.id')
                    ->whereDate('date', '=', Carbon::now())->get();
            } 
            else {
                $us_id = Auth::user()->id;
                $lessons = DB::table('users')
                    ->join('user_group', 'users.id', '=', 'user_group.user_id')
                    ->join('studygroup', 'user_group.group_id', '=', 'studygroup.id')
                    ->join('lessons', 'lessons.group_id', '=', 'studygroup.id')
                    ->whereDate('date', '=', Carbon::now())
                    ->where('users.id', '=', $us_id)->get();
            }
        } 
        else {
            $lessons = DB::table('users')
                ->join('user_group', 'users.id', '=', 'user_group.user_id')
                ->join('studygroup', 'user_group.group_id', '=', 'studygroup.id')
                ->join('lessons', 'lessons.group_id', '=', 'studygroup.id')
                ->whereDate('date', '=', Carbon::now())->get();
        }
        return view('lessons.index', compact('lessons'));
    }
}
