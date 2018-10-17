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
        $posts=DB::table('posts')->join('users','users.id','=','posts.author')->select('posts.id as id','posts.title as title','users.name as name','posts.created_at as created_at')->get();
        //$posts = DB::table('users')->leftjoin('posts', 'users.id', '=', 'posts.author');
        //$posts=Post::all();
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
                'title'=>'required|unique:posts|max:100',
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
                'title'=>'required|unique:posts|max:100',
                'description'=>'required|min:50',
            ]);
            $post=new Post();
            $post->author=Auth::user()->id;
            $post->title=$request->get('title');
            $post->description=$request->get('description');
            $post->photo='';
            $post->save();
        }
        return redirect(route('posts.show',compact('post')));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $author=DB::table('users')->where('id','=',$post->author)->first();
        return view('Post.show',['post'=>$post,'author'=>$author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->author==Auth::user()->id)
        return view('Post.edit',compact('post'));
        else abort(404);
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
        if ($request->hasFile('photo')){
            $request->validate([
                'title'=>'required|unique:posts,'.$post->id.'|max:100',
                'description'=>'required|min:50',
                'photo'=>'mimes:jpeg,png'
            ]);
            $path=request()->file('photo')->store('public/posts_pics');
            $paths=explode('/',$path);
            $correct_path_that_gonna_work_for_sure=$paths[1].'/'.$paths[2];
            $post->photo=$correct_path_that_gonna_work_for_sure;
        }
        else{
            $request->validate([
                'title'=>'required|unique:posts,title,'.$post->id.'|max:100 ',
                'description'=>'required|min:50',
            ]);


        }

        $post->title=$request['title'];
        $post->description=$request['description'];
        $post->save();

        return redirect(route('posts.show',compact('post')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
