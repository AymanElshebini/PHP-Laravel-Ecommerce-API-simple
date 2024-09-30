<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Filesystem;
use App\Models\Product_image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\admin\ProductResource;
use App\Http\Resources\admin\CategoryResource;

class ProductController extends Controller
{
   /* -------( Display aLL Product )------- */
   public function GetAllProduct(Request $request)
   {

   
      $product = Product::when($request->search, function ($q) use ($request) {

           return $q->where('name', 'like','%' . $request->search . '%')
              ->orWhere('code', 'like','%' . $request->search . '%')
               ->orWhere('name', 'like','%' . $request->search . '%');

       })
           ->when($request->category_id, function ($q) use ($request) {

           return $q->where('category_id', $request->category_id);

       })->latest()->paginate(50);

       return ProductResource::collection($product);
     
       /*
       $product= Product::when(request('search'),function ($query)
       {
           $query->where('name','like','%'.request('search').'%');

       })->orderBy('id','desc')->paginate(12);

       return ProductResource::collection($product);
*/
   }
/* -------( Display One Product )------- */
   public  function GetOneProduct($id)
   {
       $product= Product::select('*')->where('id', '=', $id)->get();
       if($product)
       {
           return ProductResource::collection($product);
       }
       else
       {

           return ProductResource::collection('Prodacts not found')->collection;
       }

   }
/* -------( Display count Product )------- */
   public function CountProduct(Request $request)
   {
       $product= Product::count();
       return($product);

   }

/* -------( Display Code number Product )------- */
   public function ProductMaxNumber(Request $request)
   { 
        $code='S000';
        $max_products=Product::all()->max('id');   
        if($max_products==null)
        {
            $max_products=1;
        }
        else 
        {
            $max_products=Product::all()->max('id');   
        }
       
       return response()->json( $code . $max_products );
     
        
         
       
           
     
      
     
   }


/* -------( Add New  Product )------- */
   public function AddNewProduct(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'code'=>'required',
           'supplierid'=>'required',
           'supplierprice'=>'required',
           'categoryid'=>'required',
           'name' => 'required|string|max:100|min:3',
           'pricesell'=>'required',
           'priceoffer'=>'required',
           'stock'=>'required',
           'fullDesc'=>'required',
           'imgpath'=>'required',     
           'meta_keywords'=>'required',
               
           


       ],[
           'code.required'=>'يجب أدخال  الكود',         
           'price_sell.required'=>'يجب أدخال السعر ',
            'supplierid.required'=>'يجب أدخال المورد',
            'supplierprice.required'=>'يجب أدخال سعر الشراء',
            'categoryid.required'=>'يجب أدخال أسم القسم',
            'name.required'=>'يجب أدخال أسم المنتج',
            'name.string'=>'أدخال القسم غير صحيح ',
            'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف',
            'name.max'=>'خطاء الاسم لاقبل أكثر من 60 حرف ',
            'pricesell.required'=>'يجب أدخال سعر البيع',
                     
            'stock.required'=>'يجب ادخال كميه المخزن',
            'fullDesc.required'=>'يجب ادخال وصف المنتج',
            'imgpath.required'=>'يجب ادخال صورة المنتج',     
            'meta_keywords.required'=>'meta_keywords',
        
           

       ]);

       if ($validator->fails()) {
           return response()->json([
               'status' => 'error',
               'errors' => $validator->errors(),
           ]);
       } else {
           $product = new Product;
           $product->code = $request->input('code');
           $product->supplierid = $request->input('supplierid');
           $product->supplierprice = $request->input('supplierprice');
           $product->categoryid = $request->input('categoryid');
           $product->name= $request->input('name');
           $product->pricesell = $request->input('pricesell');
           $product->priceoffer = $request->input('priceoffer');
           $product->stock = $request->input('stock');
           $product->fullDesc = $request->input('fullDesc');       
           $product->meta_keywords = $request->input('meta_keywords');
       
           $product->save();
           // save image in tabel images 
           if ($request->hasFile('imgpath')) {
            
            $image=$request->file('imgpath');

            foreach ($image as $image)
            {

                
                $imgpath_new_name=time().$image->getClientOriginalName();
                $image->move('uploads/product/',$imgpath_new_name);
                $image= new Product_image();
                $image->imgpath ='uploads/product/'.$imgpath_new_name;
                $image->productid=$product->id;
                $image->save();

            }


            /*
               $file = $request->file('imgpath');
               $extension = $file->getClientOriginalName();
               $filename = time() . '.' . $extension;
               $file->move('uploads/product/', $filename);
               $product->imgpath = 'uploads/product/' . $filename;

               */
           }
        
          

           return response()->json([
               'status' => 200,
               'message' => 'تم حفظ القسم بنجاح',
           ]);


       }
   }
/* -------( Edit  Product )------- */
   public function EditProduct($id)
   {
       $product=Product::find($id);
       //  return response()->json($supplier);
 
        
         if($product)
         {
             return response()->json($product);
 
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => 'No Supplier Found',
             ]);
 
         }
   }
/* -------( update  Product )------- */
   public function UpdateProduct(Request $request, $id)
   {

    $product = Product::find($id);
       $validator = Validator::make($request->all(), [
        'code'=>'required',
        'supplierid'=>'required',
        'supplierprice'=>'required',
        'categoryid'=>'required',
        'name' => 'required|string|max:100|min:3',
        'pricesell'=>'required',
         'priceoffer'=>'required',
        'stock'=>'required',
        'fullDesc'=>'required',
       //'imgpath'=>'required',
       
        'meta_keywords'=>'required',
         
           


       ],[
           'code.required'=>'يجب أدخال  الكود',         
           'price_sell.required'=>'يجب أدخال السعر ',
            'supplierid.required'=>'يجب أدخال المورد',
            'supplierprice.required'=>'يجب أدخال سعر الشراء',
            'categoryid.required'=>'يجب أدخال أسم القسم',
            'name.required'=>'يجب أدخال أسم المنتج',
            'name.string'=>'أدخال القسم غير صحيح ',
            'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف',
            'name.max'=>'خطاء الاسم لاقبل أكثر من 60 حرف ',
            'pricesell.required'=>'يجب أدخال سعر البيع',
           
            'priceoffer.required'=>'يجب ادخال سعر الخصم',
            'stock.required'=>'يجب ادخال كميه المخزن',
            'fullDesc.required'=>'يجب ادخال وصف المنتج',
           // 'imgpath.required'=>'يجب ادخال صورة المنتج',
           
            'meta_keywords.required'=>'meta_keywords',
           

       ]);


       if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ]);
    } else {
        $product =Product::find($id);
       // $product = new Product;
       if($product){
        $product->code = $request->input('code');
        $product->supplierid = $request->input('supplierid');
        $product->supplierprice = $request->input('supplierprice');
        $product->categoryid = $request->input('categoryid');
        $product->name= $request->input('name');
        $product->pricesell = $request->input('pricesell');
        $product->priceoffer = $request->input('priceoffer');
        $product->stock = $request->input('stock');
        $product->fullDesc = $request->input('fullDesc');       
        $product->meta_keywords = $request->input('meta_keywords');
        $product->update();

        if ($request->hasFile('imgpath')) {
            
            $image=$request->file('imgpath');

            foreach ($image as $image)
            {

                
                $imgpath_new_name=time().$image->getClientOriginalName();
                $image->move('uploads/product/',$imgpath_new_name);
                $image= new Product_image();
                $image->imgpath ='uploads/product/'.$imgpath_new_name;
                $image->productid=$product->id;
                $image->save();

            }


            /*
               $file = $request->file('imgpath');
               $extension = $file->getClientOriginalName();
               $filename = time() . '.' . $extension;
               $file->move('uploads/product/', $filename);
               $product->imgpath = 'uploads/product/' . $filename;

               */
           }
/*

        if ($request->hasFile('imgpath')) {
            $path = $request->hasFile('imgpath');
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    
         foreach ($request->file('imgpath') as $image)
         {
            
             $imgpath_new_name=time().$image->getClientOriginalName();
             $image->move('uploads/product/',$imgpath_new_name);
             $image= new ProductImage();
             $image->imgpath ='uploads/product/'.$imgpath_new_name;
             $image->productid=$product->id;
             $image->save();

         }
   
        */
       
        return response()->json([
            'status' => 200,
            'message' => 'تم حفظ المنتج  بنجاح',
        ]);

       }

       
     
       

       

    }

   }

   /* -------( Delete  Product )------- */
   public function DeleteProduct($id)
   {

       $product = Product::find($id);

       if(empty($product)){
           return response()->json(['status'=>'error','message'=>'prodact not found '],404);

       }elseif ($product->delete())
       {
           return response()->json(['status'=>'success','data'=>$product],200);
       }else
       {
           return response()->json(['status'=>'error'],500);
       }

   }
   public function  GetCategoryProdact()
   {
       $Category=Category::all();
       return CategoryResource::collection($Category);
   }

   public function showAllImagesProdact($id)
  {

   $productimages=Product_image::select('*')->where('productid', '=', $id)->get();
       if($productimages)
       {
           return Product_image::collection($productimages)->collection;
       }
       else
       {

           return Product_image::collection('Prodacts not found')->collection;
       }
  }

  public function GetProdactCategory($id= null)
  {
     
      $cateogory_products=Product::where('categoryid',$id)->inRandomorder()->paginate(100);
      return ProductResource::collection($cateogory_products);

   //   return ProductResource::collection($cateogory_products)->collection;
      
  }
}
