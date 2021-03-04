<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
      'password'  => 'required|alphaNum|min:6'
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
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();
            return redirect()->back()->with('error', 'This user already exists!');
        }
        
        $request->validate([
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email',
            'password'         => 'min:6|alphaNum|required_with:confirm_password',
            'confirm_password' => 'min:6|same:password'
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
            'first_name'           => 'required',
            'last_name'            => 'required',
            'email'                => 'required|email',
            'new_password'         => 'min:6|alphaNum|required_with:confirm_password',
            'confirm_password'     => 'min:6|same:new_password'
        ]);
        $userInfo=User::find($request->id);
        $userInfo->first_name=$request->first_name;
        $userInfo->last_name=$request->last_name;
        $userInfo->email=$request->email;
        $userInfo->password=Hash::make($request->input('new_password'));
        $userInfo->save();
        return redirect()->back()->with('message', 'You have updated your information succesfully!');
    }

    public function setnewpassword($userInfo,$message){
        return view('pages.setnewpassword',['userInfo' => $userInfo, 'message' => $message]);
    }

    public function forgot_password(Request $request)
    {   
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();
            return $this->setnewpassword($userInfo,"User exists");
        }
        else{
            return redirect()->back()->with('message','Please enter a valid email');
        }
    }
    
    public function set_password(Request $request)
    {   
        $request->validate([
         'new_password'         => 'required|min:6|alphaNum|required_with:confirm_password',
         'confirm_password'     => 'required|min:6|same:new_password'
          ]);
        $userInfo=User::find($request->id);
        $userInfo->password=Hash::make($request->input('new_password'));
        $userInfo->save();
        return $this->setnewpassword($userInfo,"You have changed your password successfully!");
        // return redirect('main/successlogin')->with('message','You have changed your password successfully!');
    }

    function logout()
    {
     Auth::logout();
     return redirect('/main');
    }
}

?>