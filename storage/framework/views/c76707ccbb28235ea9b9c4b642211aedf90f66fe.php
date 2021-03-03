<!DOCTYPE html>
<html>
 <head>
  <title>Simple Login System in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <!-- <link rel="stylesheet" href="css/custom-style.css" /> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin-top:10%;
    border:1px solid #ccc;
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
    background-image:url(<?php echo e(url("images/1.jpg")); ?>);
    /* background-color: #82375d; */
   }

   ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #dddddd;
}

  li {
  float: right;
}

  li a {
  color: #82375d;
  display: block;
  padding: 8px;
}
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <!--<h3 align="center">Simple Login System in Laravel</h3><br />-->
<ul>
  <li><a href="<?php echo e(url('/main/logout')); ?>"><b>Logout</b></a></li>
  <li><a href="/update"><b>Update Profile</b></a></li>
</ul>
   <?php if(isset(Auth::user()->email)): ?>
    <div class="alert alert-danger success-block">
     <strong>Welcome <?php echo e(Auth::user()->email); ?></strong>
     <br />
     
    </div>
   <?php else: ?>
    <script>window.location = "/main";</script>
   <?php endif; ?>
   
   <br />
  </div>
 </body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/successlogin.blade.php ENDPATH**/ ?>