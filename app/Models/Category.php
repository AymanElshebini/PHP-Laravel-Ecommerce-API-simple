<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function products()
    {
        return $this->hasMany(Product::class,'categoryid');



    }
    public function getimgpathAttribute($imgpath)
    {
        return asset($imgpath);
    }
}
