<?php

namespace App\Models;
use App\Models\City;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    protected $guarded=[];

   protected $table = 'suppliers';
   protected  $primaryKey='id';


    public function product()
    {
        return $this->hasMany(Product::class,'supplierid','id');



    }


    public function City ()
    {


        return $this->belongsTo(City::class,'cityid');

    }
}
