<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
</head>
<body>
	@section('content')
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport"><br>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
	</script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
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
	<p class="heading">Search by Filters</p>
	<div class="container box">
		<form action="{{URL::to('/search')}}" method="post" role="search">
			{{ csrf_field() }}
			<div class="form-group">
				<label>Title</label> <input class="form-control" name="Title" type="text">
			</div><br>
			<div class="form-group">
				<label>Author</label> <input class="form-control" name="Author" type="text">
			</div><br>
			<div class="form-group">
				<label>University</label> <input class="form-control" name="University" type="text">
			</div><br>
			<div class="form-group">
				<label>Name of the Degree</label> <input class="form-control" name="Name of the Degree" type="text">
			</div><br>
			<div class="form-group">
				<label>Department</label> <input class="form-control" name="Department" type="text">
			</div><input class="btn btn-primary" name="Submit" style="font-weight:bold" type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
