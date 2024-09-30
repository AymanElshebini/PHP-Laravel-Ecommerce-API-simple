<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\admin\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //display all catogery 
    public function getallUsers(Request $request)
   {
       $user= User::when(request('search'),function ($query)
       {
           $query->where('name','like','%'.request('search').'%');

       })->orderBy('id','desc')->paginate(50);

       return UserResource::collection($user);

   }
   public function login(Request $request)
   { 

       /*Valadation */
       $validator = Validator::make($request->all(), [
           'email' => 'required|string|email',
           'password'=>'required',



       ],[
          
           'email.required'=>'يجب أدخال البريد الالكتروني',
           'password.required'=>'يجب أدخال  كلمة المرور',
           

       ]);

       if ($validator->fails()) {
           $response=[
            'status' => 'error',
            'errors' => $validator->errors(),
               
           ];
           return response()->json($response,400);
       }
       
       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
       {
          // $user=Auth::user();
           $user=$request->user();
           $success['token']=$user->createToken('MyApp')->plainTextToken;
               $success['name']=$user->name;
              
               $response=[
                   'success' => true,
                   'data'=>$success,
                   'message' => "تم الدخول بنجاح",
                   
               ];
               
   
          
   
   
           return response()->json($response,200);
   
       }else 

       return response()->json(['message'=>'Unauthorised user name and pass not right'],404);

      
   }

  public function AddUser(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' => 'required|max:100|min:3',
          'email' => 'required|string|email|max:255|unique:users',
          'password'=>'required',

      ],[
          'name.required'=>'يجب أدخال أسم المستخدم',
          'name.string'=>'أدخال المستخدم غير صحيح ',
          'name.unique'=>'خطاء الاسم مسجل من قبل ',
          'name.min'=>'خطاء في الادخال يجب كتابة أكثر من 3 حروف ',
          'name.max'=>'خطاء الاسم لاقبل أكثر من 60 حرف ',
          'email.required'=>'يجب أدخال البريد الالكتروني',
          'email.email'=>'الادخال المسجل ليس بريد الكتروني ',
          'password.required'=>'يجب أدخال  كلمة المرور',
         
     




      ]);
         
      if ($validator->fails()) {
       return response()->json([
           'status' => 'error',
           'errors' => $validator->errors(),
       ]);



         
      }else {
       $input=$request->all();
       $input['password']=bcrypt($input['password']);
       $user =User::create($input);
              
             
              $success['token']=$user->createToken('MyApp')->plainTextToken;
              $success['name']=$user->name;
             
              return response()->json([
               'status' => 200,
               'message' => 'تم حفظ القسم بنجاح',
           ]);
              
  
         
  
  
         
      }
      
  
       
      
      
  }



  public function logout()
   {
    
       try {
           Session::flush();
           $success = true;
           $message = "Logout successfully";
       } catch (\Illuminate\Database\QueryException $ex) {
           $success = false;
           $message = $ex->getMessage();
       }

       $response = [
           'success' => $success,
           'message' => $message
       ];

       return response()->json($response);
   }



   //display count users 
  public function countUsers(Request $request)
  {
   $user =User::count();
      return($user);

  }

  public function DeleteUser($id)
  {
  
    $user= User::find($id);
  
      if(empty($user)){
          return response()->json(['status'=>'error','message'=>'catogery not found '],404);
  
      }elseif ($user->delete())
      {
          return response()->json(['status'=>'success','data'=>$user],200);
      }else
      {
          return response()->json(['status'=>'error'],500);
      }
  
  }

}
