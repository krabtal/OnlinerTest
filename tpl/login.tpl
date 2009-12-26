<div class="login">
<center>
¬ведите ваш E-mail и пароль
<br><br><br>
<form name="loginform" action="login.php" method="post">
<table class="login"><tr><td>
  <b>E-mail:</b></td><td>
  <input type="text" name="email" value="<?=$email?>" size=32 maxlength=100  class="login"></td></tr><tr><td>
  <b>ѕароль:</b></td><td>
  <input type="password" name="password" size=32 maxlength=32 class="login"></td></tr><tr><td colspan="2">
  <center><br><input type="submit" name="submit" class="1art1" value="login"></center>
</td></tr></table>
<br>
<br>
<?=$errortext?>
</form>
<script type="text/javascript">
<!--
  if (document.loginform.email.value != ""){document.loginform.password.focus();}
  else{document.loginform.email.focus();}
//-->
</script>
</div>
