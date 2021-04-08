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
require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
use Elasticsearch\ClientBuilder;

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
        if($userInfo != null)
        {
            MailController::sendForgotPassword($userInfo->first_name,$userInfo->email,$userInfo->verification_code);
            return redirect()->back()->with('message','Please Check your email to set a new password!');
        }
            
        return redirect()->back()->with('error_message','Please enter a valid email');
    }
    
    public function setnewpassword($email)
    {
        $user=User::where(['email' => $email])->first();
        return view('pages.setnewpassword',['user' => $user]);
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
        if($user != null)
        {
            $user->is_verified=1;
            $user->save();
            return $this->index()->with('message','Your Account is verified,Please Login!');
        }
        return $this->index()->with('error','Something went wrong,invalid verfication code');
    }

    public function getclaim(Request $request)
    {
      if (DB::table('claim')->where('handle_number', $request->q)->exists()) {
        // $userInfo = Auth::user();
        $claiminfo = DB::table('claim')->where('handle_number', $request->q)->first();
        dd($claiminfo);
      }
    }

    public function summary(Request $request)
    {

        // echo $request;
        // $query_string = $request->get("id");
        // dd($request);
        // $userInfo = Auth::user();
        $query_string = $request->get("q");
        // dd($query_string);
        $claiminfo = DB::table('claim')->get();

        
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
      
          if ($query_string != "") {
              $searchParams = [
              'index' => 'projectdata',
              'body' => [
                'query' => [
                  'bool' =>[
                    'must' =>[
                      'multi_match' =>[
                      'query'=> $q,
                      'fields' => ['handle']
                        ]
                      ]
                    ]
                    ],
              'size'=>1000
              ]
            ];
        return view('pages.summary',["query_string"=>$query_string, "claiminfo"=>$claiminfo])->withquery($searchParams);
    }
  }

  public function add_data(Request $request) 
  {
  
    // $client = \Elasticsearch\ClientBuilder::create()->build();
    $client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
   
      $title                 = $request->input("title");
      $contributor_author    = $request->input('contributor_author');
      $degree_grantor        = $request->input('degree_grantor');
      $degree_name           = $request->input('degree_name');
      $contributor_department= $request->input('contributor_department');
      $image                 = $request->input('image');
      $handle = $request->input('handle');

      $params = [
        'index' => 'projectdata',
        'type' => '_doc',
        'body'  => [
               'title' => $title,
               'contributor_author' => $contributor_author,
               'degree_grantor' => $degree_grantor,
               'degree_name' => $degree_name,
               'contributor_department' => $contributor_department,
               'handle'=>$handle
        ]
      ];
      $response = $client->index($params);
      echo "<h3>We indexed these.</h3>";
      print_r($params);
      echo "<h3><Response/h3>";
      // dd($response);
      print_r($response);
      echo "<br>";
      
      // return redirect()->back()->with('message', 'Record Indexed Successfully!!!');
  }


  public function process_claim(Request $request)
    {  
      $first_name = Auth::user() -> first_name;
      $description      = $request->input("description");
      $handle_number    = $request->input('handle_num');
      $can_reproduce    = $request->input('can_reproduce');
      $source_code      = $request->input('source_code');
      $datasets         = $request->input('datasets');
      $exp_results      = $request->input('exp_results');
      $created_at = new \DateTime();
      $updated_at = new \DateTime();
      
      
      $data=array("description"=>$description,
                  "handle_number"=>$handle_number,
                  "username"=>$first_name,
                  "can_reproduce"=>$can_reproduce,
                  "source_code"=>$source_code,
                  "datasets"=>$datasets,
                  "exp_results"=>$exp_results,
                  "created_at"=>$created_at,
                  "updated_at"=>$updated_at);
      DB::table('claim')->insert($data);
      return redirect()->back()->with('message', 'Claim saved Successfully!!!');

    }
        
    public function summ(Request $request)
    {
        // echo $request;
        // $query_string = $request->get("id");
        // dd($request);
    
        $query_string = $request->get("q");
        
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
      
          if ($query_string != "") {
              $searchParams = [
              'index' => 'projectdata',
              'body' => [
                'query' => [
                  'bool' =>[
                    'must' =>[
                      'multi_match' =>[
                      'query'=> $q,
                      'fields' => ['handle']
                        ]
                      ]
                    ]
                    ],
              'size'=>1000
              ]
            ];
        return view('pages.summ',["query_string"=>$query_string])->withquery($searchParams);
    }
  }


    public function search(Request $request)
    {    
      $query_string = $request->get("q");
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
      
          if ($query_string != "") {
              $searchParams = [
              'index' => 'projectdata',
              'body' => [
                'query' => [
                  'bool' =>[
                    'must' =>[
                      'multi_match' =>[
                      'query'=> $q,
                      'fields' => ['handle','contributor_author','title','type','subject','description_abstract','degree_grantor'.
                    'contributor_department','contributor_committeemember','contributor_committeechair','publisher']
                        ]
                      ]
                    ]
                    ],
              'size'=>1000
              ]
            ];
      
            return view('pages.serp',["query_string"=>$query_string])->withquery($searchParams);
            // return view('pages.summary',["query_string"=>$query_string])->withquery($searchParams);
          }
          else{
              $title = $request->get('Title'); 
              $author = $request->get('Author'); 
              $dept= $request->get('Department'); 
              $university = $request->get('University'); 
              $degree_name = $request->get('Name of the Degree');
               
              // $array1=array($title,$author,$dept,$university,$degree_name);
              // $notnull = array();
              // for ($x=0; $x <=$array1.length; $x++) {
              //   if($array1[$x] != "" ){

              //   }
              // }
               if ($title != "" || $author != "" || $dept != "" || $university != "" || $degree_name != "")
               {
                $advParams =  [
                  'index' => 'projectdata',
                  'body' => [
                      'size' => 10,
                      'query' => [
                          'bool' => [
                              'must' => [
                                [ 'match' => [
                                  'title' => $title ?? ''
                                ]],
                                [ 'match' => [
                                  'contributor_author' => $author ?? ''
                                ]]
                              ]
                          ],
                      ],
                  ],
              ];
                // dd($advParams);
                 return view('pages.advserp',["query_string"=>$query_string])->withquery($advParams);
               }
               else
               {
                 return redirect('/');
               }
          }
          return view('pages.advancesearch');
    }
  public function loginsearch(Request $request)
{    
      $query_string = $request->get("q");
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
       
          if ($query_string != "") {
              $searchParams = [
              'index' => 'projectdata',
              'body' => [
                'query' => [
                  'bool' =>[
                    'must' =>[
                      'multi_match' =>[
                      'query'=> $q,
                      'fields' => ['handle','contributor_author','title','type','subject','description_abstract','degree_grantor'.
                    'contributor_department','contributor_committeemember','contributor_committeechair','publisher']
                        ]
                      ]
                    ]
                    ],
              'size'=>1000
              ]
            ];
      
            return view('pages.loginserp',["query_string"=>$query_string])->withquery($searchParams);
            
          }
          else{
              $title = $request->get('Title'); 
              $author = $request->get('Author'); 
              $dept= $request->get('Department'); 
              $university = $request->get('University'); 
              $degree_name = $request->get('Name of the Degree');
            
               if ($title != "" || $author != "" || $dept != "" || $university != "" || $degree_name != "")
               {
                $advParams =  [
                  'index' => 'projectdata',
                  'body' => [
                    'query' => [
                      'bool' =>[
                        'must' =>[
                          'match' =>[
                          'title'=> $title ?? '',
                        ],
                        'match' =>[
                          'contributor_author'=> $author ?? '',
                        ],
                          ]
                        ]
                      ],
                  'size'=>50
                  ]
                ];
                 return view('pages.advserp',["query_string"=>$query_string])->withquery($advParams);
               }
               else
               {
                 return redirect('/');
               }
          }
          return view('pages.advancesearch');
    }
}



?>