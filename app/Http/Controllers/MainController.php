<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;
use Auth;
use Mail;

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
      'password'=> 'required|alphaNum|min:6'
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
            'password'     => Hash::make($request->input('password')),
            'verification_code'=>sha1(time())
           
        ]);
        // return redirect()->back()->with('message', 'You are successfully Registered!');
        if($user != null)
        {
            MailController::sendSignupEmail($user->first_name,$user->email,$user->verification_code);
            return redirect()->back()->with('message','Your Account has been created,Please Check your email for verification link');
        }
            return redirect()->back()->with('message','Something went wrong!');
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
    
    public function forgot_password(Request $request)
    {     
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();

      
    }
        // dd($request->all());
        if($userInfo != null)
        {
            MailController::sendForgotPassword($userInfo->first_name,$userInfo->email,$userInfo->verification_code);
            return redirect()->back()->with('message','Please Check your email to set a new password!');
        }
            
        return redirect()->back()->with('error_message','Please enter a valid email');
    }
        
    //     if (DB::table('users')->where('email', $request->email)->exists()) {
    //         $userInfo = Auth::user();
    //         $userInfo = DB::table('users')->where('email', $request->email)->first();
    //         return $this->setnewpassword($userInfo,"Set a new password");
    //     }
    //     else{
    //         return redirect()->back()->with('message','Please enter a valid email');
    //     }
    // }
    
    public function setnewpassword($userInfo,$message){
        return view('pages.setnewpassword',['userInfo' => $userInfo, 'message' => $message]);
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
          return redirect()->back()->with('message',"You have changed your password successfully!");

        // return redirect('main/successlogin')->with('message','You have changed your password successfully!');
    }

    public function process_advsearch(Request $request)
    {
        return view('pages.advancesearch');
    }

    function logout()
    {
     Auth::logout();
     return redirect('/main');
    }

    public function verify_user(Request $request)
    {   
        $verification_code=\Illuminate\Support\Facades\Request::get('code');
        $user=User::where(['verification_code'=> $verification_code])->first();
        // var_dump($user);
        if($user != null)
        {
            $user->is_verified=1;
            $user->save();
            return $this->index()->with('message','Your Account is verified,Please Login!');
        }
        return $this->index()->with('error','Something went wrong,invalid verfication code');
    }
}

?>