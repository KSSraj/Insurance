<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Controllers\UserDocumentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('admin/user', UserController::class)->middleware('auth:sanctum');

Route::post('login', [LoginController::class, 'loginUser']);

Route::resource('candidate', CandidateController::class);
Route::resource('insurer', InsurerController::class);
Route::resource('institute', InstituteController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::resource('user-profile', UserProfileController::class);
    Route::resource('user-address', UserAddressController::class);
    Route::resource('user-experience', UserExperienceController::class);
    Route::resource('user-documents', UserDocumentsController::class);

    Route::post('image-upload', [UserProfileController::class, 'profileImageUpload']);

    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('refresh-token', [LoginController::class, 'refreshAuthToken']);

    Route::group(['middleware' => 'auth:sanctum'],function(){
        Route::get('admin/users/trash',[UserController::class,'trashed_users']);
        Route::patch('admin/user/restore/{id}',[UserController::class,'restore_user']);
        // Route::delete('admin/user/delete/{id}',[UserController::class,'hard_delete']);
    });
});
