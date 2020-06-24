<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\tag;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $data = $request->all();

        // Get user ID
        $data['user_id'] = 1;

        // Generate post slug
        $data['slug'] = Str::slug($data['title'], '-');

        // New post
        $newPost = new Post();
        $newPost->fill($data);

        $saved = $newPost->save();

        if ($saved) {
            if (!empty($data['tags'])) {
                $newPost->tags()->attach($data['tags']);
            }

            return redirect()->route('posts.show', $newPost->slug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (empty($post)) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationRules());

        $data = $request->all();

        $updated = $post->update($data);

        if ($updated) {
            if(!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            } else {
                $post->tags()->detach();
            }
            return redirect()->route('posts.show', $post->slug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (empty($post)) {
            abort('404');
        }
        // ref
        $title = $post->title;

        // reomove
        $post->tags()->detach();
        $deleted = $post->delete();

        if ($deleted) {
            return redirect()->route('posts.index')->with('post-deleted', $title);
        }
    }

    /**
     * Define validation rules
     */
    private function validationRules() 
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'tags.*' => 'exists:tags,id'
        ];
    }
}
