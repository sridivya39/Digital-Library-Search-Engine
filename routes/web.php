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
Route::get('/about', function () {
    return view('pages.about');
});
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

Route::get('/main/verify', 'MainController@verify_user')->name('verify.user');

Route::get('/register', function () {
         return view('pages.register');
    });

Route::get('/adv_search', function () {
    return view('pages.login')->with('message','You need an account to access Advance Search!');
});
Route::post('/main/process_advsearch','MainController@process_advsearch');
Route::post('/main/process_signup','MainController@process_signup');

Route::get('/index', function () {
        return view('pages.index');
   });

Route::get('/setnewpassword/{email}', 'MainController@setnewpassword');

Route::post('/main/set_password', 'MainController@set_password');

Route::get('/forgotpassword', function () {
    return view('pages.forgotpassword');
});
Route::post('/main/forgot_password','MainController@forgot_password');
Route::post('/main/checklogin','MainController@checklogin');
Route::get('main/successlogin', 'MainController@successlogin');
Route::get('main/logout', 'MainController@logout');
Route::get('/data', function () {return view('projectdata');});
});
?>