<?php
$errortext="";
include_once "./php/header.php";
if (isset($_REQUEST['email'])) 
{
  $email = $_REQUEST['email'];
  if (isset($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
    $query = "select uid from user where email=\"$email\";";
    $uid = MySqlValue($query);
    if ($uid) {
      $errortext = "Пользователь с таким E-mail уже существует";
    } elseif (strlen($password) < 8) {
      $errortext = "Пароль должен быть больше 8 символов";
    } else {
      $query = "insert into user (email, password) values(\"$email\",\"$password\");";
      $uid = MySqlQuery($query);
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
}
include_once "./tpl/header.tpl";
include_once "./tpl/register.tpl";
include_once "./php/footer.php";
?>