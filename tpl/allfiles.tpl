<div id="filelist">
  <br>
  <form name="sortby" action="<?=delete_getvar("sortid")?>" method="post">
	����������� ��: <select name="sortid" size="1" onChange="document.sortby.submit();">
	<?=$sortcb?>
	</select>
  </form>
  <?=$navpages?><br><br>
  <center>
  <table id="fl" border="0" cellSpacing="0" cellPadding="2" width=100%;>
    <tr><td>ID</td><td>��� �����</td><td>���� ��������</td><td>URL</td></tr>
    <?=$fl?>
  </table>
  </center>
  <br><?=$navpages?><br><br>
</div>
