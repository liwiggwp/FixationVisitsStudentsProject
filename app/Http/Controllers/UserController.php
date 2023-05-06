<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->paginate(15);

        return view('admin.user.index', ['users' => $users]);
    }

    public function restoreUser(Request $request,$id){

        Lesson::onlyTrashed()->find($id)->restore();
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Карточка успешна восстановлена');
    }

    public function view_user($id)
    {
        $user = User::find($id);

        // $user = User::where('name', $name)->first();

        # если пользователь не найден в базе
        if ( ! $user ) abort(404);


        // return view('admin.user.view', [
        //     'user' => $user,
        // ]);
        return View::make("admin.user.view")->with(array("user" => $user));

    }

    public function view_post($id){
        $user = User::find($id);

        $posts = $user->posts()->withTrashed()->get();

        return View::make("admin.user.view")->with(array("user" => $user, "posts" => $posts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
       //$posts = User::find($id)->post;
       // return view('admin.user.show',compact('users'));
//        $user = User::find($id);
//        $posts = $user->posts()->get();
//        return view('admin.user.show',compact('posts'));

//compact --> ['posts'=>$posts]
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
