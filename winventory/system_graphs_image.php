<?php
header("Content-type: image/png");
$top = (100 - $_GET['disk_percent']) *2;
$image = imagecreate(5, 200);
$grey = imagecolorallocate( $image, 177, 177, 177 );
$green = imagecolorallocate( $image, 206, 231, 140 );
imagefilledrectangle ($image, 0, $top, 5, 200, $green);

imagepng($image);
?>
