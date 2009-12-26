/*!40100 SET CHARACTER SET cp1251;*/
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ANSI';*/
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;*/


#
# Database structure for database 'fileuploader'
#


USE "fileuploader";

CREATE TABLE /*!32312 IF NOT EXISTS*/ "comments" (
  "cid" int(10) unsigned NOT NULL auto_increment,
  "prevcid" int(10) unsigned NOT NULL default '0',
  "fid" int(10) unsigned NOT NULL,
  "name" varchar(50) default NULL,
  "text" text NOT NULL,
  "date" datetime NOT NULL,
  UNIQUE KEY "cid" ("cid")
) AUTO_INCREMENT=1 /*!40100 DEFAULT CHARSET=utf8*/;


CREATE TABLE /*!32312 IF NOT EXISTS*/ "files" (
  "file_id" int(10) unsigned NOT NULL auto_increment,
  "uid" int(10) unsigned NOT NULL,
  "filename" varchar(255) NOT NULL,
  "date" datetime NOT NULL,
  "filelist" tinyint(3) unsigned NOT NULL default '0',
  UNIQUE KEY "file_id" ("file_id")
) AUTO_INCREMENT=1 /*!40100 DEFAULT CHARSET=utf8*/;


CREATE TABLE /*!32312 IF NOT EXISTS*/ "user" (
  "uid" int(10) unsigned NOT NULL auto_increment,
  "email" varchar(128) NOT NULL,
  "password" varchar(128) NOT NULL,
  UNIQUE KEY "uid" ("uid"),
  KEY "uid_2" ("uid")
) AUTO_INCREMENT=1 /*!40100 DEFAULT CHARSET=utf8*/;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE;*/
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;*/
