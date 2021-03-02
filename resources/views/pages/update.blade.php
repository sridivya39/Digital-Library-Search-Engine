<!DOCTYPE html>
<html>
 <head>
  <title>Sign up</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin-top:10%;
    /* border:1px solid #ccc; */
   }
   body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #d9edf7;
    background-color: #82375d;
}
.btn-primary {
    color: #333;
    background-color: #d9edf7;
    border-color: #d9edf7;
    }
    .heading{
    font-family: 'Akaya Telivigala', cursive;
    font-size:100px;
    text-align:center;
    }
  </style>
 </head>
 <body>
  <br />
  <p class="heading">Update Profile</p>
  <div class="container box">
  <!-- @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
   @if(isset(Auth::user()->email))
    <script>window.location="/main/successlogin";</script>
   @endif

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif -->
  <!-- <h3 align="center">Simple Login System in Laravel</h3><br /> -->  
  <form method="post" action="{{ url('/main/process_update') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>First Name</label>
     <input type="text" name="First Name" class="form-control" />
    </div>
    <div class="form-group">
     <label>Last Name</label>
     <input type="text" name="Last Name" class="form-control" />
    </div>
    <div class="form-group">
     <label>Enter Email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <label>Enter Password</label>
     <input type="password" name="New Password" class="form-control" />
    </div>
    <div class="form-group">
     <label>Confirm Password</label>
     <input type="password" name=" Confirm Password" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="update" class="btn btn-primary" value="UPDATE INFO" style="font-weight:bold"/>
    </div>
   </form>
  </div>
 </body>
</html>
 