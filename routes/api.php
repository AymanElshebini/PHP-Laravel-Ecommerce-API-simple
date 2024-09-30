<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CmstagController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ProductImageController;
use App\Http\Controllers\Api\frontend\FrontendController;
use App\Http\Controllers\Api\OrderController;

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//---------users------------------------------------------------------------------------------------------///
Route::get('/getallUsers', [UserController::class, 'getallUsers'])->middleware('auth:sanctum');
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::post('/AddUser',[UserController::class,'AddUser'])->middleware('auth:sanctum');
Route::get('/countUsers', [UserController::class, 'countUsers'])->middleware('auth:sanctum');
Route::delete('/DeleteUser/{id}',[UserController::class, 'DeleteUser'])->middleware('auth:sanctum');
//---------./users------------------------------------------------------------------------------------------///

//---------(Catogery)------------------------------------------------------------------------------------------///

Route::get('/getallcategory', [CategoryController::class, 'getallcategory'])->middleware('auth:sanctum');
Route::get('/GetOneCategory/{id}',[CategoryController::class, 'GetOneCategory'])->middleware('auth:sanctum');
Route::get('/countCategory', [CategoryController::class, 'countCategory'])->middleware('auth:sanctum');
Route::post('/AddCatogory',[CategoryController::class, 'AddCatogory'])->middleware('auth:sanctum');
Route::get('/EditCatogory/{id}',[CategoryController::class, 'EditCatogory'])->middleware('auth:sanctum');
Route::post('/UpdateCatogery/{id}',[CategoryController::class, 'UpdateCatogery'])->middleware('auth:sanctum');
Route::delete('/DeleteCatogory/{id}',[CategoryController::class, 'DeleteCatogory'])->middleware('auth:sanctum');
///---------.\Catogery------------------------------------------------------------------------------------------///

//---------(city)------------------------------------------------------------------------------------------///
Route::get('/GetAllCity', [CityController::class, 'GetAllCity'])->middleware('auth:sanctum');
Route::get('/GetOneCity/{id}',[CityController::class, 'GetOneCity'])->middleware('auth:sanctum');
Route::get('/CountCity', [CityController::class, 'CountCity'])->middleware('auth:sanctum');
Route::post('/AddCity',[CityController::class, 'AddCity'])->middleware('auth:sanctum');
Route::get('/EditCity/{id}',[CityController::class, 'EditCity'])->middleware('auth:sanctum');
Route::post('/UpdateCity/{id}',[CityController::class, 'UpdateCity'])->middleware('auth:sanctum');
Route::delete('/DeleteCity/{id}',[CityController::class, 'DeleteCity'])->middleware('auth:sanctum');
//---------------./city------------------------------------------------------------------------------------------///

//----(Supplier)------------------------------------------------------------------------------------------///
Route::get('/GetAllSuppliers', [SupplierController::class, 'GetAllSuppliers'])->middleware('auth:sanctum');
Route::get('/GetOneSupplier/{id}',[SupplierController::class, 'GetOneSupplier'])->middleware('auth:sanctum');
Route::get('/CountSuppliers', [SupplierController::class, 'CountSuppliers'])->middleware('auth:sanctum');
Route::post('/AddSupplier',[SupplierController::class, 'AddSupplier'])->middleware('auth:sanctum');
Route::get('/EditSupplier/{id}',[SupplierController::class, 'EditSupplier'])->middleware('auth:sanctum');
Route::post('/UpdateSupplier/{id}',[SupplierController::class, 'UpdateSupplier'])->middleware('auth:sanctum');
Route::delete('/DeleteSupplier/{id}',[SupplierController::class, 'DeleteSupplier'])->middleware('auth:sanctum');
//----./Supplier------------------------------------------------------------------------------------------///


//-----Product------------------------------------------------------------------------------------------///
Route::get('/GetAllProduct', [ProductController::class, 'GetAllProduct'])->middleware('auth:sanctum');
Route::get('/GetOneProduct/{id}',[ProductController::class, 'GetOneProduct'])->middleware('auth:sanctum');
Route::get('/CountProduct', [ProductController::class, 'CountProduct'])->middleware('auth:sanctum');
Route::get('/ProductMaxNumber', [ProductController::class, 'ProductMaxNumber'])->middleware('auth:sanctum');
Route::post('/AddNewProduct',[ProductController::class, 'AddNewProduct'])->middleware('auth:sanctum');
Route::get('/EditProduct/{id}',[ProductController::class, 'EditProduct'])->middleware('auth:sanctum');
Route::post('/UpdateProduct/{id}',[ProductController::class, 'UpdateProduct'])->middleware('auth:sanctum');
Route::delete('/DeleteProduct/{id}',[ProductController::class, 'DeleteProduct'])->middleware('auth:sanctum');
Route::get('/GetCategoryProdact', [ProductController::class, 'GetCategoryProdact'])->middleware('auth:sanctum');
Route::get('/showAllImagesProdact/{id}', [ProductController::class, 'showAllImagesProdact'])->middleware('auth:sanctum');
Route::get('/GetProdactCategory/{id}', [ProductController::class, 'GetProdactCategory'])->middleware('auth:sanctum');


//-----.\Product------------------------------------------------------------------------------------------///

//-----Prodact images ------------------------------------------------------------------------------------------///
Route::get('/GetallProductImage', [ProductImageController::class, 'GetallProductImage'])->middleware('auth:sanctum');
Route::get('/GetOneProductImage/{id}',[ProductImageController::class, 'GetOneProductImage'])->middleware('auth:sanctum');
Route::get('/countProductImage', [ProductImageController::class, 'countProductImage'])->middleware('auth:sanctum');
Route::post('/AddProductImage',[ProductImageController::class, 'AddProductImage'])->middleware('auth:sanctum');
Route::get('/EditProductImage/{id}',[ProductImageController::class, 'EditProductImage'])->middleware('auth:sanctum');
Route::post('/UpdateProductImage/{id}',[ProductImageController::class, 'UpdateProductImage'])->middleware('auth:sanctum');
Route::delete('/DeleteProductImage/{id}',[ProductImageController::class, 'DeleteProductImage'])->middleware('auth:sanctum');
Route::get('/ShowProductImage/{id}',[ProductImageController::class, 'ShowProductImage'])->middleware('auth:sanctum');

//-----.\Prodact------------------------------------------------------------------------------------------///

//---------cmstags--------------------------------------------------------------------------
Route::get('/GetAllCmstag', [CmstagController::class, 'GetAllCmstag'])->middleware('auth:sanctum');
Route::get('/GetOneCmstag/{id}',[CmstagController::class, 'GetOneCmstag'])->middleware('auth:sanctum');
Route::get('/countCmstag', [CmstagController::class, 'countCmstag'])->middleware('auth:sanctum');
Route::post('/AddCmstag',[CmstagController::class, 'AddCmstag'])->middleware('auth:sanctum');
Route::get('/EditCmstag/{id}',[CmstagController::class, 'EditCmstag'])->middleware('auth:sanctum');
Route::post('/UpdateCmstag/{id}',[CmstagController::class, 'UpdateCmstag'])->middleware('auth:sanctum');
Route::delete('/DeleteCmstag/{id}',[CmstagController::class, 'DeleteCmstag'])->middleware('auth:sanctum');
//---------./cmstags--------------------------------------------------------------------------

//---------order--------------------------------------------------------------------------

Route::get('/GetallOrder', [OrderController::class, 'GetallOrder'])->middleware('auth:sanctum');
Route::get('/GetOneOrder/{id}',[OrderController::class, 'GetOneOrder'])->middleware('auth:sanctum');
Route::get('/CountOrder', [OrderController::class, 'CountOrder'])->middleware('auth:sanctum');
Route::delete('/DeleteOrder/{id}',[OrderController::class, 'DeleteOrder'])->middleware('auth:sanctum');





//Route::post('/AddNewOrder',[OrderController::class, 'AddNewOrder']);

//---------./order--------------------------------------------------------------------------

//---------front end api --------------------------------------------------------------------------//
Route::get('/ShowAllCatogeryFront', [FrontendController::class, 'ShowAllCatogeryFront']); // Dispaly All Catogery
Route::get('/ShowAllProdactsFront', [FrontendController::class, 'ShowAllProdactsFront']); // Dispaly All Prodacts 
Route::get('/ShowProductByCatogeryFront/{id}', [FrontendController::class, 'ShowProductByCatogeryFront']);// Display all prodact  by catogery ID 
Route::get('/ShowOneProductFront/{id}', [FrontendController::class, 'ShowOneProductFront']);// Display One prodact 

Route::get('/ShowAllProdactOfferFront', [FrontendController::class, 'ShowAllProdactOfferFront']); // Dispaly All Product Offer

Route::get('/ShowAllImagesProdactFront/{id}', [FrontendController::class, 'ShowAllImagesProdactFront']); // Dispaly All Image prodacts

Route::get('/SearchProdactsFront/{name}', [FrontendController::class, 'SearchProdactsFront']); // Search All Product Offer

Route::get('/ShowAllImagesFront', [FrontendController::class, 'ShowAllImagesFront']); // show all prodact with images 

Route::post('/AddNewOrder', [FrontendController::class, 'AddNewOrder']); // show all prodact with images 

Route::get('/ShowAllCityFront', [FrontendController::class, 'ShowAllCityFront']); // Dispaly All Prodacts 

/**Seo */
Route::get('/aboutus', [FrontendController::class, 'aboutus']);
Route::get('/home', [FrontendController::class, 'home']);
Route::get('/contact', [FrontendController::class, 'contact']);
/**Seo */
//---------./front end api --------------------------------------------------------------------------//