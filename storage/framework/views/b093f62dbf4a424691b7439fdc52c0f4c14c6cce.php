<!DOCTYPE html>
<html>
 <head>
  <!--<title>Simple Login System in Laravel</title>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
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
        color: #82375d;
        background-color: #e8e6e6;
        border-color: #999;
        font-weight: bold;
    }
    .btn-link {
        /* font-weight: 400; */
        color: #e7f0fe;
        /* border-radius: 0; */
    }
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #dddddd;
  }
  li {
    float: left;
  }

  li a {
    color: #82375d;
    display: block;
    padding: 8px;
  }
    a {
    color: #fcf8e3;
    text-decoration: none;
    }
    .heading{
    font-family: 'Akaya Telivigala', cursive;
    font-size:100px;
    text-align:center;
    }
  </style>
 </head>
 <ul>
 <li><a href="<?php echo e(url('/index')); ?>"><b>HOME</b></a></li>
</ul>

 <body>
  <br />
  <p class="heading">Login</p>
  <div class="container box">
  <?php if(session()->has('message')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('message')); ?>

    </div>
 <?php endif; ?>
    <?php if($message ?? ''): ?>
        <div class="alert alert-danger">
            <?php echo e($message); ?>

        </div>
    <?php endif; ?>
  <?php if(session()->has('message')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('message')); ?>

    </div>
  <?php endif; ?>
   <?php if(isset(Auth::user()->email)): ?>
    <script>window.location="/main/successlogin";</script>
   <?php endif; ?>

   <?php if($message = Session::get('error')): ?>
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><?php echo e($message); ?></strong>
   </div>
   <?php endif; ?>

   <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
     <ul>
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </ul>
    </div>
   <?php endif; ?>

   <form method="post" action="<?php echo e(url('/main/checklogin')); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="form-group">
     <label>Enter Email</label>
     <input type="email" name="email" class="form-control" />
    </div>

    <div class="form-group">
     <label>Enter Password</label>
     <input type="password" name="password" class="form-control" data-toggle="password" />
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
            <!-- <a class="btn btn-link" href="http://localhost:8000/password/reset"> -->
            <a class="btn btn-link" href=/forgotpassword>
                <b>Forgot Your Password?</b>
            </a>
        </div>
    </div>
    <p class="Sign-up">Don't have an Account?<a href=/Signup> Sign Up</a></p>
    <script type="text/javascript">
	$("#password").password('toggle');
    </script>
    <!-- <div class="container">
        <div class="row">
            <div class="col-sm">
                <p><b>Forgot password?</b></p>
            </div>
            <div class="col-sm">
                <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="Login" />
                </div>
            </div>
        </div>
    </div> -->
   </form>
  </div>
 </body>
</html>
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/login.blade.php ENDPATH**/ ?>