<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_id' => $this->_id,
            'title' => $this->title,
            'author' => $this->author,
            'price' => $this->price,
            '_links' => [
                [
                    'rel' => 'self',
                    'type' => 'GET',
                    'href' => URL::to('/').'/api/books/'.$this->_id
                ],
                [
                    'rel' => 'delete',
                    'type' => 'DELETE',
                    'href' => URL::to('/').'/api/books/'.$this->_id
                ]
            ]
        ];
    }
}
