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
// Route::get('/users/{id}',function($id)
// {
//     return "This is user " .$id;
// });
//Route::get('/', 'PagesController@index');
//Route::get('/uploadfile','UploadfileController@index'); 
//Route::get('/uploadfile','UploadfileController@upload'); 
Route::get('/about', function () {
  return view('pages.about');
});

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

Route::get('/Signup', function () {
         return view('pages.register');
    });

Route::get('/uploadfile', function () {
      return view('pages.upload');
    });

Route::post('/add_data', 'MainController@add_data');

Route::get('/adv_search', function () {
    return view('pages.login')->with('message','You need an account to access Advance Search!');
});

Route::get('/add_claim', function () {
  return view('pages.login')->with('message','You need an account to add claim!');
});

Route::post('/process_advsearch','MainController@process_advsearch');

Route::post('/main/process_signup','MainController@process_signup');

Route::post('/main/process_claim','MainController@process_claim');

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
Route::get('/fav', 'MainController@fav');

Route::post('/search', 'MainController@search');
Route::get('/delete/{handle_number}', 'MainController@delete');
Route::get('/deleteAll', 'MainController@deleteAll');
Route::post('/loginsearch', 'MainController@loginsearch');
Route::get('/download', 'MainController@download');
Route::post('/voteUpAndDown', 'MainController@voteUpAndDown');
Route::get('/summ', 'MainController@summ');
Route::get('/summary', 'MainController@summary');
Route::get('/getclaim', 'MainController@getclaim');
Route::get('/addfav', 'MainController@addfav');
Auth::routes();
?>