<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=DB::table('posts')->join('users','users.id','=','posts.author')->orderByDesc('created_at');
        //$posts = DB::table('users')->leftjoin('posts', 'users.id', '=', 'posts.author');
        return view('Post.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('photo')){
            $request->validate([
                'title'=>'required|unique:posts|max:255',
                'description'=>'required|min:50',
                'photo'=>'mimes:jpeg,png'
            ]);
            $path=request()->file('photo')->store('public/posts_pics');
            $paths=explode('/',$path);
            $correct_path_that_gonna_work_for_sure=$paths[1].'/'.$paths[2];
             $post=new Post();
            $post->author=Auth::user()->id;
             $post->title=$request->get('title');
             $post->description=$request->get('description');
             $post->photo=$correct_path_that_gonna_work_for_sure;
             $post->save();
        }
        else{
            $request->validate([
                'title'=>'required|unique:posts|max:255',
                'description'=>'required|min:50',
            ]);
            $post=new Post();
            $post->author=Auth::user()->id;
            $post->title=$request->get('title');
            $post->description=$request->get('description');
            $post->photo='';
            $post->save();
        }
        return view('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
