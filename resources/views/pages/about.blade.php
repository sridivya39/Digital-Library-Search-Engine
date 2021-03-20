<!-- <h1>about</h1> -->
<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap Hide Show Password</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
</head>
<body>


<div class="container">
	<form>
		<div class="form-group">
			<label>Username:</label>
			<input type="text" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input type="password" id="password" name="password" class="form-control" data-toggle="password">
		</div>
		<div class="form-group">
			<button class="btn btn-success">Submit</button>
		</div>
	</form>
</div>


<script type="text/javascript">
	$("#password").password('toggle');
</script>


</body>
</html>