<!DOCTYPE html>
<html>
	<head>
		<title>Upload photos - picnc</title>
		<link rel="stylesheet" href="<?php echo base_url()?>/asset/css/style.css">
	</head>
	<body>

		<h1 class="picnc"><a href="<?php echo site_url('home') ?>">pi&bull;cnc</a></h1>
		
		<?php echo form_open_multipart('photo/do_upload','','upload-form');?>
			<button class="fake-upload">Pilih Gambar</button>
			<input type="file" name="userfile" class="upload-image">
			<p class="data-image"></p>
			<input type="submit" class="upload" value="upload">
		</form>
		
		<script src="<?php echo base_url()?>/css/js/dom.js"></script>
		
	</body>
</html>

