<html>
 <head>
  <!--<title>Simple Login System in Laravel</title>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  .box{
    width:600px;
    margin-top:20%;
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
        border-color: #2e6da4;
        font-weight: bold;
    }
    .btn-link {
        /* font-weight: 400; */
        color: #e7f0fe;
        /* border-radius: 0; */
    }
  </style>
 </head>
           <div class="container box">
                <div class="card-header"><b>Reset Password</b></div>

                <div class="card-body">
                    
                    <form method="POST" action="forgotpassword">
                        <input type="hidden" name="_token" value="rPqKepMFkS17C51jW9wn8qjYWhDVpmyTCrP5Ry3d">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="" required="" autocomplete="email" autofocus="">

                                                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <b>Send Password Reset Link</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </main>
    </div>


</body></html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/forgotpassword.blade.php ENDPATH**/ ?>