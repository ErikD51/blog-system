<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(3);
        return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/blog')->with('message', 'Dein Blog-Eintrag wurde hinzugefügt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('blog.show')
            ->with('post', Post::where('slug', $slug)->first())
            ->with('comments', Comment::where('post_id', Post::where('slug', $slug)->pluck('id'))->orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        return view('blog.edit')->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::where('slug', $slug)->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/blog')->with('message', 'Dein Beitrag wurde aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();

        return redirect('/blog')->with('message', 'Dein Beitrag wurde gelöscht!');
    }
}
