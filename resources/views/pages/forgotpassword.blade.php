<html>
 <head>
  <!--<title>Simple Login System in Laravel</title>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  .box{
    width:600px;
    margin-top:5%;
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
        border-color: #2e6da4;
        font-weight: bold;
    }
    .btn-link {
        /* font-weight: 400; */
        color: #e7f0fe;
        /* border-radius: 0; */
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
  <p class="heading">Forgot Password?</p>
  <div class="container box">

@if(session()->has('message'))
    <div class="alert alert-danger alert-block">
        {{ session()->get('message') }}
    </div>
 @endif

    <form method="post" action="{{ url('/main/forgot_password') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Enter email</label>
     <input type="text" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="Reset Password" class="btn btn-primary" value="Reset Password" style="font-weight:bold"/>
    </div>
   
    </div>

    </body></html>

 