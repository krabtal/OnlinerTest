<?php
$errortext="";
include_once "./php/header.php";
if (isset($_REQUEST['email'])) 
{
  $email = $_REQUEST['email'];
  if (isset($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
    $query = "select uid from user where email=\"$email\" and password=\"$password\";";
    $uid = MySqlValue($query);
    if ($uid == false) {
      $errortext = "Неверный E-mail или Пароль";
    } else {
      $_SESSION['uid'] = $uid;
      $_SESSION['email'] = $email;
      header("Location: ./index.php");
    }
  }
}
include_once "./tpl/header.tpl";
include_once "./tpl/login.tpl";
include_once "./php/footer.php";
?>