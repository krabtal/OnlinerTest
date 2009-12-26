<?
include_once "./php/header.php";
$fid = $_REQUEST['fid'];
$query = "select uid, filename from files where file_id=$fid and (uid=\"$uid\" or filelist <> 0)";
$res = MySqlRow($query);
if ($res) {
  $furl = "./files/{$res->uid}/{$res->filename}";
}
header("Content-Disposition: attachment; filename=$furl");
header("Content-Type: application/x-force-download; name=\"$furl");
$handle = fopen($furl, "r"); 
$x = fread($handle, filesize($furl)); 
echo $x;
 header("Location: ./viewfile.php?fid=$fid");
?>