<?
header("Content-Disposition: attachment; filename=./files/cart.php");
header("Content-Type: application/x-force-download; name=\"./files/cart.php\"");
$handle = fopen("./files/cart.php", "r"); 
$x = fread($handle, filesize("./files/cart.php")); 
echo $x;
// header("Location: ./files/cart.php");
?>