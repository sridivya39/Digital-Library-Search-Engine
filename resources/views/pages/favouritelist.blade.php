@section('content')
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
   .box{
    width:600px;
    margin-top:10%;
    border:1px solid #ccc;
   }
   body{
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
.heading{
  font-family: 'Akaya Telivigala', cursive;
  font-size:100px;
  text-align:center;
}
  </style>
 </head>
 <p class="heading">Favourites</p>
<div class="container">
</div>
<?php
$title= (isset($source['_source']['title'])? $source['_source']['title'] : "");
$URL = (isset($source['_source']['identifier_uri']) ? $source['_source']['identifier_uri'] : ""); 
$abs = (isset($source['_source']['description_abstract']) ? $source['_source']['description_abstract'] : ""); 
echo '
<table class="table table-stripped" id="dt1">
<thead>
<th>Title</th>
<th>Author</th>
<th>University</th>
<th>Publisher</th>
<th>Option</th>
</thead>
';
foreach( $users ?? '' as $source){
    echo "<tr>
    <td><a role='button' class='btn btn-link' href='".$source->identifier_uri."' target='_blank'>".$source->title."</a></br>".$source->description_abstract."</td>
    <td>".$source->author."</td>
    <td>".$source->degree_grantor."</td>
    <td>".$source->publisher."</td>
    <td><a href = 'delete/{{ $source->id }}'>Delete</a></td>
    </tr>";
}
echo "</table>";
?>
@endsection
