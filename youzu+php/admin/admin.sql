/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.12-log : Database - admin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`admin` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `admin`;

/*Table structure for table `action` */

DROP TABLE IF EXISTS `action`;

CREATE TABLE `action` (
  `aid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` smallint(2) DEFAULT '1',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `action` */

insert  into `action`(`aid`,`url`,`remark`,`create_time`,`update_time`,`status`) values (1,'action/add','添加权限add',1506580126,1506580126,1),(2,'action/addAction','权限addAction',1506580180,1506580180,1),(3,'action/list','权限列表',1506580232,1506580232,1),(4,'menu/add','添加菜单add',1506587409,1506587409,1),(5,'menu/addAction','添加菜单addAction',1506587499,1506587499,1),(7,'menu/list','菜单列表',1506587640,1506587640,1),(8,'role/add','角色ADD',1506587836,1506587836,1),(9,'role/list','角色列表',1506587836,1506587836,1);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `mid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `sorts` int(8) DEFAULT '0',
  `pid` int(8) DEFAULT '0',
  `icon` varchar(100) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` smallint(2) DEFAULT '1',
  PRIMARY KEY (`mid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`mid`,`title`,`url`,`action`,`sorts`,`pid`,`icon`,`create_time`,`update_time`,`status`) values (1,'菜单管理','','',0,0,'icon-group',NULL,NULL,1),(2,'添加菜单','/kejian/admin/system/add.php','system/add',0,1,'icon-cogs',NULL,NULL,1),(3,'菜单列表','/kejian/admin/system/list.php','system/list',3,1,'',1506503684,1506503684,1),(4,'用户管理','','',1,0,'icon-user',1506504050,1506504050,1),(5,'用户列表','/kejian/admin/user/list.php','user/list',1,4,'',1506504117,1506504117,1),(6,'添加用户','/kejian/admin/user/aad.php','user/add',2,4,'',1506504361,1506504361,1),(7,'删除用户','/kejian/admin/user/del.php','user/del',2,4,'',1506507851,1506507851,1),(8,'权限管理','','',2,0,'icon-user',1506579301,1506579301,1),(9,'添加权限','/kejian/admin/action/add.php','role/add',1,8,'',1506579378,1506579378,1),(10,'权限列表','/kejian/admin/action/list.php','role/list',2,8,'',1506579408,1506579408,1),(11,'角色管理','','',4,0,'icon-user',1506580309,1506580309,1),(12,'添加角色','/kejian/admin/role/add.php','role/add',1,11,'',1506580335,1506580335,1),(13,'角色列表','/kejian/admin/role/list.php','role/list',2,11,'',1506580357,1506580357,1);

/*Table structure for table `r_action` */

DROP TABLE IF EXISTS `r_action`;

CREATE TABLE `r_action` (
  `raid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(8) NOT NULL,
  `action_id` int(8) NOT NULL,
  PRIMARY KEY (`raid`),
  UNIQUE KEY `role_id` (`role_id`,`action_id`),
  KEY `role_id_2` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `r_action` */

insert  into `r_action`(`raid`,`role_id`,`action_id`) values (1,1,1),(2,1,2),(3,1,3),(5,2,1),(9,2,2),(4,2,3),(7,2,8),(8,2,9);

/*Table structure for table `r_menu` */

DROP TABLE IF EXISTS `r_menu`;

CREATE TABLE `r_menu` (
  `rmid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(8) NOT NULL,
  `menu_id` int(8) NOT NULL,
  PRIMARY KEY (`rmid`),
  UNIQUE KEY `role_id` (`role_id`,`menu_id`),
  KEY `role_id_2` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `r_menu` */

insert  into `r_menu`(`rmid`,`role_id`,`menu_id`) values (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,1,11),(12,1,12),(13,1,13),(14,2,1),(15,2,3),(16,2,4),(18,2,5),(17,2,6),(19,2,8),(20,2,10),(21,2,11),(22,2,13);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `rid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` smallint(2) DEFAULT '1',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`rid`,`name`,`create_time`,`update_time`,`status`) values (1,'超级管理员',1506580563,1506580563,1),(2,'运营管理员',1506580577,1506580577,1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` smallint(2) DEFAULT '1',
  `role_id` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`account`,`password`,`create_time`,`update_time`,`status`,`role_id`) values (1,'admin','a6e1fe5e01be1e254228caa25a5b4b36',NULL,NULL,1,1),(2,'guest','a6e1fe5e01be1e254228caa25a5b4b36',NULL,NULL,1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
