<?php

namespace App\Http\Controllers\Api;

use Illuminate\Filesystem;
use App\Models\Product_image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\admin\ProductImageResource;

class ProductImageController extends Controller
{
    public function GetallProductImage(Request $request)
    {           
        $ProductImage= Product_image::when(request('search'),function ($query)
        {
            $query->where('imgpath','like','%'.request('search').'%');
 
        })->orderBy('id','desc')->paginate(50);
        
 
        return  ProductImageResource::collection($ProductImage)->collection;
 
    }

    //display count ProductImage
    public function countProductImage(Request $request)
    {
        $ProductImage=Product_image::count();
        return($ProductImage);

    }
    public  function GetOneProductImage($id)
    {
        $ProductImage= Product_image::select('*')->where('id', '=', $id)->get();
        if($ProductImage)
        {
            return ProductImageResource::collection($ProductImage)->collection;
        }
        else
            {
    
                return ProductImageResource::collection('Image not found')->collection;
        }
    
       
    }

      //new  ProductImage
      public function AddProductImage(Request $request)
      {
          $validator = Validator::make($request->all(), [
              
              'imgpath' => 'required',
              'productid' => 'required',
              
          ],[
              'imgpath.required'=>'أدخل صورة المنتج',
              'productid.string'=>' أدخل كود المنتج  ',
              
      
      
          ]);
      
          if ($validator->fails()) {
              return response()->json([
                  'status' => 'error',
                  'errors' => $validator->errors(),
              ]);
              
          }
          
          else {
            $ProductImage= new  Product_image;
            
            $ProductImage=$request->file('imgpath');
           
              
      
             if ($request->hasFile('imgpath')) {
                
                foreach ($ProductImage as $image)
                {

                 $imgpath_new_name=time().$image->getClientOriginalName();
                $image->move('uploads/product/',$imgpath_new_name);
                $image= new Product_image();
                $image->imgpath ='uploads/product/'.$imgpath_new_name;
                $image->productid=$request->input('productid');
                $image->save();

                    //////////////
                 //   $ProductImage->save();
                 
                }
              }
      
              
              return response()->json([
                  'status' => 200,
                  'message' => 'تم حفظ القسم بنجاح',
              ]);
      
      
          }
      }

       //Edite ProductImage
       public function EditProductImage($id)
       {
        $ProductImage = Product_image::find($id);
           if ($ProductImage) {
               return response()->json($ProductImage);
               
           } else {
               return response()->json([
                   'status' => 404,
                   'message' => ' الصورة  غير موجود ',
               ]);
           }
       }

       //Update ProductImage
       public function UpdateProductImage(Request $request, $id)
       {
           $validator = Validator::make($request->all(), [
               
               'imgpath' => 'required',
               'productid' => 'required',
               
           ],[
               'imgpath.required'=>'أدخل صورة المنتج',
               'productid.string'=>' أدخل كود المنتج  ',
               
       
       
           ]);
       
           if ($validator->fails()) {
               return response()->json([
                   'status' => 'error',
                   'errors' => $validator->errors(),
               ]);
               
           }
           
           else {

            $ProductImage =Product_image::find($id);
            if ($ProductImage) {
                $ProductImage->productid = $request->input('productid');
                
                if ($request->hasFile('imgpath')) {
                    $path = $ProductImage->imgpath;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('imgpath');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/product/', $filename);
                    $ProductImage->imgpath = 'uploads/category/' . $filename;
                }
                $ProductImage->update();
    
                return response()->json([
                    'status' => 200,
                    'message' => 'تم تعديل  الصور  بنجاح',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Ctogery not found',
                ]);
            }
       
       
           }
       }

       //Delete ProductImage
    
       public function DeleteProductImage($id)
       {
       
        $ProductImage=Product_image::find($id);
       
           if(empty($ProductImage)){
               return response()->json(['status'=>'error','message'=>'image not found '],404);
       
           }elseif ($ProductImage->delete())
           {
               return response()->json(['status'=>'success','data'=>$ProductImage],200);
           }else
           {
               return response()->json(['status'=>'error'],500);
           }
       
       }


       public function ShowProductImage ($id)
       {
        $ProductImage= Product_image::select('*')->where('productid', '=', $id)->get();
        if($ProductImage)
        {
            return ProductImageResource::collection($ProductImage);
        }
        else
            {
    
                return ProductImageResource::collection('Image not found')->collection;
        }
       }
}
