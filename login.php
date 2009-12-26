<?php
$errortext="";
include_once "./php/header.php";
if (isset($_REQUEST['email'])) 
{
  $email = $_REQUEST['email'];
  if (isset($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
    $query = "select uid from user where email=\"$email\" and password=\"$password\"";
    $uid = MySqlValue($query);
    if ($uid == false) {
      $errortext = "Неверный E-mail или Пароль";
    } else {
      $_SESSION['uid'] = $uid;
      $_SESSION['email'] = $email;
      $query = "insert into historylog (uid, date, ip, browser) values($uid, now(), \"{$_SERVER['REMOTE_ADDR']}\", \"{$_SERVER['HTTP_USER_AGENT']}\")";
      MySqlQuery($query);
      header("Location: ./index.php");
    }
  }
}
include_once "./tpl/header.tpl";
include_once "./tpl/login.tpl";
include_once "./php/footer.php";
?>