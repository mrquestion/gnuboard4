## MySQL dump 10.11
##
## Host: localhost    Database: gnuboard4
## ######################################################
## Server version	5.0.37-log







##
## Table structure for table `__TABLE_NAME__`
##

CREATE TABLE `__TABLE_NAME__` (
  `on_id` int(11) NOT NULL auto_increment,
  `mb_no` int(11) NOT NULL,
  `on_subject` varchar(255) NOT NULL default '',
  `on_question` mediumtext NOT NULL,
  `on_answer` mediumtext NOT NULL,
  `on_qfile` varchar(255) NOT NULL,
  `on_qsource` varchar(255) NOT NULL,
  `on_afile` varchar(255) NOT NULL,
  `on_asource` varchar(255) NOT NULL,
  `on_qdatetime` datetime NOT NULL,
  `on_adatetime` datetime NOT NULL,
  PRIMARY KEY  (`on_id`),
  KEY `mb_no` (`mb_no`)
);







## Dump completed on 2007-04-23 14:13:55
