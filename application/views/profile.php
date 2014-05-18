<!DOCTYPE html>
<html>
	<head>
		<title>Home - picnc</title>
		<link rel="stylesheet" href="<?php echo base_url();?>/asset/css/style.css">
	</head>
	<body>
		
		<header>
			<a title="Index" class="picnc-home" href="<?php echo site_url('home') ?>">pi&bull;cnc</a>
			<div class="container-user">Welcome, <?php echo $this->session->userdata('username') ?> <a class="logout" href='<?php echo site_url('user/logout'); ?>'>Logout</a></div>
		</header>
		
		<article>
			<?php
			    foreach ($gambar as $foto) {
			    	echo "<form class='comments' action='".base_url('photo/caption')."/".$foto->id."' method=POST >";
			    	$path = base_url('uploads/').'/'.$foto->path;
			    	echo "<img class='al-post-image' src='$path' size='333px'>";
			    	$data = $this->semua->getCaption($foto->id);

			    	foreach ($data as $nilai) {
			    		$username = $this->semua->getUserById($nilai->user_id);
			    		foreach ($username as $value) {
			    			$nama = $value->username;
			    		}

			    		echo "<br>"; echo "<a href='".site_url("user/profile/$nama")."' > ".$nama."</a> ";
			    		echo $nilai->testimony;
			    		echo "<br>";
			    	}

			    	
			    	echo "
						
						<div class='comment-comment'>
							<input type='text' name='caption' placeholder='Comment this' class='comment'>
							<input type='submit' value='Comment' class='input-comment'>
						</div><br>

			    	";
			    	echo "</form>";
			    }

			?>			
				
				
			</div>
				
		</article>
		

		
	<script src="<?php echo base_url();?>/asset/js/dom.js"></script>
	</body>
</html>
