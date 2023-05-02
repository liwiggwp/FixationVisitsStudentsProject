<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(){
        // $posts = Post::join('users','user_id','=','users.id')
        // ->orderBy('posts.created_at', 'desc')
        // ->Paginate(6);
        //     return view('posts.index',compact('posts'));

        // $posts = Lesson::join('groups','les_id','=','groups.id')
        //     ->orderBy('lessons.created_at', 'desc')
        //     ->Paginate(6);
        //         return view('lessons.index',compact('lessons'));
    }

    // public function indexAdmin(){
    //     $posts=Lesson::withTrashed()->Paginate(6);
    //     return view('admin.lessons.index',compact('lessons'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view('lessons.create',);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function store(Request $request)
    // {
    //     $post = new Lesson();
    //     // $post->user_id = Auth::user()->id;
    //     $post->name = $request->name;
    //     $post->class = $request->class;
    //     $post->group_id = $request->group_id;
      
    //     $post->save();

    //     return redirect()->route('lesson.index')->with('success', 'Карточка успешна создана');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $lesson = Lesson::join('users','user_id','=','users.id')
    //         ->find($id);
    //     return view('lessons.show',compact('lesson'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $post = Lesson::find($id);
    //     return view('lessons.edit', compact('lesson'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function update(Request $request, $id)
    // {
    //     $post = Lesson::find($id);
    //     $post->name = $request->name;
    //     $post->class = $request->class;
    //     $post->group_id = $request->group_id;
    //     $post->update();
    //     $id = $post->post_id;
    //     return redirect()->route('lesson.show',compact('id'))->with('success', 'Карточка успешна обновлена');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function destroy($id)
    // {
    //     $post = Lesson::find($id);
    //     $post->delete();
    //     return redirect()
    //         ->route('lesson.index')
    //         ->with('success', 'Карточка успешна удалена');
    // }

    // public function destroyAdmin(Request $request,$id)
    // {
    //     $post = Lesson::withTrashed()->findOrFail($id);
    //     if(!$post->trashed()){
    //         $post->delete();
    //     }
    //     else {
    //         $post->forceDelete();
    //     }
    //     return redirect()
    //         ->route('admin.lesson.index')
    //         ->with('success', 'Карточка успешна удалена');
    // }

    // public function restoreAdmin(Request $request,$id){

    //     Lesson::onlyTrashed()->find($id)->restore();
    //     return redirect()
    //         ->route('admin.lesson.index')
    //         ->with('success', 'Карточка успешна восстановлена');
    // }
}
