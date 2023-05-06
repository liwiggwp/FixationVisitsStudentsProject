<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Psy\Readline\Hoa\Console;

use function Psy\debug;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->isAdmin()) {
                $lessons = Lesson::whereDate('date', '=', Carbon::now())->get();
            } else {
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
        } else {
            $lessons = Lesson::whereDate('date', '=', Carbon::now())
                ->get();
        }
        return view('lessons.index', compact('lessons'));
    }

    public function indexAdmin()
    {
        $lessons = Lesson::withTrashed()->Paginate(6);
        return view('admin.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('lessons.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $lesson = new Lesson();
        // $post->user_id = Auth::user()->id;
        $lesson->name = $request->name;
        $lesson->class = $request->class;
        $lesson->teacher = $request->teacher;
        $lesson->group_id = $request->group_id;
        // $lesson->date = date("Y-m-d h:i", strtotime( $request->date));
        $time = Carbon::parse($request->date);
        $lesson->date = $time;
        // $time = strtotime($request->date);

        // $newformat = date('Y-m-d', $time);
        // return $time;
        $lesson->save();

        return redirect()->route('lesson.index')->with('success', 'Карточка успешна создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = DB::table('lessons')
            ->join('user_group', 'lessons.group_id', '=', 'user_group.group_id')
            ->join('users', 'user_group.user_id', '=', 'users.id')
            ->where('lessons.id', '=', $id)
            ->select('users.id', 'users.surname', 'users.name', 'users.patronymic')
            ->get();

        $visits = collect();
        foreach ($users as $u) {
            $visits->push(DB::table('user_visit_lesson')
                ->where('user_visit_lesson.user_id', '=', $u->id)
                ->select('user_visit_lesson.is_visits')
                ->get());
        }
        $visissss = collect();

        foreach ($visits as $v){
            foreach ($v as $v2){
                $visissss->push($v2);                
            }
        }
        
        $count_us = $users->count();
        $array = json_decode($users, 1);
        $array2 = json_decode($visissss, 1);
        $new_array = array_replace_recursive($array, $array2);

        // $json = json_encode($new_array, 1);
        // $users = (collect($new_array));
        // $users = (object)$new_array;

        
        $users = collect($new_array);
        $users= $users->toArray();
        $lesson = Lesson::withTrashed()->find($id);
        return view('lessons.show', compact('lesson'), compact('users'));

        // $visit = DB::table('user_visit_lesson')
        //     ->where('user_visit_lesson.les_id', '=', $id)
        //     ->select('user_visit_lesson.les_id', 'user_visit_lesson.user_id', 'user_visit_lesson.is_visits')
        //     ->get();
        // return $users[0]['surname'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

        $lesson = Lesson::withTrashed()->find($id);
        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::withTrashed()->find($id);
        $lesson->name = $request->name;
        $lesson->class = $request->class;
        $lesson->teacher = $request->teacher;
        $lesson->group_id = $request->group_id;
        $time = Carbon::parse($request->date);
        $lesson->date = $time;
        $lesson->update();
        $id = $lesson->id;
        return redirect()->route('lesson.show', compact('id'))->with('success', 'Карточка успешна обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $lesson = Lesson::withTrashed()->findOrFail($id);
        if (!$lesson->trashed()) {
            $lesson->delete();
        } else {
            $lesson->forceDelete();
        }
        return redirect()
            ->route('lesson.index')
            ->with('success', 'Карточка успешна удалена');
    }

    public function destroyAdmin(Request $request, $id)
    {
        $lesson = Lesson::withTrashed()->findOrFail($id);
        if (!$lesson->trashed()) {
            $lesson->delete();
        } else {
            $lesson->forceDelete();
        }
        return redirect()
            ->route('admin.lesson.index')
            ->with('success', 'Карточка успешна удалена');
    }
}
