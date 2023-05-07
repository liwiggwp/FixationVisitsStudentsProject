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
            if (auth()->user()->isAdmin()??auth()->user()->isTeacher()) {
                $lessons = Lesson::whereDate('date', '=', Carbon::now())->get();
            } 
            else if(auth()->user()->isUser()){
                $us_id = Auth::user()->id;
                $gr_id_us = DB::table('users')
                    ->join('user_group', 'users.id', '=', 'user_group.user_id')
                    ->join('studygroup', 'user_group.group_id', '=', 'studygroup.id')
                    ->where('users.id', '=', $us_id)
                    ->select('studygroup.id')
                    ->first();
                $gr_id = null;
                foreach ($gr_id_us as $i) {
                    $gr_id = $i;
                }

                $lessons = DB::table('lessons')
                    ->whereDate('date', '=', Carbon::now())
                    ->where('group_id', '=', $gr_id)
                    ->get();
            }
            else {
                $lessons = Lesson::whereDate('date', '=', Carbon::now())->get();

            }
        } else {
            $lessons = Lesson::whereDate('date', '=', Carbon::now())
                ->get();
        }
        return view('lessons.index', compact('lessons'));
    }
}
