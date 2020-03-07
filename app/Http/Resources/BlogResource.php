<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' =>$this->category->id,
            'category_name' =>$this->category->name,
            'tags' => TagResource::collection($this->tags)
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
            'message' => 'message here...'
        ];
    }
}
