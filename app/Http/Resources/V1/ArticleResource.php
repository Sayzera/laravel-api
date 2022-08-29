<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ArticleResource extends JsonResource
{

    public static $wrap = 'articles';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    /**
     * Eğer bu sınıf tanımlanmadıysa veriler article collection sınıfından geçirilir.
     */
    public function toArray($request)
    {
       return [
            'type' => 'articles',
            // veriyi dinamik olarak döndürmesi için
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title(),
                'slug' => $this->slug(),
                'created_at' => $this->created_at,
                'id' => $this->id,
            ],
            'relationshios' => [
                'author' => AuthorResource::make($this->author()),
            ],
            'links' => [
                'self' => route('articles.show', $this->id()),
                'related' => route('articles.show', $this->slug())
            ],
       ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',

        ];
    }

    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
    }
}
