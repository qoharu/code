<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Caption</title>
</head>
<body>
    <img src="<?php echo $gambar ?>" ></img>
    <br>

    <form action="<?php echo site_url('photo/caption'); ?>">
        <textarea name="caption"></textarea>
        <input type="submit">
    </form>

</body>
</html>