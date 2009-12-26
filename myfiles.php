<?php
include_once "./php/header.php";
$sort = GetSortID();
$action = GetFileAction();
$start = (isset($_GET["start"])) ? $_GET["start"] : 0 ;

$sorttext = array('дате', 'имени');
$sortq = array ('order by date', 'order by filename');

$actiontext = array('все файлы', 'мой список', 'добавить в список');
$actionq = array ('', 'and filelist <> 0', 'and filelist = 0');

$reloadurl = $_SERVER['php_self']."?fileaction=$action&start=$start&sortid=$sort";

if (isset($_POST['submit'])) {
  if ((isset($_FILES['upload']['tmp_name'])) && (is_uploaded_file($_FILES['upload']['tmp_name']))) {
    if (is_file("./files/$uid/".$_FILES['upload']['name'])) { // File already exist
      //      if () 
    } else {
      if (move_uploaded_file($_FILES['upload']['tmp_name'], "./files/$uid/".$_FILES['upload']['name'])) {
        $query = "insert into files (uid, filename, date) VALUES(\"$uid\", \"".$_FILES['upload']['name']."\", now());";
        $result = MySqlQuery($query) or die ("Could not query ".$query);
      }
      
    }
  }
} elseif (isset($_REQUEST['del'])) {
  foreach ($_REQUEST as $file=>$val) {
    if (!strcmp(substr($file,0,3),"fcb")) {
      $fid = substr($file,3);
      $query = "select filename from files where file_id=\"$fid\" and uid=\"$uid\";";
      $res = MySqlValue($query);
      if ($res) {
        if (unlink("./files/$uid/$res")) {
          $query = "delete from files where file_id=\"$fid\" and uid=\"$uid\";";
          MySqlQuery($query);
        }
      }
    }
  }
  header("Location: $reloadurl");
} elseif (isset($_REQUEST['rem'])) {
  foreach ($_REQUEST as $file=>$val) {
    if (!strcmp(substr($file,0,3),"fcb")) {
      $fid = substr($file,3);
      $query = "update files set filelist=0 where file_id=\"$fid\" and uid=\"$uid\";";
      $res = MySqlQuery($query);
    }
  }
  header("Location: $reloadurl");
} elseif (isset($_REQUEST['add'])) {
  foreach ($_REQUEST as $file=>$val) {
    if (!strcmp(substr($file,0,3),"fcb")) {
      $fid = substr($file,3);
      $query = "update files set filelist=1 where file_id=\"$fid\" and uid=\"$uid\";";
      $res = MySqlQuery($query);
    }
  }
  header("Location: $reloadurl");
}


$ipp = 25;

$query = "select count(*) from files where uid=\"$uid\"{$actionq[$action]}";
$query2 = "select file_id, filename, date from files where uid=\"$uid\" {$actionq[$action]} {$sortq[$sort]} limit $start , $ipp";

$filescount = MySqlValue($query);
$pagesbar = new Pagination;
if ($action == 0) {
  $fname="del";
  $fvalue="удалить";
} elseif ($action == 1) {
  $fname="rem";
  $fvalue="убрать";
} elseif ($action == 2) {
  $fname="add";
  $fvalue="добавить";
}

$navpages = $pagesbar->ShowPages($filescount, $start, $ipp);

$fl = "";
$servername = "http://{$_SERVER['SERVER_NAME']}";
$res = MySqlQuery($query2);
while ($row = mysql_fetch_object($res)) {
  $fl.="<tr><td><input type='checkbox' name='fcb{$row->file_id}'></td><td>{$row->file_id}</td><td><a href=\"viewfile.php?fid={$row->file_id}\">{$row->filename}";
  $fl.="</td><td>{$row->date}</td><td>$servername/$uid/{$row->filename}</td></tr>";
}
mysql_free_result($res);
if ($fl != "") {
  $filelist = "<form action=\"\" method=\"post\">$fl<tr><td colspan='5'><input class=\"submit\" type=\"submit\" name=\"$fname\" value=\"$fvalue\"></td></tr></form>";
} else {
  $filelist = "<tr><td colspan='5'>У Вас нет загруженных файлов</td><tr>";
}

$sortcb = "";
foreach ($sorttext as $key=>$value){
  $sortcb.="<option value='$key'";
  if ($key == $sort) $sortcb.= " selected";
  $sortcb.=">$value</option>";
}

$actioncb = "";
foreach ($actiontext as $key=>$value){
  $actioncb.="<option value='$key'";
  if ($key == $action) $actioncb.= " selected";
  $actioncb.=">$value</option>";
}

include_once "./tpl/header.tpl";
include_once "./tpl/myfiles.tpl";
include_once "./tpl/upload.tpl";
include_once "./php/footer.php";
?>