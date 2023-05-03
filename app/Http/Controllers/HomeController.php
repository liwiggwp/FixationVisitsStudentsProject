<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $lessons = Lesson::withTrashed()->whereDate('date', '=', Carbon::now())->get();
        return view('lessons.index', compact('lessons'));
    }
}
