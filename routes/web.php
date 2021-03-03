<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return "<h1>Hello world</h1>";
// });
// Route::get('/about', function () {
//     return view('pages.about');
// });
// Route::get('/users/{id}',function($id)
// {
//     return "This is user " .$id;
// });
//Route::get('/', 'PagesController@index');
//Route::get('/uploadfile','UploadfileController@index'); 
//Route::get('/uploadfile','UploadfileController@upload'); 
Route::get('/main', [
    'as' => 'MainController', 
    'uses' => 'MainController@index'
    ]);

Route::get('/update', function () {
        $userInfo = Auth::user();
        return view('pages.update',['userInfo' => $userInfo]);
   });
Route::post('/main/process_update','MainController@process_update');

Route::get('/register', function () {
         return view('pages.register');
    });
Route::post('/main/process_signup','MainController@process_signup');

Route::get('/search', function () {
        return view('pages.search');
   });

Route::get('/forgotpassword', function () {
    return view('pages.forgotpassword');
})->middleware('guest')->name('password.request');

Route::post('/forgotpassword', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    print ($status);

    // return $status === Password::RESET_LINK_SENT
    //             ? back()->with(['status' => __($status)])
    //             : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');;

Route::post('/main/checklogin','MainController@checklogin');
Route::get('main/successlogin', 'MainController@successlogin');
Route::get('main/logout', 'MainController@logout');
//Route::get('main/confirm', 'MainController@confirm');
//Route::get('/', [PagesController::class, 'index']);
    
