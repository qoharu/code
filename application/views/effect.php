<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Effect</title>
</head>
<body>

<?php

    foreach ($link as $alamat => $anchor){

        echo "<a href='$anchor'> <img src='$gambar[$alamat]' title='$alamat'> </img></a> ";
    }

?>
</body>
</html>