<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CmstagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'url_page'=>$this->url_page,
            'meta_title'=>$this->meta_title,
            'meta_keywords'=>$this->meta_keywords,
            'meta_description'=>$this->meta_description,



        ];
    }
}
