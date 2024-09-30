<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product_image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /// protected $guarded=[];
    protected $fillable=[
     'id',
     'code',
     'supplierid',
     'supplierprice',
     'categoryid',
     'name',
     'pricesell',
     'priceoffer',
     'stock',
     'fullDesc',
     'imgpath',  
     'meta_keywords',
     'meta_description',
     
  
  
 ];
 
     public function category()
     {
      
        return $this->belongsTo(Category::class,'categoryid');
     }
     public function supplier()
     {
         return $this->belongsTo(Supplier::class,'supplierid');
     }
     // relation ship with ptoduct image
     
     public function productImage()
     {
         return $this->hasMany(Product_image::class,'productid','id');
     }
 
 
     public  function orderdetial()
     {
         return $this->hasMany(Order_detial::class,'product_id','id');
     }
 
     public function getimgpathAttribute($imgpath)
     {
         return asset($imgpath);
     }
}
