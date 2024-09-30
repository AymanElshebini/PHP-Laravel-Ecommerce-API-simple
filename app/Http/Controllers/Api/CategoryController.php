<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem;
use Nette\Utils\Image;

class CategoryController extends Controller
{

    public function GetCategory(Request $request)
   {
       $category= Category::when(request('search'),function ($query)
       {
           $query->where('name','like','%'.request('search').'%');

       })->orderBy('id','desc')->paginate(10);

       return CategoryResource::collection($category);

   }

    public  function GetOneCategory($id)
{
    $category=Category::select('*')->where('id', '=', $id)->get();
    if($category)
    {
        return CategoryResource::collection($category)->collection;
    }
    else
        {

            return CategoryResource::collection('city not found')->collection;
    }



}

public function countCategory(Request $request)
{
    $Category=Category::count();
    return($Category);

}




    public function AddCatogory(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|unique:categories|max:100|min:3',
        'meta_title' => 'required|string|max:50|min:3',
        'meta_keywords' => 'required|string|max:255|min:3',
        'meta_description' => 'required|string|max:155|min:3',
        'imgpath' => 'required',


    ],[
        'name.required'=>'يجب أدخال أسم القسم',
        'name.string'=>'أدخال القسم غير صحيح ',
        'name.unique'=>'خطاء الاسم مسجل من قبل ',
        'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف ',
        'name.max'=>'خطاء الاسم لاقبل أكثر من 60 حرف ',
        'meta_title.required'=>'يجب أدخال meta_title',
        'meta_keywords.required'=>'يجب أدخال meta_keywords',
        'meta_description.required'=>'يجب أدخال meta_description',



    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ]);
    } else {
        $category = new Category;
        $category->name = $request->input('name');
        $category->meta_title= $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');


       if ($request->hasFile('imgpath')) {
            $file = $request->file('imgpath');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('uploads/category/', $filename);
            $category->imgpath = 'uploads/category/' . $filename;
        }

        $category->save();
        return response()->json([
            'status' => 200,
            'message' => 'تم حفظ القسم بنجاح',
        ]);


    }
}

    public function EditCatogory($id)
{
    $category = Category::find($id);
    if ($category) {
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No product Found',
        ]);
    }
}

    public function UpdateCatogery(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'imgpath' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages(),
        ]);
    } else {
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->input('name');
            $category->meta_title= $request->input('meta_title');
            $category->meta_keywords = $request->input('meta_keywords');
            $category->meta_description = $request->input('meta_description');
            if ($request->hasFile('imgpath')) {
                $path = $category->imgpath;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('imgpath');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/category/', $filename);
                $category->imgpath = 'uploads/category/' . $filename;
            }
            $category->update();

            return response()->json([
                'status' => 200,
                'message' => 'تم حفظ القسم بنجاح',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Ctogery not found',
            ]);
        }


    }


}

    public function DeleteCatogory($id)
{

    $category=Category::find($id);

    if(empty($category)){
        return response()->json(['status'=>'error','message'=>'catogery not found '],404);

    }elseif ($category->delete())
    {
        return response()->json(['status'=>'success','data'=>$category],200);
    }else
    {
        return response()->json(['status'=>'error'],500);
    }

}
    /*-------admin*/
}
