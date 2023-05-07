<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $groups = DB::table('groups')
        // ->select('groups.*')
        //     ->get();
        return view('admin.group.index');
        // return 'index group';
    }
}
