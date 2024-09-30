<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Costomer extends  Authenticatable
{
    use HasFactory;
    protected $guarded=[];


    public function City ()
    {


        return $this->belongsTo(City::class,'cityid');

    }

}
