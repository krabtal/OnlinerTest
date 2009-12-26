<?php
include_once "./php/header.php";
if (isset($_REQUEST['commentid'])) $cid = $_REQUEST['commentid'];
else $cid = 0;

if (isset($_REQUEST['submit'])) {
  $query = "insert into comments (prevcid, fid, name, text, date) values($cid, \"{$_REQUEST['fid']}\", \"{$_REQUEST['name']}\", \"{$_REQUEST['comment']}\", now())";
  MySqlQuery($query);
}
if (isset($_REQUEST['fid'])) {
  $fid = $_GET['fid'];
  $query = "select filename, uid, date, filelist from files where file_id=\"$fid\" and (uid=\"$uid\" or filelist <> 0)";
  $res = MySqlRow($query);
  if ($res) {
    $filename = $res->filename;
    $fuid = $res->uid;
    $fdate = $res->date;
    include_once "./tpl/header.tpl";
    include "./tpl/file.tpl";
    $pvevcid = 0;
    if ($cid != 0) {
      $query = "select prevcid, name, date, text from comments where cid=\"$cid\" and fid=\"$fid\"";
      $res = MySqlRow($query);
      if ($res) {
        $cn = $res->name;
        $cdate = $res->date;
        $ctext = $res->text;
        $prevcid = $res->prevcid;
        if ($cname = "") $cname="Гость";
        include "./tpl/viewcomment.tpl";
      }
    }
    include "./tpl/addcomment.tpl";
    if ($prevcid) $prevlvllink = "./viewfile.php?fid=$fid&commentid=$prevcid";
    else $prevlvllink="./viewfile.php?fid=$fid";
    $toplvllink = "./viewfile.php?fid=$fid";
    $comments = GetComments($fid, $cid);
    include "./tpl/comments.tpl";
    include_once "./php/footer.php";
    //    $comments = GetComments($fid)
  }
}
?>