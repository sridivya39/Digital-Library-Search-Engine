<!DOCTYPE html>
<html>
 <head>
  <title>Reset password</title>
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
    a {
    color: #f5f5f5;
    text-decoration: none;
}
  </style>
 </head>
 <body>
  <br />
  <p class="heading">Set Password</p>
  <div class="container box">
  <?php if(session()->has('message')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('message')); ?>

    </div>
  <?php endif; ?>

  <?php if($message ?? ''): ?>
    <div class="alert alert-success">
     <?php echo e($message ?? ''); ?>

    </div>
  <?php endif; ?>
   <?php if($message = Session::get('error')): ?>
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><?php echo e($message); ?></strong>
   </div>
   <?php endif; ?>

  <form action="<?php echo e(url('/main/set_password')); ?>" method="post">
   <?php echo csrf_field(); ?>
    <input type="hidden" name="id" value="<?php echo e($user->id); ?>" />
    <div class="form-group">
     <label>New Password</label>
     <input type="password" name="new_password" class="form-control" />
    </div>
    <div id="passwordHelpBlock" class="form-text">
    <div class="form-group">
     <label>Confirm Password</label>
     <input type="password" name="confirm_password" class="form-control" />
    </div>
    <div id="passwordHelpBlock" class="form-text">
    Your password must be 6-20 characters long, can contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </div>
    <br>
    <div class="form-group">
     <input type="submit" name="update" class="btn btn-primary" value="SET PASSWORD" style="font-weight:bold"/>
    </div>
    <p class="sign-up text-center"><a href="\main"><b>Login</b></a></p>
   </form>
  </div>
 </body>
</html>
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/setnewpassword.blade.php ENDPATH**/ ?>