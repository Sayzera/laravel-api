<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BlogRequest;
use App\Http\Resources\V1\BlogCollection;
use App\Http\Resources\V1\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new BlogCollection(Blog::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blog = Blog::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'author_id' => 1
        ]);

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(201); // 201 Created
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Blog $blog)
    {
        return (new BlogResource($blog))
        ->response()
        ->setStatusCode(200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    }

    public function tekBlogGetir(Blog $blog) {
        return (new BlogResource($blog))
        ->response()
        ->setStatusCode(200);
    }
}
