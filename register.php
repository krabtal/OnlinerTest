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
      $errortext = "������������ � ����� E-mail ��� ����������";
    } elseif (strlen($password) < 8) {
      $errortext = "������ ������ ���� ������ 8 ��������";
    } else {
      $query = "insert into user (email, password) values(\"$email\",\"$password\");";
      $uid = MySqlQuery($query);
      if ($uid == false) {
        $errortext = "�������� E-mail ��� ������";
      } else {
        $_SESSION['uid'] = $uid;
        $_SESSION['email'] = $email;
        header("Location: ./index.php");
      }
    }
  } 
}
include_once "./tpl/header.tpl";
include_once "./tpl/register.tpl";
include_once "./php/footer.php";
?>