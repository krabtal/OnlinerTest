<div id="rbuttons">
  <ul>
 <?php if ($uid == 0) { ?>
    <li><a href="login.php">вход</a></li>
    <li><a href="register.php">регистрация</a></li>
 <?php } else { ?>
    <li><a href="logout.php">выход</a></li>
    <li><a href="myfiles.php">мои файлы</a></li>
 <?php } ?>
    <li><a href="allfiles.php">все файлы</a></li>
  </ul>
</div>
