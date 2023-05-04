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

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT users.id, users.name, studygroup.id 
        // FROM users 
        // join user_group ON users.id = user_group.user_id
        // join studygroup ON user_group.group_id = studygroup.id
        // WHERE users.id = '1'

        if (Auth::check()) {
            if (auth()->user()->isAdmin()) {
                $lessons = Lesson::whereDate('date', '=', Carbon::now())
                    ->get();
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

                // select * from lessons
                // WHERE group_id = 1 and `date` = CURRENT_DATE()
                $lessons = DB::table('lessons')
                    ->whereDate('date', '=', Carbon::now())
                    ->where('group_id', '=', $gr_id)
                    ->get();
                // $lessons = Lesson::whereDate('date', '=', Carbon::now())->get();
                // return $lessons;

                // $lessons = Lesson::whereDate('date', '=', Carbon::now())
                // ->get();
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
        $lesson = Lesson::withTrashed()->find($id);
        return view('lessons.show', compact('lesson'));
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
