<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
</head>
<body>
	Silahkan login <br>
	<?php echo validation_errors(); ?>
	<?php echo form_open('user/login'); ?>
	<input type='text' name='username' placeholder='Username' /><br>
	<input type='password' name='password' placeholder='Password' /><br>
	<input type=submit value='login' /><br>
	<?php 	echo form_close(); 
			echo anchor('user/register','register');
	?>
</body>
</html>