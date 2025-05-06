<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $post = Post::all();

       return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $post = Post::create($request->all());

      return response()->json($post, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $post = Post::find($id);

       return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->content = $request->content;
  
        $post->update();
  
        return response()->json($post, 201);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

        $post = Post::find($id);

        $post->delete();

        return response()->json(['message' => 'Post deleted'], 201);

        }catch(Throwable $e){

            return response()->json($e->getMessage(), 402);
        }
    }
}
