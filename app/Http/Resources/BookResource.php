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
            // 'id'=>$this->id,
            'title'=>$this->title,
            'author'=>$this->author,
            'content'=>$this->content,
            'rate' => $this->rate,
            'img' => $this->img,
            'audio' => $this->audio,
            'file' => $this->file,
            'tags' => $this->tags,
            'categories' => $this->categories,
           'totalpages' => $this->totalpages,

        ];
    }
}
