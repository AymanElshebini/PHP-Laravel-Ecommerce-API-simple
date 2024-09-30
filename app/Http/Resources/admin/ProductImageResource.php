<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
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
             'productid'=>$this->productid,
              //'productImage'=>new ProductResource($this->productImage),
              //'product'=>ProductResource::make($this->product),
              'imgpath'=>asset($this->imgpath),
              
  
  
  
          ];
    }
}
