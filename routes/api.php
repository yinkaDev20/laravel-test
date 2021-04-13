<?php
 use App\Http\Controllers\UserApi;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get("users",UserApi::class."@index");
Route::post("store",UserApi::class."@store");
Route::post("show",UserApi::class."@show");
Route::post("update",UserApi::class."@update");
Route::post("destroy",UserApi::class."@destroy");