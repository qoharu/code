<!DOCTYPE html>
<html>
	<head>
		<title>Parade pelatihan - picnc</title>
		<link rel="stylesheet" href="<?php echo base_url()?>/asset/css/style.css">
	</head>
	<body>

		<h1 class="picnc"><a href="index.html">pi&bull;cnc</a></h1>
		<?php echo validation_errors(); ?>
		<form class="login" action="<?php echo site_url('user/register');?>" method="POST">
			<input type="text" name="fullname" placeholder="Fullname" class="fullname" oninput="signUp">
			<input type="text" name="username" placeholder="Username" class="username" oninput="signUp()">
			<input type="text" name="email" placeholder="Email" class="email" oninput="signUp()">
			<input type="password" name="password" placeholder="Password" class="password pass-private-one" oninput="signUp()">
			<input type="password" name="passconf" placeholder="Konfirmasi Password" class="password pass-private-two" oninput="signUp()">
			<input type="submit" value="Sign Up" class="login-in">
		</form>
		
		<p class="centera"><a href="<?php echo site_url('user/login');?>" class="new-account">Login di sini</a>
		</p>
		
		<script src="<?php echo base_url()?>/asset/js/dom.js"></script>
		
	</body>
</html>
