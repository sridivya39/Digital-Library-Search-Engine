<!DOCTYPE html>
<html>
 <head>
  <title>Simple Login System in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <!-- <link rel="stylesheet" href="css/custom-style.css" /> -->
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:60%;
    height:40%;
    margin-top:5%;
    background-color: white;
    /* border:1px solid #ccc; */
   }

  .heading{
    font-family: 'Akaya Telivigala', cursive;
    font-size:90px;
    text-align:center;
    color: #82375d;
  }

  .container{
    padding: 0px !important;
  }

   .alert {
    padding: 15px;
    margin-top: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
   body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #d9edf7;
    /* background-image:url({{url("images/1.jpg")}}); */
    background-color: #82375d; 
   }

   ul {
  list-style-type: none;
  /* margin: 0; */
  overflow: hidden;
  background-color: #f2dede;
}

  li {
  float: right;
}
.caption{
  color: #82375d;
  text-align:center;
  font-size:20px;
}
  li a {
  color: #82375d;
  display: block;
  padding: 8px;
}
.btn-primary {
    color: #fff;
    background-color:  #82375d;
    border-color:#82375d;
}
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
<ul>
  <li><a href="{{ url('/main/logout') }}"><b>Logout</b></a></li>
  <li><a href="/update"><b>Update Profile</b></a></li>
</ul>
<p class="heading">Just Question</p>
<p class="caption"><strong>A place to share knowledge and better understand the world</strong></p>
<br><br>
   @if(isset(Auth::user()->email))
    <div style="text-align:center;" class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->first_name }}!!</strong>
     <br />
    </div>
   @else
    <script>window.location = "/main";</script>
   @endif
   <form action="/main/process_advsearch" method="post">
   <!-- <form action="/search" method="POST" role="search"> -->
    {{ csrf_field() }}
    <div class="input-group" style="margin:20px;">
        <input type="text" class="form-control" name="q"
            placeholder="Search"> <span class="input-group-btn">
            <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" />
                     </div>
                     <div class="form-group" style="margin-left:20px;">
                        <input type="submit" name="Submit" class="btn btn-primary" value="Advance Search" style="font-weight:bold" />
                     </div> 
    </form>
   <br />
  </div>
 </body>
</html>
