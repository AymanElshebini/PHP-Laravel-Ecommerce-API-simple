<?php

namespace App\Models;
use App\Models\Order;
use App\Models\Costomer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $guarded=[];

   /*
    public function order()
    {
        return $this->hasMany(Order::class,'cityid','id');

    }
    */

    public function suppliers()
    {
        return $this->hasMany(Supplier::class,'cityid','id');

    }

    public function costomer()
    {
        return $this->hasMany(Costomer::class,'cityid','id');
        
    }
}
