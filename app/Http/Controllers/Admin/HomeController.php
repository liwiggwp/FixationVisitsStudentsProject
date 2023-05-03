<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
//    public  function index(){
//        $posts_count = Post::all()->count();
//
//        return view('admin.home.index',[
//            'posts_count'=>$posts_count
//
//        ]);
//
//    }
    public function index(){
        $lessons = Lesson::withTrashed()->Paginate(6);
        return view('admin.home.index',compact('lessons'));
    }

}
