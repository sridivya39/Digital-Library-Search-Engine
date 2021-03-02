<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;
use Auth;

class MainController extends Controller
{
    function index()
    {
        return view('pages.login');
    }
    
    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );
     if(Auth::attempt($user_data))
     {
      return redirect('main/successlogin');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

    function successlogin()
    {
     return view('pages.successlogin');
    }

    public function process_signup(Request $request)
    {   
        
        $request->validate([
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email',
            'password'         => 'min:6|required_with:confirm_password',
            'confirm_password' => 'min:6|same:confirm_password'
        ]);
        $user = User::create([
            'first_name'   => $request->input('first_name'),
            'last_name'    => $request->input('last_name'),
            'email'        => $request->input('email'),
            'password'     => Hash::make($request->input('password'))
        ]);
        return redirect()->back()->with('message', 'You are successfully Registered!');
    }

    public function process_update(Request $request)
    {   
        
        $request->validate([
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email',
            'password'         => 'min:6|required_with:confirm_password',
            'confirm_password' => 'min:6|same:confirm_password'
        ]);
        $user = User::create([
            'first_name'   => $request->input('first_name'),
            'last_name'    => $request->input('last_name'),
            'email'        => $request->input('email'),
            'password'     => Hash::make($request->input('password'))
        ]);
        return redirect()->back()->with('message', 'You have updated your information succesfully!');
    }
    function logout()
    {
     Auth::logout();
     return redirect('/main');
    }
}

?>