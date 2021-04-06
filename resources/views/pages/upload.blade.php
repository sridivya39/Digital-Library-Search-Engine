<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
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
  <p class="heading">Add New Data </p>
  <div class="container box">
    @if($message ?? '')
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
  <form action="/add" method="GET" role="add">
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
    <div class="form-box">   
    <br>     
    <input type ="file" name="image"/>
     <br>
    <input type = "submit"name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" />
   </form>
    </div>
</body>


 
<!-- // if(isset($_FILES['image'])){
    // echo "i am here";
    // $errors= array();
    // $file_name =$_FILES['image']['name'];
    // $file_size = $FILES['image']['size'];
    // $file_tmp = $FILES['image']['tmp_name'];
    // $file_type = $FILES['image']['type'];
    // $file_ext = strtolower(end(explode('.',$FILES['image']['name'])));

    // $extensions = array("jpeg", "jpg", "png");
    // echo $file_name;

    // if(in_array($file_ext, $extensions) === false) {
    //     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    // }
    // if($file_size > 2097152){
    //     $errors[]="File size must be exactely 2MB";
    // }
    // if(empty($errors)==true){
    //     move_uploaded_file($file_tmp, "images/".$file_name);
    //     echo "Success";
    // }else{
    //     print_r($errors);
    // }
//} -->



