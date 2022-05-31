<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'author'=>$this->author,
            'rate' => $this->rate,
            'totalpages' => $this->totalpages,
            'img' => $this->img,
            'audio' => $this->audio,
            'tags' => $this->tags,
            'categories' => $this->categories,
           'file' => $this->file,

        ];
    }
}
