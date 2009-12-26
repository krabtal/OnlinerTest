<?php

function MySqlQuery($query){
  $mysql_host = "localhost";
  $mysql_user = "fileuploader";
  $mysql_password = "123123";
  $mysql_db = "fileuploader";
  $link = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die("Could not connect");
  mysql_select_db($mysql_db) or die("Could not select database");
  $result = mysql_query($query) or die("Could not query database: $query");
  return($result);
}

function MySqlRow($query, $type = 'object'){
  $result = MySqlQuery("$query limit 1");
  if ($type == 'object') $res = mysql_fetch_object($result);
  else if ($type == 'array') $res = mysql_fetch_array($result);
  mysql_free_result($result);
  if ($res) return($res);
  else return (false);
}

function MySqlValue($query){
  $result = MySqlQuery($query);
  $res = mysql_fetch_row($result);
  mysql_free_result($result);
  if ($res) return($res[0]);
  else return (false);
}

function CheckLogin() {
  if (!isset($_SESSION['uid'])) $_SESSION['uid'] = 0;
  if ($_SESSION['uid'] == 0) {
    $phpself = substr(strrchr($_SERVER['PHP_SELF'], "/"), 1);
    if (($phpself == "myfiles.php") || ($phpself == "upload.php")) header("location ./index.php");
    return (0);
  } else {
    return ($_SESSION['uid']);
  }
}

function delete_getvar($varname, $link = "") {
  if ($link == "") $link= $_SERVER["REQUEST_URI"];
  $tmp = split("\?",$link."?");
  $tmp2 = split("\&",$tmp[1]);
  $newlink = $tmp[0]."?";
  
  for ($i=0;$i<count($tmp2);$i++) {
    if ((strpos($tmp2[$i],$varname) === false) and ($tmp2[$i] != "")) {
      $newlink .= $tmp2[$i]."&";
    }
  }
  $newlink = substr(trim($newlink),0,strlen(trim($newlink))-1);
  if ($link != $newlink) return ($newlink);
  else return($link);
}

function GetComments($fid, $prevcid = 0, $lvl = 0) {
  $query = "select cid, name, date from comments where fid=\"$fid\" and prevcid=\"$prevcid\";";
  $res=MySqlQuery($query);
  if (mysql_num_rows($res)) {
    $str1.="<ul>";
    while ($row=mysql_fetch_object($res)) {
      $cid = $row->cid;
      $str1.="<li><a href=\"./viewfile.php?fid=$fid&commentid=$cid\">{$row->name} - {$row->date}</a>";
      $str1.=GetComments($fid, $row->cid, $lvl+1);
      $str1.="</li>";
    }
    $str1.="</ul>";
  }
  return($str1);
}


class Pagination {
  var $link="";
  var $totalitem=0;
  var $itemperpage=10;
  var $bepages = 3;
  var $aroundpages = 2;
  
  function Init() {
  }
  
  function ShowPages($totalitem, $itemstart, $ipp) {
    global $_COOKIE;
    global $_GET;
    
    $resutl = "";
    $link=delete_getvar("start");
    $link .= (strpos($link,"?")) ? "&start=" : "?start=";
    $start = $itemstart;
    
    if ($ipp >= $totalitem) return $result;
    if ($start >= $totalitem) $start = 0;
    $startpage = (int)($start / $ipp) + 1;
    $totalpage = (int)(($totalitem -1) / $ipp) + 1;
    $result .= "<span class='pagination'>";
    if ($startpage > 1) $result .= "<a href=\"".$link.($startpage-2)*$ipp."\">пред</a>";
    $i=1;
    while ($i <= $totalpage) {
      if ( (($i>$this->bepages)&&($i<$startpage-$this->aroundpages)) ||
          (($i>$startpage+$this->aroundpages) && ($i<$totalpage-$this->bepages+1)) ) {
        $result .= "...";
        $i =  ($i<$startpage) ? $startpage-$this->aroundpages : $totalpage-$this->bepages+1;
        continue;
      }
      if ($i==$startpage) {
        $result .=  "<a href=\"\" onclick=\"return false\" class=\"active\">".$i."</a>";
      } else {
        $result .=  "<a href=\"".$link.($i-1)*$ipp."\">".$i."</a>";
      }
      $i++;
    }
    if ($startpage < $totalpage) $result .= "<a href=\"".$link.($startpage)*$ipp."\">след</a>";
    $result .="</span>";
    return $result;
  }
}

function GetSortID() {
  $loc = delete_getvar("sortid");
  if (!strstr($loc, "?")) $loc = $loc."?";
  else $loc = $loc."&";
  if (isset($_POST['sortid'])) header("Location:{$loc}sortid=".$_POST['sortid']);
  if (isset($_GET['sortid']))  return($_GET['sortid']);
  return(0);
}
  
function GetFileAction() {
  $loc = delete_getvar("fileaction");
  if (!strstr($loc, "?")) $loc = $loc."?";
  else $loc = $loc."&";
  if (isset($_POST['fileaction'])) header("Location: {$loc}fileaction=".$_POST['fileaction']);
  if (isset($_GET['fileaction']))  return($_GET['fileaction']);
  return(0);
}


?>