<!DOCTYPE html>
<html>
 <head>
  <title>Search</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
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
  <p class="heading">Search by Filters</p>
  <div class="container box">
  <!-- <h3 align="center">Simple Login System in Laravel</h3><br /> -->  
  <!-- <form method="post" action="<?php echo e(url('/main/process_signup')); ?>">
    <?php echo e(csrf_field()); ?> -->
    <form action="/search" method="POST" role="search">
    <div class="form-group">
     <label>Keywords</label>
     <input type="text" name="keywords" class="form-control" />
    </div>
    <div class="form-group">
     <label>Author Name</label>
     <input type="text" name="Author Name" class="form-control" />
    </div>
    <div class="form-group">
     <label>Title</label>
     <input type="text" name="Title" class="form-control" />
    </div>
    <br>
    <div class="form-group">
    <input type="text" class="form-control" name="q"
    placeholder="Search"> <span class="input-group-btn">
    </div>
    <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" />
    </div>
    </form>
  </div>
 </body>
</html>
 <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/advancesearch.blade.php ENDPATH**/ ?>