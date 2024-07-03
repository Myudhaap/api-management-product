<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("/auth")->controller(\App\Http\Controllers\AuthController::class)->group(function (){
   Route::post("/login", "login")->name("login");
   Route::post("/register", "register");
   Route::post("/logout", "logout")->middleware("jwt");
});

Route::middleware('jwt')->group(function(){

   Route::prefix("/category-products")
       ->controller(\App\Http\Controllers\CategoryProductController::class)
       ->group(function(){
       Route::get("", "getAll");
       Route::post("", "create");
       Route::get("/{id}", "getById");
       Route::put("/{id}", "update");
       Route::delete("/{id}", "delete");
   });

   Route::prefix("/products")
       ->controller(\App\Http\Controllers\ProductController::class)
       ->group(function(){
       Route::get("", "getAll");
       Route::post("", "create");
       Route::get("/{id}", "getById");
       Route::put("/{id}", "update");
       Route::delete("/{id}", "delete");
   });


});
