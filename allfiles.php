<?php
include_once "./php/header.php";
$sort = GetSortID();
$start = (isset($_GET["start"])) ? $_GET["start"] : 0 ;

$sorttext = array('дате', 'имени');
$sortq = array ('order by date', 'order by filename');

$reloadurl = $_SERVER['php_self']."?fileaction=$action&start=$start&sortid=$sort";


$ipp = 25;

$query = "select count(*) from files where filelist<>0";
$query2 = "select file_id, filename, date from files where filelist<>0 {$sortq[$sort]} limit $start , $ipp";

$filescount = MySqlValue($query);
$pagesbar = new Pagination;
$navpages = $pagesbar->ShowPages($filescount, $start, $ipp);

$fl = "";
$servername = "http://{$_SERVER['SERVER_NAME']}";
$res = MySqlQuery($query2);
while ($row = mysql_fetch_object($res)) {
  $fl.="<tr><td>{$row->file_id}</td><td><a href=\"viewfile.php?fid={$row->file_id}\">{$row->filename}";
  $fl.="</td><td>{$row->date}</td><td>$servername/$uid/{$row->filename}</td></tr>";
}
mysql_free_result($res);
if ($fl == "") {
  $filelist = "<tr><td colspan='4'>нет файлов в списках ползователей</td><tr>";
}

$sortcb = "";
foreach ($sorttext as $key=>$value){
  $sortcb.="<option value='$key'";
  if ($key == $sort) $sortcb.= " selected";
  $sortcb.=">$value</option>";
}

include_once "./tpl/header.tpl";
include_once "./tpl/allfiles.tpl";
include_once "./php/footer.php";
?>