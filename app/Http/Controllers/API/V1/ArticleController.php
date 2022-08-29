<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ArticleCollection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $article = Article::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'author_id' => auth()->id() ?? 1
        ]);

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201); // 201 Created
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        return (new ArticleResource($article))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {   
        /**
         * Mevcut article title bakmadan yeni title kontrolü yapılır.
         */
       $validator =  Validator::make($request->all(), [
            'title' => ['required', 'max:20', Rule::unique('articles')->ignore($article->title(), 'title')],
            'body' => ['required', 'min:5'],
       ],
       [
        'title.required' => 'Başlık alanı zorunludur.',
        'title.max' => 'Başlık alanı en fazla :max karakter olabilir.',
        'title.unique' => 'Bu başlık daha önce kullanılmış.',
        'body.required' => 'İçerik alanı zorunludur.',
        'body.min' => 'İçerik alanı en az :min karakter olabilir.',
       ]
    );

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => true
            ], 422);
        }

        $article->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'author_id' => auth()->id() ?? 1
        ]);

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(200); // 200 OK
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
      $article->delete();
      return response()->json(null, 204); // 204 No Content
     
    }
}
