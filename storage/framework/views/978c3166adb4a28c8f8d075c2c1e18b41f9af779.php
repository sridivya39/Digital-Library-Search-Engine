Hello <?php echo e($email_data['first_name']); ?> !!
<br><br>
<b>Welcome to just Question!</b>
<br>
Please Click the below link to change your password
<br><br>
<a href="<?php echo e(url('setnewpassword/'.$email_data['email'])); ?>">Click Here!</a>

<br><br>
Thank you!!<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/mail/forgotpassword.blade.php ENDPATH**/ ?>