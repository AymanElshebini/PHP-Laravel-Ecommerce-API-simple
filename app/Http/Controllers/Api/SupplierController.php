<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\admin\SupplierResource;


class SupplierController extends Controller
{
    /* -------( Display aLL Suppliers )------- */
    public  function  GetAllSuppliers()
    {
        $supplier=Supplier::when(request('search'),function ($query)
        {
            $query->where('name','like','%'.request('search').'%');
        })->orderBy('id','desc')->paginate(50);
   

         return SupplierResource::collection($supplier);


 // return new  SupplierCollection($supplier);
    }
/* -------( Show One Supplier )------- */
    public  function  GetOneSupplier($id)
    {
        $supplier=Supplier::select('*')->where('id', '=', $id)->get();
        if($supplier)
        {
            return SupplierResource::collection($supplier);
        }
        else{
            return SupplierResource::collection('suplier not found')->collection;
        }
    }
/* -------( Count Suppliers )------- */
    public function CountSuppliers(Request $request)
    {
        $supplier=Supplier::count();
        return($supplier);
    }
 /* -------( Add New  Supplier )------- */ 
    public function AddSupplier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|min:3',
            'company' => 'required',
            'cityid' => 'required',
            'tel1' => 'required',
           // 'tel2' => 'required',
            'address' => 'required',
    
        ],[
            'name.required'=>'أدخل اسم المورد',
            'name.string'=>'أدخال المحافظة غير صحيح ',
           'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف ',
            'name.max'=>'خطاء الاسم لاقبل أكثر من 100 حرف ',
            'company.required'=>'أدخل أسم الشركة',
            'cityid.required'=>'أدخل المحافظة',
            'tel1.required'=>'أدخل رقم التليفون الاول ',
           // 'tel2.required'=>'أدخل رقم ا لتليفون الثاني',
            'address.required'=>'أدخل عنوان المورد',
          

    
        ]);
    
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }else{
            $supplier= new Supplier;
            $supplier->name=$request->input('name');
            $supplier->company=$request->input('company');
            $supplier->cityid=$request->input('cityid');
            $supplier->tel1=$request->input('tel1');
          
            if( $supplier->tel2=$request->input('tel2')===null)
            {
                $supplier->tel2=0;
            }
            else
            {
                $supplier->tel2=$request->input('tel2');
            }

            $supplier->address=$request->input('address');
           /*
            if($supplier->memo=$request->input('memo')===null)
            {
                $supplier->memo="لا يوجد ملاحظات";
            }
            
            else 
            {
                $supplier->memo=$request->input('memo');
            }
            */
            $supplier->save();
            return response()->json([
                'status' => 200,
                'message' => 'تم حفظ القسم بنجاح',
            ]);
        }
    }
 /* -------( Find Edit  Supplier )------- */ 
    public  function EditSupplier($id)
    {
        $supplier=Supplier::findOrFail($id);
       
        if($supplier)
        {
            return response()->json($supplier);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No Supplier Found',
            ]);

        }
       
    }
 /* -------( Update   Supplier )------- */ 
    public  function  UpdateSupplier(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|min:3',
            'company' => 'required',
            'cityid' => 'required',
            'tel1' => 'required',
            //'tel2' => 'required',
            'address' => 'required',
    
        ],[
            'name.required'=>'أدخل اسم المورد',
            'name.string'=>'أدخال المحافظة غير صحيح ',
            'name.unique'=>'خطاء الاسم مسجل من قبل ',
            'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف ',
            'name.max'=>'خطاء الاسم لاقبل أكثر من 100 حرف ',
            'company.required'=>'أدخل أسم الشركة',
            'cityid.required'=>'أدخل المحافظة',
            'tel1.required'=>'أدخل رقم التليفون الاول ',
            'address.required'=>'أدخل عنوان المورد',
          

    
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }else{
            $supplier=Supplier::find($id);

            if($supplier)
            {
                $supplier->name=$request->input('name');
                $supplier->company=$request->input('company');
                $supplier->cityid=$request->input('cityid');
                $supplier->tel1=$request->input('tel1');
                $supplier->tel2=$request->input('tel2');
                $supplier->address=$request->input('address');
                 $supplier->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'تم حفظ التعديل بنجاح',
                ]);
            }else {
                return response()->json([
                    'status' => 404,
                    'message' => 'supplier not found',
                ]);
            }
        }
    }
 /* -------( Delete one Supplier )------- */ 
    public  function DeleteSupplier($id)
    {
        $supplier=Supplier::find($id);
        if(empty($supplier))
        {
            return response()->json(['status'=>'error','message'=>'supplier not found '],404);

        }elseif ($supplier->delete())
        {
            return response()->json(['status'=>'success','data'=>$supplier],200);

        }else
        {
            return response()->json(['status'=>'error'],500);
        }
    }
}
