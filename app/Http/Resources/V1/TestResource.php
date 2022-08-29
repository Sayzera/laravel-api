<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * Bu yöntem veritabanında eşleşen tüm verileri döndürür
         */
        // return parent::toArray($request);

        return [
            'type' => 'test data',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title(),
                'slug' => $this->slug,
                'created_at' => $this->created_at,
                'id' => $this->id
            ],
        ];
    }
}
