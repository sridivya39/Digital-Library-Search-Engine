<!DOCTYPE html>
<html>
 <head>
  <title>Sign up</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    .heading{
    font-family: 'Akaya Telivigala', cursive;
    font-size:100px;
    text-align:center;
    }
    a {
    color: #f5f5f5;
    text-decoration: none;
}
  </style>
 </head>
 <body>
  <br />
  <p class="heading">Update Profile</p>
  <div class="container box">
  <?php if(session()->has('message')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('message')); ?>

    </div>
  <?php endif; ?>
   <!-- <?php if(isset(Auth::user()->email)): ?>
    <script>window.location="/main/successlogin";</script>
   <?php endif; ?> -->

   <?php if($message = Session::get('error')): ?>
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><?php echo e($message); ?></strong>
   </div>
   <?php endif; ?>

   <!-- <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
     <ul>
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </ul>
    </div>
   <?php endif; ?> -->
  <!-- <h3 align="center">Simple Login System in Laravel</h3><br /> -->  
  <form action="/main/process_update" method="post">
   <?php echo csrf_field(); ?>
   <input type="hidden" name="id" value="<?php echo e($userInfo['id']); ?>" />
    <div class="form-group">
     <label>First Name</label>
     <input type="text" name="first_name" class="form-control" value=<?php echo e($userInfo->first_name); ?> />
    </div>
    <div class="form-group">
     <label>Last Name</label>
     <input type="text" name="last_name" class="form-control" value=<?php echo e($userInfo->last_name); ?> />
    </div>
    <div class="form-group">
     <label>Enter Email</label>
     <input type="email" name="email" class="form-control" value=<?php echo e($userInfo->email); ?> />
    </div>
    <div class="form-group">
     <label>Enter Old Password*</label>
     <input type="password" name="password" class="form-control" data-toggle="password"  />
    </div>
    <div class="form-group">
     <label>Change Password</label>
     <input type="password" name="new_password" class="form-control" data-toggle="password" aria-describedby="passwordHelpBlock"/>
    </div>
    <div class="form-group">
     <label>Confirm Password</label>
     <input type="password" name="confirm_password" class="form-control" data-toggle="password" />
    </div>
    <div id="passwordHelpBlock" class="form-text">
    Your password must be 6-20 characters long, can contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </div>
    <br>
    <div class="form-group">
     <input type="submit" name="update" class="btn btn-primary" value="UPDATE INFO" style="font-weight:bold"/>
     <p class="sign-up text-center"><a href="\main\successlogin"><b>Go to dashboard</b></a></p>
    </div>
   </form>
  </div>
 </body>
</html>
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/update.blade.php ENDPATH**/ ?>