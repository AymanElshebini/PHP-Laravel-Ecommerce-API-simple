<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;



class CityController extends Controller
{
    public  function  GetAllCity()
    {

         $city= City::when(request('search'),function ($query)
         {
             $query->where('name','like','%'.request('search').'%');

         })->orderBy('id','desc')->paginate(10);

           return CityResource::collection($city);



    //    return CityResource::collection(City::paginate(10));

    }

    public  function  GetOneCity($id)
    {
        $city=City::select('*')->where('id', '=', $id)->get();
        if($city)
        {
            return CityResource::collection($city)->collection;
        }
        else{
            return CityResource::collection('city not found')->collection;
        }
    }

    public function countCity(Request $request)
    {
        $city=City::count();

        return($city);

    }
    public function AddCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:cities|max:60|min:3',

        ],[
            'name.required'=>'يجب أدخال أسم المحافظة',
            'name.string'=>'أدخال المحافظة غير صحيح ',
            'name.unique'=>'خطاء الاسم مسجل من قبل ',
            'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف ',
            'name.max'=>'خطاء الاسم لاقبل أكثر من 60 حرف ',

        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }else{
            $city= new City;
            $city->name=$request->input('name');
            $city->save();
            return response()->json([
                'status' => 200,
                'message' => 'تم حفظ المدينة بنجاح',
            ]);
        }


    }

    public  function EditCity($id)
    {
        $city=City::find($id);
        if($city)
        {
            return response()->json([
                'status' => 200,
                'city' => $city,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No product Found',
            ]);

        }
    }

    public  function  UpdateCity(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:cities|max:60|min:3',

        ],[
            'name.required'=>'يجب أدخال أسم المحافظة',
            'name.string'=>'أدخال المحافظة غير صحيح ',
            'name.unique'=>'خطاء الاسم مسجل من قبل ',
            'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف ',
            'name.max'=>'خطاء الاسم لاقبل أكثر من 60 حرف ',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        }else{
            $city= City::find($id);

            if($city)
            {
                $city->name=$request->input('name');
                $city->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'تم حفظ القسم بنجاح',
                ]);
            }else {
                return response()->json([
                    'status' => 404,
                    'message' => 'city not found',
                ]);
            }
        }
    }

    public  function DeleteCity($id)
    {
        $city= City::find($id);
        if(empty($city))
        {
            return response()->json(['status'=>'error','message'=>'city not found '],404);

        }elseif ($city->delete())
        {
            return response()->json(['status'=>'success','data'=>$city],200);

        }else
        {
            return response()->json(['status'=>'error'],500);
        }
    }
}
