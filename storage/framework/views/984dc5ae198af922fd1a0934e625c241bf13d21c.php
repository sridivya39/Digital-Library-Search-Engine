<!DOCTYPE html>
<html>
 <head>
  <title>Sign up</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin-top:3%;
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
 <body>
  <br />
  <p class="heading">Register</p>
  <div class="container box">
  <!-- <h3 align="center">Simple Login System in Laravel</h3><br /> -->  

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

   <form method="post" action="<?php echo e(url('/main/process_signup')); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="form-group">
     <!-- <label>First Name</label> -->
     <label for="firstname">First Name<strong>*</strong></label> 
     <input type="text" name="first_name" class="form-control" />
    </div>
    <div class="form-group">
     <label>Last Name*</label>
     <input type="text" name="last_name" class="form-control" />
    </div>
    <div class="form-group">
     <label>Enter Email*</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <label>Password*</label>
     <input type="password" name="password" class="form-control" data-toggle="password"/>
    </div>
    <div class="form-group">
     <label>Confirm Password*</label>
     <input type="password" name="confirm_password" class="form-control" data-toggle="password"/>
    </div>

    <div id="passwordHelpBlock" class="form-text">
    Your password must be 6-20 characters long, can contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </div>
    <br>
    <div class="form-group">
    <input type="submit" name="register" class="btn btn-primary" value="Register" style="font-weight:bold"/>
    </div>


    <p class="sign-up text-center">Already have an Account?<a href="\main"> Sign In</a></p>
    <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
   </form>
  </div>
 </body>
</html>
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/register.blade.php ENDPATH**/ ?>