d<!DOCTYPE html>
<html>
	<head>
		<title>Parade pelatihan - picnc</title>
		<link rel="stylesheet" href="<?php echo base_url()?>/asset/css/style.css">
	</head>
	<body>

		<h1 class="picnc"><a href="<?php echo site_url('user/login');?>">pi&bull;cnc</a></h1>
		
		<form class="login" action="<?php echo site_url('user/login');?>" method="POST">
			<input type="text" name="username" placeholder="Username" class="username" oninput="login()">
			<input type="password" name="password" placeholder="Password" class="password" oninput="login()">
			<input type="submit" value="Login" class="login-in">
		</form>
		
		<p class="centera"><a href="<?php echo site_url('user/register');?>" class="new-account">Buat akun baru?</a>
		</p>
			
		<script src="<?php echo base_url()?>/asset/js/dom.js"></script>
		
	</body>
</html>

