Hello {{$email_data['first_name']}} !!
<br><br>
<b>Welcome to just Question!</b>
<br>
Please Click the below link to change your password
<br><br>
<a href="{{ url('setnewpassword/'.$email_data['email']) }}">Click Here!</a>

<br><br>
Thank you!!