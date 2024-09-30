<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
   // protected $guarded=[];
    protected $table='product_images';
    protected $fillable=[
        'productid',
        'imgpath'
    ];
    public function product ()
    {
        return $this->belongsTo(Product::class,'productid','id');
    }


    public function getimgpathAttribute($imgpath)
    {
        return asset($imgpath);
    }
}
