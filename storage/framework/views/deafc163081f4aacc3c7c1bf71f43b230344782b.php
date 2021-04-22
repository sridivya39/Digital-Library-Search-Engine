<!DOCTYPE html>
<html>
 <head>
  <!--<title>Simple Login System in Laravel</title>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
.heading{
  font-family: 'Akaya Telivigala', cursive;
  font-size:100px;
  text-align:center;
  margin-bottom: 10%;
}

body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #d9edf7;
    background-color: #82375d;
   }
.btn-link {
    color: #82375d;
    background-color: #e8e6e6;
    border-color: #999;
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
   </style>
   </head>
   
 <ul>
<li><a href="<?php echo e(url('/fav')); ?>"><b>Favourite List</b></a></li>
<li><a href="<?php echo e(url('/main/successlogin')); ?>"><b>HOME</b></a></li>
</ul>



<div class="container">
 <p class="heading"><?php echo e($heading); ?></p>
 <?php if($message ?? ''): ?>
    <div class="alert alert-success">
     <?php echo e($message ?? ''); ?>

    </div>

  <?php endif; ?>

 <?php if($error ?? ''): ?>
    <div class="alert alert-danger">
     <?php echo e($error ?? ''); ?>

    </div>
  <?php endif; ?>
  </div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/error.blade.php ENDPATH**/ ?>