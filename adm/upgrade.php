<?
$sub_menu = "100990";
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "���׷��̵�";
include_once("./admin.head.php");

// ����Ʈ ���̺� �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[point_table]` ADD `po_rel_table` VARCHAR( 20 ) NOT NULL ,
                                           ADD `po_rel_id` VARCHAR( 20 ) NOT NULL ,
                                           ADD `po_rel_action` VARCHAR( 255 ) NOT NULL ", FALSE);

// ����Ʈ ���̺��� ȸ�����̵� ���� ����
sql_query(" ALTER TABLE `$g4[point_table]` CHANGE `mb_id` `mb_id` VARCHAR( 20 ) NOT NULL ", FALSE);

// ����Ʈ ���̺��� �ε��� ����
sql_query(" ALTER TABLE `$g4[point_table]` DROP INDEX `index1` , ADD INDEX `index1` ( `mb_id` , `po_rel_table` , `po_rel_id` , `po_rel_action` ) ", FALSE);

// ��ǥ ���̺� ��ǥ�� ȸ�� �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[poll_table]` ADD `mb_ids` TEXT NOT NULL ", FALSE);

// ȯ�漳�� ���̺� �����ʵ� �߰�
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_1` VARCHAR( 255 ) NOT NULL , ADD `cf_2` VARCHAR( 255 ) NOT NULL , ADD `cf_3` VARCHAR( 255 ) NOT NULL , ADD `cf_4` VARCHAR( 255 ) NOT NULL , ADD `cf_5` VARCHAR( 255 ) NOT NULL , ADD `cf_6` VARCHAR( 255 ) NOT NULL , ADD `cf_7` VARCHAR( 255 ) NOT NULL , ADD `cf_8` VARCHAR( 255 ) NOT NULL , ADD `cf_9` VARCHAR( 255 ) NOT NULL , ADD `cf_10` VARCHAR( 255 ) NOT NULL ", FALSE);

// �α��ν�Ų �ʵ� ����
sql_query(" ALTER TABLE `$g4[config_table]` DROP `cf_login_skin` ", FALSE);

// ȸ�����Խ�Ų �ʵ带 ȸ�����ý�Ų �ʵ�� ����
sql_query(" ALTER TABLE `$g4[config_table]` CHANGE `cf_register_skin` `cf_member_skin` VARCHAR( 255 ) NOT NULL ", FALSE);

// ���ηα��� �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_login_skin` VARCHAR( 255 ) NOT NULL AFTER `cf_new_skin` ", FALSE);

// ������ ��Ų �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_connect_skin` VARCHAR( 255 ) NOT NULL AFTER `cf_search_skin` ", FALSE);

// ���� ���� ��� �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_file_content` TINYINT NOT NULL AFTER `bo_use_sideview` ", FALSE);

// ���� ���̺� ���� �ʵ� �߰� (�������� ��� �ش� �̹����� ���� ������ ����)
sql_query(" ALTER TABLE `$g4[board_file_table]` ADD `bf_content` TEXT NOT NULL ", FALSE);

// �湮�ڷα׻���, �α�˻������ �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_visit_del` INT NOT NULL AFTER `cf_memo_del` , ADD `cf_popular_del` INT NOT NULL AFTER `cf_visit_del` ", FALSE);

// �˻� ��Ų �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_search_skin` VARCHAR( 255 ) NOT NULL AFTER `cf_new_skin` ", FALSE);

// �ֱٰԽù� ��Ų �ʵ� �߰�
sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_new_skin` VARCHAR( 255 ) NOT NULL AFTER `cf_nick_modify` ", FALSE);

// ��� �ʵ�� ����
sql_query(" ALTER TABLE `$g4[config_table]` CHANGE `cf_provision` `cf_stipulation` TEXT NOT NULL ", FALSE);

// �Խ��� ���� ����
sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_write_min` INT NOT NULL AFTER `bo_count_comment` , ADD `bo_write_max` INT NOT NULL AFTER `bo_write_min` , ADD `bo_comment_min` INT NOT NULL AFTER `bo_write_max` , ADD `bo_comment_max` INT NOT NULL AFTER `bo_comment_min` ", FALSE);


// �α�˻��� ���̺� ����
$sql = " CREATE TABLE $g4[popular_table] (
  pp_id int(11) NOT NULL auto_increment,
  pp_word varchar(50) NOT NULL default '',
  pp_date date NOT NULL default '0000-00-00',
  pp_ip varchar(50) NOT NULL default '',
  PRIMARY KEY  (pp_id),
  UNIQUE KEY index1 (pp_date,pp_word,pp_ip)
) TYPE=MyISAM ";
sql_query($sql, FALSE);

sql_query(" ALTER TABLE `$g4[board_new_table]` ADD `wr_parent` INT NOT NULL AFTER `wr_id` ", FALSE);

sql_query(" ALTER TABLE `$g4[board_new_table]` CHANGE `wr_id` `wr_id` INT NOT NULL ", FALSE);
                                             
sql_query(" ALTER TABLE `$g4[poll_table]` ADD `po_point` INT NOT NULL AFTER `po_level` ", FALSE);

sql_query(" ALTER TABLE `$g4[point_table]` ADD `po_point` INT NOT NULL AFTER `po_level` ", FALSE);


$sql = " select bo_table from $g4[board_table] ";
$result = sql_query($sql);
while($row=sql_fetch_array($result))
{
    sql_query(" ALTER TABLE `{$g4[write_prefix]}{$row[bo_table]}` ADD `wr_comment_reply` VARCHAR( 255 ) NOT NULL AFTER `wr_comment` ", FALSE);
}


sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_use_copy_log` TINYINT NOT NULL AFTER `cf_use_norobot` ", FALSE);

sql_query(" ALTER TABLE `$g4[config_table]` ADD `cf_register_skin` VARCHAR( 255 ) DEFAULT 'basic' NOT NULL AFTER `cf_intercept_ip` ", FALSE);

sql_query(" ALTER TABLE `$g4[board_table]` ADD `bo_use_sideview` TINYINT NOT NULL AFTER `bo_disable_tags` ", FALSE);


// ȸ���������̺� ����
$sql = " CREATE TABLE $g4[mail_table] (
  ma_id int(11) NOT NULL auto_increment,
  ma_subject varchar(255) NOT NULL default '',
  ma_content mediumtext NOT NULL,
  ma_time datetime NOT NULL default '0000-00-00 00:00:00',
  ma_ip varchar(255) NOT NULL default '',
  ma_last_option text NOT NULL,
  PRIMARY KEY  (ma_id)
) TYPE=MyISAM ";
sql_query($sql, FALSE);


// auth table ����
$sql = " CREATE TABLE $g4[auth_table] (
  mb_id varchar(255) NOT NULL default '',
  au_menu varchar(20) NOT NULL default '',
  au_auth set('r','w','d') NOT NULL default '',
  PRIMARY KEY  (mb_id,au_menu)
) TYPE=MyISAM ";
sql_query($sql, FALSE);


echo "UPGRADE �Ϸ�.";

include_once("./admin.tail.php");
?>