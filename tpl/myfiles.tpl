<div id="filelist">
  <br><form name="ffileaction" action="<?=delete_getvar("fileaction")?>" method="post">
	Файлы: <select name="fileaction" size="1" onChange="document.ffileaction.submit();"><br>
	<?=$actioncb?>
	</select>
  </form>
  <form name="sortby" action="<?=delete_getvar("sortid")?>" method="post">
	Сортировать по: <select name="sortid" size="1" onChange="document.sortby.submit();">
	<?=$sortcb?>
	</select>
  </form>
  <?=$navpages?><br><br>
  <center>
  <table id="fl" border="0" cellSpacing="0" cellPadding="2" width=100%;>
    <tr><td><?=$fvalue?></td><td>ID</td><td>Имя файла</td><td>Дата загрузки</td><td>URL</td></tr>
    <?=$filelist?>
  </table>
  </center>
  <br><?=$navpages?><br><br>
</div>
