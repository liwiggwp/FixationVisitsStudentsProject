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

    public function indexAdmin()
    {
        $lessons =   DB::table('users')
        ->join('user_group', 'users.id', '=', 'user_group.user_id')
        ->join('studygroup', 'user_group.group_id', '=', 'studygroup.id')
        ->join('lessons', 'lessons.group_id', '=', 'studygroup.id')->Paginate(6);
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
        $lesson->name = $request->name;
        $lesson->class = $request->class;
        $lesson->teacher = $request->teacher;

        $lesson->group_id = $request->group_id;
        $time = Carbon::parse($request->date);
        $lesson->date = $time;

        $lesson->save();

        $last_les = DB::table('lessons')->orderByDesc('id')->limit(1)->get();

        $users = DB::table('user_group')
            ->join('users', 'user_group.user_id', '=', 'users.id')
            ->where('user_group.group_id', '=', $last_les[0]->group_id)
            ->get();
        foreach ($users as $u) {
            DB::table('user_visit_lesson')->insert([
                'les_id' => $last_les[0]->id,
                'user_id' => $u->id,
                'is_visits' => 0
            ]);
        }
        return redirect()->route('lesson.index')->with('success', 'Карточка успешна создана');
    }
    public function pp(Request $request, $id)
    {
        $input = $request->all();
        $temp = collect();
        foreach ($input as $key => $value) {
            $temp->push($key);
        }
        $temp->shift();

        DB::table('user_visit_lesson')
            ->where('user_visit_lesson.les_id', '=', $id)
            ->where('user_visit_lesson.user_id', '=', $temp)
            ->update(['is_visits' => 1]);
        $f = DB::table('user_visit_lesson')
            ->where('user_visit_lesson.les_id', '=', $id)->get();
        $ro = '/lesson/show/' . $id;

        return redirect()->to($ro);
    }
    public function nn(Request $request, $id)
    {
        $input = $request->all();
        $temp = collect();
        foreach ($input as $key => $value) {
            $temp->push($key);
        }
        $temp->shift();

        DB::table('user_visit_lesson')
            ->where('user_visit_lesson.les_id', '=', $id)
            ->where('user_visit_lesson.user_id', '=', $temp)
            ->update(['is_visits' => 0]);
        $f = DB::table('user_visit_lesson')
            ->where('user_visit_lesson.les_id', '=', $id)->get();

        // return $f;
        $ro = '/lesson/show/' . $id;
        return redirect()->to($ro);
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
        $us = $users;
        $visits = collect();
        foreach ($users as $u) {
            $visits->push(DB::table('user_visit_lesson')
                ->where('user_visit_lesson.les_id', '=', $id)
                ->where('user_visit_lesson.user_id', '=', $u->id)
                ->select('user_visit_lesson.is_visits')
                ->get());
        }
        $visissss = collect();

        foreach ($visits as $v) {
            foreach ($v as $v2) {
                $visissss->push($v2);
            }
        }

        $array = json_decode($users, 1);
        $array2 = json_decode($visissss, 1);
        $new_array = array_replace_recursive($array, $array2);

        $users = collect($new_array);
        $users = $users->toArray();
        $lesson = Lesson::withTrashed()->find($id);

        return view('lessons.show', compact('lesson'), compact('users'));
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
