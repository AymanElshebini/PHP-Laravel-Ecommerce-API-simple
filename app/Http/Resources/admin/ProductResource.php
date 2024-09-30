<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'code'=>$this->code,
            'supplier'=>new SupplierResource($this->Supplier),
             'supplierprice'=>$this->supplierprice,
              'category'=>new CategoryResource($this->category),
              'name'=>$this->name,
              'pricesell'=>$this->pricesell,
              'priceoffer'=>$this->priceoffer,
              'stock'=>$this->stock,
              'fullDesc'=>$this->fullDesc,
             'imgpath'=>asset($this->imgpath),
              'meta_keywords'=>$this->meta_keywords,
             'productimage'=>ProductImageResource::collection($this->ProductImage),

          
           // 'productImage'=> new ProductImageResource($this->productImage)
             
           

              
              

            
            

        ];
    }
}
