@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
  <title>Search</title>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <br>

      
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin-top:3%;
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
   <p class="heading">Search by Filters</p>
   <div class="container box">
   <form action="{{URL::to('/search')}}" method="post" role="search">
      {{ csrf_field() }}
      <div class="form-group">
     <label>Title</label>
     <input type="text" name="Title" class="form-control" />
     </div>
     <br>
     <div class="form-group">
     <label>Author</label>
     <input type="text" name="Author" class="form-control" />
     </div>
     <br>
      <div class="form-group">
     <label>University</label>
     <input type="text" name="University" class="form-control" />
     </div>
     <br>
     <div class="form-group">
     <label>Name of the Degree</label>
     <input type="text" name="Name of the Degree" class="form-control" />
     </div>
      <br>
      <div class="form-group">
     <label>Department</label>
     <input type="text" name="Department" class="form-control" />
     </div> 
    <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" />
    </div>
   </form>
   </div>
</body>
</html>
 