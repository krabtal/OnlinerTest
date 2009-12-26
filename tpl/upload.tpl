<div id="upload">
  <form enctype="multipart/form-data" action="./myfiles.php" method="post">
  <center>
	<text>загрузка файла</text><br><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
	<input name="upload" type="file" class="input_filename" size="50"></input><br>
	<input type="submit" name="submit" value="загрузить"></input>
  </form>
</div>
