<!doctype html>
<html>
<head>
  <title>Tambahkan Efek</title>
  <meta charset="utf-8" />
  <script type="text/javascript" src="<?php echo base_url('asset/js').'/common.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/js').'/paintbrush.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/js').'/playground.js' ?>"></script>
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css').'/playground.css' ?>" />
  
</head>
<body>

<form action="#" method="post" id="interaction-form">
<div id="interaction" onmousemove="berubah()">
<img onchange="berubah()" id="filter-target" src="<?php echo base_url('uploads/').'/'.$gambar ?>" width="500" height="333" alt="">
<label class="selector"> Filter:
<select id="filter-selector">
</select>
</label>
<div class="controls" id="controls-blur">
<label> Amount:
<input type="range" name="data-pb-blur-amount" min="0" max="10" step="0.05" value="0">
</label>
</div>
<div class="controls" id="controls-edges">
<label> Amount:
<input type="range" name="data-pb-edges-amount" min="0" max="1" step="0.01" value="1">
</label>
</div>
<div class="controls" id="controls-emboss">
<label> Amount:
<input type="range" name="data-pb-emboss-amount" min="0" max="1" step="0.01" value="0.2">
</label>
</div>
<div class="controls" id="controls-greyscale">
<label> Opacity:
<input type="range" name="data-pb-greyscale-opacity" min="0" max="1" step="0.01" value="1">
</label>
</div>
<div class="controls" id="controls-matrix">
<label> Amount:
<input type="range" name="data-pb-matrix-amount" min="0" max="1" step="0.01" value="0.2">
</label>
</div>
<div class="controls" id="controls-mosaic">
<label> Opacity:
<input type="range" name="data-pb-mosaic-opacity" min="0" max="1" step="0.01" value="1">
</label>
<label> Size:
<input type="range" name="data-pb-mosaic-size" min="1" max="40" step="1" value="5">
</label>
</div>
<div class="controls" id="controls-noise">
<label> Amount:
<input type="range" name="data-pb-noise-amount" min="0" max="100" step="1" value="30">
</label>
<label> Type:
<input type="radio" name="data-pb-noise-type" value="mono">
Mono
<input type="radio" name="data-pb-noise-type" value="colour">
Colour </label>
</div>
<div class="controls" id="controls-posterize">
<label> Amount:
<input type="range" name="data-pb-posterize-amount" min="2" max="100" step="1" value="5">
</label>
<label> Opacity:
<input type="range" name="data-pb-posterize-opacity" min="0" max="1" step="0.01" value="1">
</label>
</div>
<div class="controls" id="controls-sepia">
<label> Opacity:
<input type="range" name="data-pb-sepia-opacity" min="0" max="1" step="0.01" value="0.5">
</label>
</div>
<div class="controls" id="controls-sharpen">
<label> Amount:
<input type="range" name="data-pb-sharpen-amount" min="0" max="1" step="0.01" value="0.2">
</label>
</div>
<div class="controls" id="controls-tint">
<label> Colour:
<input type="text" name="data-pb-tint-color" value="#FF0000">
</label>
<label> Opacity:
<input type="range" name="data-pb-tint-opacity" min="0" max="1" step="0.01" value="0.5">
</label>
</div>
<button class="apply" type="submit">Apply</button>
</div>
</form>

<center>

<form  action="<?php echo site_url('photo/post'); ?>" method="POST">
  <textarea style="display:none" class="rawimg" name="gambar" cols="150" rows="100" ></textarea>
  <input type='text' name='imgname' style="display:none" value="<?php echo $gambar ?>">
  <textarea name='caption' maxlength="160" cols="30" rows="5"></textarea><br>
	<input type="submit" value="POST" />
</form>
</center>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

 
  function berubah(){
  	var ini = document.querySelector("#filter-target");
	  var abcd = ini.getAttribute("src");

	  var rawimg = document.querySelector(".rawimg")
	  rawimg.innerHTML=abcd; 
  }


</script>
</body>
</html>