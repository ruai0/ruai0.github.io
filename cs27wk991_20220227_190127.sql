-- MySQL dump 10.13  Distrib 5.6.50, for Linux (x86_64)
--
-- Host: localhost    Database: cs27wk991
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `qingka_wangke_class`
--

DROP TABLE IF EXISTS `qingka_wangke_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_class` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '网课平台名字',
  `getnoun` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '查询参数',
  `noun` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '对接参数',
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '定价',
  `queryplat` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '查询平台',
  `docking` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '对接平台',
  `yunsuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*' COMMENT '代理费率运算',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '说明',
  `addtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '添加时间',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态0为下架。1为上架',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_class`
--

LOCK TABLES `qingka_wangke_class` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_class` DISABLE KEYS */;
INSERT INTO `qingka_wangke_class` VALUES (22,1,'学习通','1','1','10','23','23','*','','2021-09-10 00:23:37',1),(21,2,'智慧职教-职教云','智慧职教','','0.1','34','2','*','','2021-10-22 11:47:59',1),(31,4,'智慧职教-MOOC','','','0.1','31','9','*','','2021-10-26 14:12:23',1),(32,3,'智慧职教-资源库','1','1','0.1','32','0','*','','2021-10-26 14:52:01',1),(52,5,'青书学堂','qhs','1','1','41','41','*','','2022-02-27 17:15:32',1);
/*!40000 ALTER TABLE `qingka_wangke_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qingka_wangke_config`
--

DROP TABLE IF EXISTS `qingka_wangke_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_config` (
  `v` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k` text COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `v` (`v`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_config`
--

LOCK TABLES `qingka_wangke_config` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_config` DISABLE KEYS */;
INSERT INTO `qingka_wangke_config` VALUES ('sitename','插件'),('keywords',''),('description',''),('dklcookie','d1abUN9efprWp3E93jrzR27IaTDLsmnV7AGLOb+rPKLrml1YDKRVBgXW0JxsfktUYm/Ym/Sk9J4eJiLfEdoPFXgKRuy/vtoV4YXYuRkarpydLsoeMgp93qAWuTWF9vRdk4xdew4QGgPIt/LzbMnUsDOHq/u5HGrnMhU8wbD35T/47sGC5cCVzGlGK565qMhH3kUzazhgiEoEpDJNAOFXttowDLKM+6G1iAApLyUNDxP7rluq383FyGxO3tcYR4VVuTEJA1V0LTNTOzhq8TJXl0l/hGE6JfDmLkDo4piWok2lnG5VTzYdMf6AJYSHwO+W4P2rAxgd3augn/kkJUfvxRiWZWPoddS4n0n1kRpIJrBNgTWuE3U9EQqxIMMwMWLI3IZvP0NZE/Nl0yqyFg'),('nanatoken','14cen/DXBsnMXkKPE50giKP/KmWGgIwn/B2sdw9z+b7zL2riFzG2mvyb04YP/xdD5w5h8uvXIKwjCo7AIF3QgzvCoiOdJfK+a9IdjpFcb2mSpzqGg9jRrEeFOomuokkA0F971RhK'),('akcookie','7321sPn6n+Yt9tGs1wy7f2ULOKbENP2W/J83w50jYbpDpQEXjkGRJnZOlXPY7XeOX5zCSU6vfhOLJSoKLMeWQ7cv9ghbEsFowYoCzQ'),('notice','1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1\r\n1'),('user_yqzc','1'),('user_htkh','1'),('user_ktmoney','5'),('',''),('login_apiurl',''),('login_appid',''),('login_appkey','');
/*!40000 ALTER TABLE `qingka_wangke_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qingka_wangke_huodong`
--

DROP TABLE IF EXISTS `qingka_wangke_huodong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_huodong` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '活动名字',
  `yaoqiu` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '要求',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '1为邀人活动 2为订单活动',
  `num` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '要求数量',
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '奖励',
  `addtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '活动开始时间',
  `endtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '活动结束时间',
  `status_ok` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1为正常 2为结束',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1为进行中  2为待领取 3为已完成',
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_huodong`
--

LOCK TABLES `qingka_wangke_huodong` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_huodong` DISABLE KEYS */;
/*!40000 ALTER TABLE `qingka_wangke_huodong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qingka_wangke_huoyuan`
--

DROP TABLE IF EXISTS `qingka_wangke_huoyuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_huoyuan` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `pt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '不带http 顶级',
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cookie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `addtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_huoyuan`
--

LOCK TABLES `qingka_wangke_huoyuan` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_huoyuan` DISABLE KEYS */;
INSERT INTO `qingka_wangke_huoyuan` VALUES (2,'ouba','欧巴仅下单','https://www.ouba.icu','','','','','','0','1','2021-08-22 16:56:10','2022-02-27 17:25:28'),(9,'wklmcookie','网课联盟cookie','http://wklm.cn','','','','','','0','1','2021-09-07 23:05:39','2022-02-27 18:58:08'),(22,'27','27','http://www.27yyds.icu','','','','','','0','1','2021-09-07 23:05:39','2022-02-27 14:37:52'),(23,'00','00','http://aixibao.xyz/','','','','','','0','1','2021-09-07 23:05:39','2022-02-27 16:56:00'),(25,'jz','捐赠接口','','','','','','','0','1','2021-09-12 14:59:21','2022-02-27 14:38:29'),(33,'xxtgf','学习通(官方查课)','','','','','','','0','1','2021-09-12 14:59:21','2022-02-16 13:51:56'),(31,'moocgf','智慧职教MOOC(官方查课)','','','','','','','0','1','2021-09-12 14:59:21',''),(32,'zykgf','智慧职教资源库(官方查课)','','','','','','','0','1','2021-09-12 14:59:21',''),(34,'zjygf','智慧职教职教云(官方查课)','','','','','','','0','1','2021-09-12 14:59:21',''),(41,'dlam','哆啦a梦cookie','http://172.247.15.234:8089','','','','','','0','1','2022-02-27 17:14:46','2022-02-27 18:57:06'),(40,'ayck','AY查课插件调用查课','http://域名/ayckapithree.php','','','','','','0','1','2022-02-27 14:40:53','2022-02-27 16:55:46'),(38,'wklmtoken','网课联盟token','http://wklm.cn','','','','','','0','1','2022-02-26 22:48:19','2022-02-27 16:55:55');
/*!40000 ALTER TABLE `qingka_wangke_huoyuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qingka_wangke_log`
--

DROP TABLE IF EXISTS `qingka_wangke_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smoney` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2413 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_log`
--

LOCK TABLES `qingka_wangke_log` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `qingka_wangke_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qingka_wangke_order`
--

DROP TABLE IF EXISTS `qingka_wangke_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_order` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT '平台ID',
  `hid` int(11) NOT NULL COMMENT '接口ID',
  `yid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '对接站ID',
  `ptname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '平台名字',
  `school` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '学校',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '账号',
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机号',
  `kcid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程ID',
  `kcname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程名字',
  `courseStartTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程开始时间',
  `courseEndTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程结束时间',
  `examStartTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '考试开始时间',
  `examEndTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '考试结束时间',
  `chapterCount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '总章数',
  `unfinishedChapterCount` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '剩余章数',
  `cookie` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'cookie',
  `fees` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '扣费',
  `noun` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '对接标识',
  `miaoshua` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0不秒 1秒',
  `addtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '添加时间',
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '下单ip',
  `dockstatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '对接状态 0待 1成  2失 3重复 4取消',
  `loginstatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '待处理',
  `process` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bsnum` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '补刷次数',
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_order`
--

LOCK TABLES `qingka_wangke_order` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `qingka_wangke_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qingka_wangke_user`
--

DROP TABLE IF EXISTS `qingka_wangke_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qingka_wangke_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qq_openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'QQuid',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'QQ昵称',
  `faceimg` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'QQ头像',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `zcz` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `addprice` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '加价',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `yqm` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '邀请码',
  `yqprice` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '邀请单价',
  `notice` text COLLATE utf8_unicode_ci NOT NULL,
  `addtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '添加时间',
  `endtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qingka_wangke_user`
--

LOCK TABLES `qingka_wangke_user` WRITE;
/*!40000 ALTER TABLE `qingka_wangke_user` DISABLE KEYS */;
INSERT INTO `qingka_wangke_user` VALUES (1,1,'2063105186','123456','2063105186','','','',8730.35,'0',0.20,'Kw933SwwgM1M0Q93','1212','0.6','666','','2022-02-27 19:00:23','39.128.73.60','','1'),(2,1,'133680','123456','133680','','','',140.00,'10159',0.20,'FFMPPtCrEiQteTBt','1111','','963','2021-08-28 23:42:50','2022-02-26 19:14:21','106.17.212.203','','1');
/*!40000 ALTER TABLE `qingka_wangke_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cs27wk991'
--

--
-- Dumping routines for database 'cs27wk991'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-27 19:01:27
