<?php

namespace App\Http\Resources\admin;

use App\Http\Resources\admin\CityResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'company'=>$this->company,
            'city'=>new CityResource($this->city),
          'city'=>CityCollection::make($this->city),
           // 'city'=>$this->city_id,
            'tel1'=>$this->tel1,
            'tel2'=>$this->tel2,
            'address'=>$this->address,
            'memo'=>$this->memo,

        ];
    }
}
