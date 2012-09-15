/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;



DROP TABLE IF EXISTS `battery`;
CREATE TABLE `battery` (
  `battery_id`                  int(10) unsigned NOT NULL auto_increment,
  `battery_uuid`                varchar(100) NOT NULL default '',
  `battery_description`         varchar(100) NOT NULL default '',
  `battery_device_id`           varchar(100) NOT NULL default '',
  `battery_timestamp`           bigint(20) unsigned NOT NULL default '0',
  `battery_first_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`battery_id`),
  KEY `id`      (`battery_uuid`),
  KEY `id2`     (`battery_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `bios`;
CREATE TABLE `bios` (
  `bios_id`                 int(10) unsigned NOT NULL auto_increment,
  `bios_uuid`               varchar(100) NOT NULL default '',
  `bios_description`        varchar(200) NOT NULL default '',
  `bios_manufacturer`       varchar(200) NOT NULL default '',
  `bios_serial_number`      varchar(100) NOT NULL default '',
  `bios_sm_bios_version`    varchar(100) NOT NULL default '',
  `bios_version`            varchar(100) NOT NULL default '',
  `bios_asset_tag`          varchar(100) NOT NULL default '',
  `bios_timestamp`          bigint(20) unsigned NOT NULL default '0',
  `bios_first_timestamp`    bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`bios_id`),
  KEY `id`      (`bios_uuid`),
  KEY `id2`     (`bios_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `browser_helper_objects`;
CREATE TABLE `browser_helper_objects` (
  `bho_id`                  int(10) unsigned NOT NULL auto_increment,
  `bho_uuid`                varchar(100) NOT NULL default '',
  `bho_code_base`           varchar(250) NOT NULL default '',
  `bho_status`              varchar(45)  NOT NULL default '',
  `bho_program_file`        varchar(100) NOT NULL default '',
  `bho_timestamp`           bigint(20) unsigned NOT NULL default '0',
  `bho_first_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`bho_id`),
  KEY `id`      (`bho_uuid`),
  KEY `id2`     (`bho_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call`;
CREATE TABLE `call` (
  `call_id`                     int(10) unsigned NOT NULL auto_increment,
  `call_priority`               varchar(45)  NOT NULL default '',
  `call_status`                 varchar(45)  NOT NULL default '',
  `call_system_link`            varchar(45)  NOT NULL default '',
  `call_department`             varchar(45)  NOT NULL default '',
  `call_category`               varchar(45)  NOT NULL default '',
  `call_request_close_by`       datetime NOT NULL default '0000-00-00 00:00:00',
  `call_issue_start_date`       datetime NOT NULL default '0000-00-00 00:00:00',
  `call_closed_date`            datetime NOT NULL default '0000-00-00 00:00:00',
  `call_logged_date`            datetime NOT NULL default '0000-00-00 00:00:00',
  `call_assigned_date`          datetime NOT NULL default '0000-00-00 00:00:00',
  `call_support_level`          int(10) unsigned NOT NULL default '0',
  `call_short_description`      varchar(100) NOT NULL default '',
  `call_detailed_description`   varchar(250) NOT NULL default '',
  `call_logged_person`          varchar(80)  NOT NULL default '',
  `call_logged_source`          varchar(45)  NOT NULL default '',
  `call_logged_department`      varchar(45)  NOT NULL default '',
  `call_logged_company`         varchar(45)  NOT NULL default '',
  `call_logged_contact_phone`   varchar(45)  NOT NULL default '',
  `call_logged_contact_email`   varchar(60)  NOT NULL default '',
  `call_logged_location`        varchar(45)  NOT NULL default '',
  `call_assigned_person`        varchar(45)  NOT NULL default '',
  `call_assigned_company`       varchar(45)  NOT NULL default '',
  `call_assigned_department`    varchar(45)  NOT NULL default '',
  `call_ext_company`            varchar(45)  NOT NULL default '',
  `call_ext_reference`          varchar(45)  NOT NULL default '',
  `call_ext_priority`           varchar(45)  NOT NULL default '',
  `call_ext_assigned`           varchar(45)  NOT NULL default '',
  `call_logged_priority`        varchar(45)  NOT NULL default '',
  PRIMARY KEY  (`call_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_attachment`;
CREATE TABLE `call_attachment` (
  `call_attachment_id`          int(10) unsigned NOT NULL auto_increment,
  `call_attachment_callid`      int(10) unsigned NOT NULL default '0',
  `call_attachment_filename`    varchar(200) NOT NULL default '',
  `call_attachment_blob`        blob,
  PRIMARY KEY  (`call_attachment_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_comment`;
CREATE TABLE `call_comment` (
  `call_comment_id`         int(10) unsigned NOT NULL auto_increment,
  `call_comment`            varchar(200) NOT NULL default '',
  `call_comment_by`         varchar(100) NOT NULL default '',
  `call_id`                 varchar(45)  NOT NULL default '',
  `call_comment_timestamp`  datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY   (`call_comment_id`),
  KEY `id`      (`call_comment_id`,`call_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_company`;
CREATE TABLE `call_company` (
  `call_company_id`                 int(10) unsigned NOT NULL auto_increment,
  `call_company_name`               varchar(80) NOT NULL default '',
  `call_company_short_name`         varchar(45) NOT NULL default '',
  `call_company_support_levelid`    int(10) unsigned NOT NULL default '0',
  `call_company_locationid`         int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`call_company_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_department`;
CREATE TABLE `call_department` (
  `call_department_id`              int(10) unsigned NOT NULL auto_increment,
  `call_department_name`            varchar(80) NOT NULL default '',
  `call_department_companyid`       int(10) unsigned NOT NULL default '0',
  `call_department_support_levelid` int(10) unsigned NOT NULL default '0',
  `call_department_locationid`      int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`call_department_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_location`;
CREATE TABLE `call_location` (
  `call_location_id`        int(10) unsigned NOT NULL auto_increment,
  `call_location_name`      varchar(45) NOT NULL default '',
  `call_location_address`   varchar(80) NOT NULL default '',
  `call_location_suburb`    varchar(45) NOT NULL default '',
  `call_location_city`      varchar(45) NOT NULL default '',
  `call_location_state`     varchar(45) NOT NULL default '',
  `call_location_postcode`  varchar(45) NOT NULL default '',
  PRIMARY KEY  (`call_location_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_log`;
CREATE TABLE `call_log` (
  `call_log_id`             int(10) unsigned NOT NULL auto_increment,
  `call_log_callid`         int(10) unsigned NOT NULL default '0',
  `call_log_attachmentid`   int(10) unsigned NOT NULL default '0',
  `call_log_time_spent`     int(10) unsigned NOT NULL default '0',
  `call_log_systemid`       varchar(17)  NOT NULL default '',
  `call_log_person`         varchar(45)  NOT NULL default '',
  `call_log_comment`        varchar(250) NOT NULL default '',
  `call_log_date`           datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`call_log_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_priority`;
CREATE TABLE `call_priority` (
  `call_priority_id`            int(10) unsigned NOT NULL auto_increment,
  `call_priority_name`          varchar(45) NOT NULL default '',
  `call_priority_colour`        varchar(45) NOT NULL default '',
  `call_priority_font_colour`   varchar(45) NOT NULL default '',
  `call_priority`               int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`call_priority_id`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `call_status`;
CREATE TABLE `call_status` (
  `call_status_id`          int(10) unsigned NOT NULL auto_increment,
  `call_status_name`        varchar(45) NOT NULL default '',
  `call_status_colour`      varchar(45) NOT NULL default '',
  PRIMARY KEY  (`call_status_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_support_level`;
CREATE TABLE `call_support_level` (
  `call_support_level_id`               int(10) unsigned NOT NULL auto_increment,
  `call_support_level_name`             varchar(45) NOT NULL default '',
  `call_support_level_hours_warning`    int(10) unsigned NOT NULL default '0',
  `call_support_level_days_warning`     int(10) unsigned NOT NULL default '0',
  `call_support_level_hours_due`        int(10) unsigned NOT NULL default '0',
  `call_support_level_days_due`         int(10) unsigned NOT NULL default '0',
  `call_support_level_hours_overdue`    int(10) unsigned NOT NULL default '0',
  `call_support_level_days_overdue`     int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`call_support_level_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_technician`;
CREATE TABLE `call_technician` (
  `call_tech_id`            int(10) unsigned NOT NULL auto_increment,
  `call_tech_first_name`    varchar(45)  NOT NULL default '',
  `call_tech_surname`       varchar(45)  NOT NULL default '',
  `call_tech_company`       varchar(60)  NOT NULL default '',
  `call_tech_department`    varchar(45)  NOT NULL default '',
  `call_tech_location`      varchar(45)  NOT NULL default '',
  `call_tech_password`      varchar(45)  NOT NULL default '',
  `call_tech_level`         varchar(45)  NOT NULL default '',
  `call_tech_ad_name`       varchar(100) default NULL,
  PRIMARY KEY  (`call_tech_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `call_user`;
CREATE TABLE `call_user` (
  `call_user_id`            int(10) unsigned NOT NULL auto_increment,
  `call_user_first_name`    varchar(45)  NOT NULL default '',
  `call_user_surname`       varchar(45)  NOT NULL default '',
  `call_user_company`       varchar(60)  NOT NULL default '',
  `call_user_department`    varchar(45)  NOT NULL default '',
  `call_user_location`      varchar(45)  NOT NULL default '',
  `call_user_password`      varchar(45)  NOT NULL default '',
  `call_user_level`         varchar(45)  NOT NULL default '',
  `call_user_ad_name`       varchar(100) NOT NULL default '',
  PRIMARY KEY  (`call_user_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `config_name`         varchar(45) NOT NULL default '',
  `config_value`        varchar(45) NOT NULL default '',
  PRIMARY KEY  (`config_name`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `firewall_auth_app`;
CREATE TABLE `firewall_auth_app` (
  `firewall_app_id`                 int(10) unsigned NOT NULL auto_increment,
  `firewall_app_uuid`               varchar(100) NOT NULL default '',
  `firewall_app_name`               varchar(100) NOT NULL default '',
  `firewall_app_executable`         varchar(200) NOT NULL default '',
  `firewall_app_remote_address`     varchar(45)  NOT NULL default '',
  `firewall_app_enabled`            varchar(45)  NOT NULL default '',
  `firewall_app_profile`            varchar(45)  NOT NULL default '',
  `firewall_app_timestamp`          bigint(20) unsigned NOT NULL default '0',
  `firewall_app_first_timestamp`    bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`firewall_app_id`),
  KEY `id`      (`firewall_app_uuid`),
  KEY `id2`     (`firewall_app_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `firewall_ports`;
CREATE TABLE `firewall_ports` (
  `port_id`                 int(10) unsigned NOT NULL auto_increment,
  `port_uuid`               varchar(100) NOT NULL default '',
  `port_number`             int(10) unsigned NOT NULL default '0',
  `port_protocol`           varchar(45)  NOT NULL default '',
  `port_scope`              varchar(45)  NOT NULL default '',
  `port_enabled`            varchar(45)  NOT NULL default '',
  `port_profile`            varchar(45)  NOT NULL default '',
  `port_timestamp`          bigint(20) unsigned NOT NULL default '0',
  `port_first_timestamp`    bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`port_id`),
  KEY `id`      (`port_uuid`),
  KEY `id2`     (`port_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `firewire`;
CREATE TABLE `firewire` (
  `fw_id`               int(10) unsigned NOT NULL auto_increment,
  `fw_uuid`             varchar(100) NOT NULL default '',
  `fx_description`      varchar(200) NOT NULL default '',
  `fw_manufacturer`     varchar(100) NOT NULL default '',
  `fw_caption`          varchar(200) NOT NULL default '',
  `fw_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `fw_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`fw_id`),
  KEY `id`      (`fw_uuid`),
  KEY `id2`     (`fw_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `floppy`;
CREATE TABLE `floppy` (
  `floppy_id`               int(10) unsigned NOT NULL auto_increment,
  `floppy_uuid`             varchar(100) NOT NULL default '',
  `floppy_description`      varchar(100) NOT NULL default '',
  `floppy_device_id`        varchar(100) NOT NULL default '',
  `floppy_manufacturer`     varchar(100) NOT NULL default '',
  `floppy_caption`          varchar(100) NOT NULL default '',
  `floppy_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `floppy_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`floppy_id`),
  KEY `id`      (`floppy_uuid`),
  KEY `id2`     (`floppy_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `graphs_disk`;
CREATE TABLE `graphs_disk` (
  `disk_id`         int(10) unsigned NOT NULL auto_increment,
  `disk_uuid`       varchar(100) NOT NULL default '',
  `disk_timestamp`  timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `disk_letter`     varchar(4) NOT NULL default '',
  `disk_percent`    varchar(3) NOT NULL default '',
  PRIMARY KEY   (`disk_id`),
  KEY `id`      (`disk_uuid`),
  KEY `id2`     (`disk_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `group_members`;
CREATE TABLE `group_members` (
  `group_id`        int(10) unsigned NOT NULL auto_increment,
  `group_uuid`      varchar(100) NOT NULL default '',
  `group_names_id`  int(11) unsigned NOT NULL default '0',
  PRIMARY KEY   (`group_id`),
  KEY `id`      (`group_uuid`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `group_names`;
CREATE TABLE `group_names` (
  `group_id`    int(10) unsigned NOT NULL auto_increment,
  `group_name`  varchar(60)  NOT NULL default '',
  `group_desc`  varchar(200) NOT NULL default '',
  PRIMARY KEY           (`group_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `groups_id`               int(10) unsigned NOT NULL auto_increment,
  `groups_uuid`             varchar(100) NOT NULL default '',
  `groups_description`      varchar(200) NOT NULL default '',
  `groups_name`             varchar(100) NOT NULL default '',
  `groups_members`          varchar(100) NOT NULL default '',
  `groups_sid`              varchar(100) NOT NULL default '',
  `groups_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `groups_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`groups_id`),
  KEY `id`      (`groups_uuid`),
  KEY `id2`     (`groups_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `groups_details`;
CREATE TABLE `groups_details` (
  `gd_name`         varchar(100) NOT NULL default '',
  `gd_description`  varchar(200) NOT NULL default '',
  PRIMARY KEY  (`gd_name`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `hard_drive`;
CREATE TABLE `hard_drive` (
  `hard_drive_id`                   int(10) unsigned NOT NULL auto_increment,
  `hard_drive_uuid`                 varchar(100) NOT NULL default '',
  `hard_drive_caption`              varchar(100) NOT NULL default '',
  `hard_drive_index`                int(11) unsigned NOT NULL default '0',
  `hard_drive_interface_type`       varchar(10)  NOT NULL default '',
  `hard_drive_manufacturer`         varchar(100) NOT NULL default '',
  `hard_drive_model`                varchar(100) NOT NULL default '',
  `hard_drive_partitions`           int(11) unsigned NOT NULL default '0',
  `hard_drive_scsi_bus`             varchar(10)  NOT NULL default '',
  `hard_drive_scsi_logical_unit`    varchar(100) NOT NULL default '',
  `hard_drive_scsi_port`            varchar(10)  NOT NULL default '',
  `hard_drive_size`                 int(11) unsigned NOT NULL default '0',
  `hard_drive_timestamp`            bigint(20) unsigned NOT NULL default '0',
  `hard_drive_first_timestamp`      bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`hard_drive_id`),
  KEY `id`      (`hard_drive_uuid`),
  KEY `id2`     (`hard_drive_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `hotfix`;
CREATE TABLE `hotfix` (
  `hotfix_id`                       int(10) unsigned NOT NULL auto_increment,
  `hotfix_uuid`                     varchar(100) NOT NULL default '',
  `hotfix_description`              varchar(200) NOT NULL default '',
  `hotfix_hot_fix_id`               varchar(50) NOT NULL default '',
  `hotfix_installed_by`             varchar(100) NOT NULL default '',
  `hotfix_service_pack_in_effect`   varchar(10) NOT NULL default '',
  `hotfix_timestamp`                bigint(20) unsigned NOT NULL default '0',
  `hotfix_first_timestamp`          bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`hotfix_id`),
  KEY `id`      (`hotfix_uuid`),
  KEY `id2`     (`hotfix_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `iis`;
CREATE TABLE `iis` (
  `iis_id`                  int(10) unsigned NOT NULL auto_increment,
  `iis_uuid`                varchar(100) NOT NULL default '',
  `iis_site`                int(10) unsigned NOT NULL default '0',
  `iis_description`         varchar(100) NOT NULL default '',
  `iis_logging_enabled`     varchar(100) NOT NULL default '',
  `iis_logging_dir`         varchar(100) NOT NULL default '',
  `iis_logging_format`      varchar(100) NOT NULL default '',
  `iis_logging_time_period` varchar(100) NOT NULL default '',
  `iis_home_directory`      varchar(100) NOT NULL default '',
  `iis_directory_browsing`  varchar(100) NOT NULL default '',
  `iis_default_documents`   varchar(100) NOT NULL default '',
  `iis_secure_ip`           varchar(100) NOT NULL default '',
  `iis_secure_port`         varchar(100) NOT NULL default '',
  `iis_timestamp`           bigint(20) unsigned NOT NULL default '0',
  `iis_first_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`iis_id`),
  KEY `id`      (`iis_uuid`),
  KEY `id2`     (`iis_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `iis_ip`;
CREATE TABLE `iis_ip` (
  `iis_ip_id`               int(10) unsigned NOT NULL auto_increment,
  `iis_ip_uuid`             varchar(100) NOT NULL default '',
  `iis_ip_site`             varchar(100) NOT NULL default '',
  `iis_ip_ip_address`       varchar(100) NOT NULL default '',
  `iis_ip_port`             varchar(100) NOT NULL default '',
  `iis_ip_host_header`      varchar(100) NOT NULL default '',
  `iis_ip_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `iis_ip_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`iis_ip_id`),
  KEY `id`      (`iis_ip_uuid`),
  KEY `id2`     (`iis_ip_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `iis_vd`;
CREATE TABLE `iis_vd` (
  `iis_vd_id`               int(10) unsigned NOT NULL auto_increment,
  `iis_vd_uuid`             varchar(100) NOT NULL default '',
  `iis_vd_site`             varchar(100) NOT NULL default '',
  `iis_vd_name`             varchar(100) NOT NULL default '',
  `iis_vd_path`             varchar(100) NOT NULL default '',
  `iis_vd_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `iis_vd_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`iis_vd_id`),
  KEY `id`      (`iis_vd_uuid`),
  KEY `id2`     (`iis_vd_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id`          int(10) unsigned NOT NULL auto_increment,
  `invoice_uuid`        varchar(100) NOT NULL default '',
  `invoice_filename`    varchar(100) NOT NULL default '',
  `invoice_image`       blob,
  PRIMARY KEY   (`invoice_id`),
  KEY `id`      (`invoice_uuid`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `keyboard`;
CREATE TABLE `keyboard` (
  `keyboard_id`                 int(10) unsigned NOT NULL auto_increment,
  `keyboard_uuid`               varchar(100) NOT NULL default '',
  `keyboard_description`        varchar(100) NOT NULL default '',
  `keyboard_caption`            varchar(100) NOT NULL default '',
  `keyboard_connection`         varchar(45) NOT NULL default '',
  `keyboard_timestamp`          bigint(20) unsigned NOT NULL default '0',
  `keyboard_first_timestamp`    bigint(20) unsigned NOT NULL default '0',
  `keyboard_device_id`          varchar(100) NOT NULL default '',
  PRIMARY KEY   (`keyboard_id`),
  KEY `id`      (`keyboard_uuid`),
  KEY `id2`     (`keyboard_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `manual_software`;
CREATE TABLE `manual_software` (
  `man_soft_id`                     int(10) unsigned NOT NULL auto_increment,
  `man_soft_det_id`                 int(10) unsigned NOT NULL default '0',
  `man_soft_version`                varchar(45)  NOT NULL default '',
  `man_soft_uuid`                   varchar(100) NOT NULL default '',
  `man_soft_filesize`               int(10) unsigned NOT NULL default '0',
  `man_soft_date_detected`          date NOT NULL default '0000-00-00',
  `man_soft_date_first_detected`    date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`man_soft_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `manual_software_detection`;
CREATE TABLE `manual_software_detection` (
  `man_soft_det_id`         int(10) unsigned NOT NULL auto_increment,
  `man_soft_det_dir`        varchar(45) NOT NULL default '',
  `man_soft_det_file`       varchar(45) NOT NULL default '',
  `man_soft_det_name`       varchar(45) NOT NULL default '',
  `man_soft_det_comments`   varchar(45) NOT NULL default '',
  PRIMARY KEY  (`man_soft_det_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `mapped`;
CREATE TABLE `mapped` (
  `mapped_id`               int(10) unsigned NOT NULL auto_increment,
  `mapped_uuid`             varchar(100) NOT NULL default '',
  `mapped_device_id`        varchar(100) NOT NULL default '',
  `mapped_file_system`      varchar(100) NOT NULL default '',
  `mapped_provider_name`    varchar(100) NOT NULL default '',
  `mapped_free_space`       int(10) unsigned NOT NULL default '0',
  `mapped_size`             int(11) unsigned NOT NULL default '0',
  `mapped_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `mapped_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`mapped_id`),
  KEY `id`      (`mapped_uuid`),
  KEY `id2`     (`mapped_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `media_id`        int(10) unsigned NOT NULL auto_increment,
  `media_uuid`      varchar(100) NOT NULL default '',
  `media_type`      varchar(45)  NOT NULL default '',
  `media_file`      varchar(250) NOT NULL default '',
  `media_size`      int(10) unsigned NOT NULL default '0',
  `media_timestamp` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`media_id`),
  KEY `id`      (`media_uuid`),
  KEY `id2`     (`media_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `memory`;
CREATE TABLE `memory` (
  `memory_id`               int(10) unsigned NOT NULL auto_increment,
  `memory_uuid`             varchar(100) NOT NULL default '',
  `memory_bank`             varchar(45)  NOT NULL default '',
  `memory_type`             varchar(45)  NOT NULL default '',
  `memory_form_factor`      varchar(45)  NOT NULL default '',
  `memory_detail`           varchar(45)  NOT NULL default '',
  `memory_capacity`         varchar(45)  NOT NULL default '',
  `memory_speed`            varchar(45)  NOT NULL default '',
  `memory_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `memory_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`memory_id`),
  KEY `id`      (`memory_uuid`),
  KEY `id2`     (`memory_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `modem`;
CREATE TABLE `modem` (
  `modem_id`                int(10) unsigned NOT NULL auto_increment,
  `modem_uuid`              varchar(100) NOT NULL default '',
  `modem_attached_to`       varchar(100) NOT NULL default '',
  `modem_country_selected`  varchar(100) NOT NULL default '',
  `modem_description`       varchar(100) NOT NULL default '',
  `modem_device_id`         varchar(100) NOT NULL default '',
  `modem_device_type`       varchar(100) NOT NULL default '',
  `modem_timestamp`         bigint(20) unsigned NOT NULL default '0',
  `modem_first_timestamp`   bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`modem_id`),
  KEY `id`      (`modem_uuid`),
  KEY `id2`     (`modem_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `monitor`;
CREATE TABLE `monitor` (
  `monitor_id`                  int(10) unsigned NOT NULL auto_increment,
  `monitor_uuid`                varchar(100) NOT NULL default '',
  `monitor_manufacturer`        varchar(45)  NOT NULL default '',
  `monitor_deviceid`            varchar(45)  NOT NULL default '',
  `monitor_manufacture_date`    varchar(45)  NOT NULL default '',
  `monitor_model`               varchar(45)  NOT NULL default '',
  `monitor_serial`              varchar(45)  NOT NULL default '',
  `monitor_edid`                varchar(45)  NOT NULL default '',
  `monitor_timestamp`           bigint(20) unsigned NOT NULL default '0',
  `monitor_first_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`monitor_id`),
  KEY `id`      (`monitor_uuid`),
  KEY `id2`     (`monitor_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `mouse`;
CREATE TABLE `mouse` (
  `mouse_id`                int(10) unsigned NOT NULL auto_increment,
  `mouse_uuid`              varchar(100) NOT NULL default '',
  `mouse_description`       varchar(100) NOT NULL default '',
  `mouse_number_of_buttons` varchar(45)  NOT NULL default '',
  `mouse_device_id`         varchar(100) NOT NULL default '',
  `mouse_type`              varchar(45)  NOT NULL default '',
  `mouse_port`              varchar(45)  NOT NULL default '',
  `mouse_timestamp`         bigint(20) unsigned NOT NULL default '0',
  `mouse_first_timestamp`   bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`mouse_id`),
  KEY `id`      (`mouse_uuid`),
  KEY `id2`     (`mouse_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `ms_keys`;
CREATE TABLE `ms_keys` (
  `ms_keys_id`              int(10) unsigned NOT NULL auto_increment,
  `ms_keys_uuid`            varchar(100) NOT NULL default '',
  `ms_keys_name`            varchar(80)  NOT NULL default '',
  `ms_keys_cd_key`          varchar(45)  NOT NULL default '',
  `ms_keys_release`         varchar(45)  NOT NULL default '',
  `ms_keys_edition`         varchar(45)  NOT NULL default '',
  `ms_keys_key_type`        varchar(45)  NOT NULL default '',
  `ms_keys_timestamp`       bigint(20) unsigned NOT NULL default '0',
  `ms_keys_first_timestamp` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`ms_keys_id`),
  KEY `id`      (`ms_keys_uuid`),
  KEY `id2`     (`ms_keys_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `network_card`;
CREATE TABLE `network_card` (
  `net_id`              int(10) unsigned NOT NULL auto_increment,
  `net_mac_address`     varchar(17)  NOT NULL default '',
  `net_uuid`            varchar(100) NOT NULL default '',
  `net_description`     varchar(100) NOT NULL default '',
  `net_dhcp_enabled`    varchar(100) NOT NULL default '',
  `net_dhcp_server`     varchar(30)  NOT NULL default '',
  `net_dns_host_name`   varchar(100) NOT NULL default '',
  `net_dns_server`      varchar(30)  NOT NULL default '',
  `net_dns_server_2`    varchar(30)  NOT NULL default '',
  `net_ip_address`      varchar(30)  NOT NULL default '',
  `net_ip_subnet`       varchar(30)  NOT NULL default '',
  `net_wins_primary`    varchar(30)  NOT NULL default '',
  `net_wins_secondary`  varchar(30)  NOT NULL default '',
  `net_adapter_type`    varchar(100) NOT NULL default '',
  `net_manufacturer`    varchar(100) NOT NULL default '',
  `net_timestamp`       bigint(20) unsigned NOT NULL default '0',
  `net_first_timestamp` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`net_id`),
  KEY `id`      (`net_mac_address`),
  KEY `id2`     (`net_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `nmap_other_ports`;
CREATE TABLE `nmap_other_ports` (
  `nmap_id`             int(10) unsigned NOT NULL auto_increment,
  `nmap_port_number`    int(10) unsigned NOT NULL default '0',
  `nmap_other_id`       varchar(100) NOT NULL default '',
  `nmap_port_name`      varchar(45)  NOT NULL default '',
  `nmap_date_detected`  datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY   (`nmap_id`),
  KEY `id`      (`nmap_other_id`),
  KEY `id2`     (`nmap_port_number`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `nmap_system_ports`;
CREATE TABLE `nmap_system_ports` (
  `nmap_system_id`              int(10) unsigned NOT NULL auto_increment,
  `nmap_system_port_number`     int(10) unsigned NOT NULL default '0',
  `nmap_system_mac`             varchar(100) NOT NULL default '',
  `nmap_system_port_name`       varchar(45)  NOT NULL default '',
  `nmap_system_date_detected`   date NOT NULL default '0000-00-00',
  PRIMARY KEY   (`nmap_system_id`),
  KEY `id`      (`nmap_system_mac`),
  KEY `id2`     (`nmap_system_port_number`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `notes_id`        int(10) unsigned NOT NULL auto_increment,
  `notes_uuid`      varchar(100) NOT NULL default '',
  `notes_notes`     varchar(200) NOT NULL default '',
  PRIMARY KEY   (`notes_id`),
  KEY `id`      (`notes_uuid`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `optical_drive`;
CREATE TABLE `optical_drive` (
  `optical_drive_id`                int(10) unsigned NOT NULL auto_increment,
  `optical_drive_uuid`              varchar(100) NOT NULL default '',
  `optical_drive_caption`           varchar(100) NOT NULL default '',
  `optical_drive_device_id`         varchar(100) NOT NULL default '',
  `optical_drive_drive`             varchar(10)  NOT NULL default '',
  `optical_drive_timestamp`         bigint(20) unsigned NOT NULL default '0',
  `optical_drive_first_timestamp`   bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`optical_drive_id`),
  KEY `id`      (`optical_drive_uuid`),
  KEY `id2`     (`optical_drive_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `other`;
CREATE TABLE `other` (
  `other_id`                        int(10) unsigned NOT NULL auto_increment,
  `other_name`                      varchar(200) NOT NULL default '',
  `other_ip`                        varchar(30)  NOT NULL default '',
  `other_mac_address`               varchar(17)  NOT NULL default '',
  `other_description`               varchar(100) NOT NULL default '',
  `other_serial`                    varchar(50)  NOT NULL default '',
  `other_model`                     varchar(50)  NOT NULL default '',
  `other_type`                      varchar(50)  NOT NULL default '',
  `other_location`                  varchar(100) NOT NULL default '',
  `other_value`                     varchar(30)  NOT NULL default '',
  `other_linked_pc`                 varchar(100) NOT NULL default '',
  `other_manufacturer`              varchar(50)  NOT NULL default '',
  `other_date_purchase`             date NOT NULL default '0000-00-00',
  `other_date_detected`             date NOT NULL default '0000-00-00',
  `other_purchase_order_number`     varchar(45)  NOT NULL default '',
  PRIMARY KEY    (`other_id`),
  KEY `id`       (`other_name`),
  KEY `id2`      (`other_type`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `partition`;
CREATE TABLE `partition` (
  `partition_id`                    int(10) unsigned NOT NULL auto_increment,
  `partition_uuid`                  varchar(100) NOT NULL default '',
  `partition_bootable`              varchar(10)  NOT NULL default '',
  `partition_boot_partition`        varchar(10)  NOT NULL default '',
  `partition_device_id`             varchar(100) NOT NULL default '',
  `partition_disk_index`            varchar(50)  NOT NULL default '',
  `partition_index`                 varchar(100) NOT NULL default '',
  `partition_primary_partition`     varchar(10)  NOT NULL default '',
  `partition_caption`               varchar(100) NOT NULL default '',
  `partition_file_system`           varchar(20)  NOT NULL default '',
  `partition_volume_name`           varchar(100) NOT NULL default '',
  `partition_free_space`            int(11)    unsigned NOT NULL default '1',
  `partition_size`                  int(11)    unsigned NOT NULL default '1',
  `partition_timestamp`             bigint(20) unsigned NOT NULL default '0',
  `partition_first_timestamp`       bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`partition_id`),
  KEY `id`      (`partition_uuid`),
  KEY `id2`     (`partition_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `passwords`;
CREATE TABLE `passwords` (
  `passwords_id`            int(10) unsigned NOT NULL auto_increment,
  `passwords_uuid`          varchar(100) NOT NULL default '',
  `passwords_application`   varchar(100) NOT NULL default '',
  `passwords_password`      varchar(100) NOT NULL default '',
  `passwords_user`          varchar(100) NOT NULL default '',
  PRIMARY KEY   (`passwords_id`),
  KEY `id`      (`passwords_uuid`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `printer`;
CREATE TABLE `printer` (
  `printer_id`                      int(10) unsigned NOT NULL auto_increment,
  `printer_uuid`                    varchar(100) NOT NULL default '',
  `printer_caption`                 varchar(50)  NOT NULL default '',
  `printer_port_name`               varchar(30)  NOT NULL default '',
  `printer_shared`                  varchar(10)  NOT NULL default '',
  `printer_share_name`              varchar(100) NOT NULL default '',
  `printer_system_name`             varchar(45)  NOT NULL default '',
  `printer_location`                varchar(45)  NOT NULL default '',
  `printer_mac_address`             varchar(17)  NOT NULL default '',
  `printer_ip`                      varchar(45)  NOT NULL default '',
  `printer_name`                    varchar(45)  NOT NULL default '',
  `printer_description`             varchar(100) NOT NULL default '',
  `printer_serial`                  varchar(100) NOT NULL default '',
  `printer_model`                   varchar(100) NOT NULL default '',
  `printer_value`                   varchar(45)  NOT NULL default '',
  `printer_manufacturer`            varchar(45)  NOT NULL default '',
  `printer_purchase_order_number`   varchar(45)  NOT NULL default '',
  `printer_date_purchased`          date NOT NULL default '0000-00-00',
  `printer_timestamp`               bigint(20) unsigned NOT NULL default '0',
  `printer_first_timestamp`         bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`printer_id`),
  KEY `id`      (`printer_uuid`),
  KEY `id2`     (`printer_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `processor`;
CREATE TABLE `processor` (
  `processor_id`                            int(10) unsigned NOT NULL auto_increment,
  `processor_uuid`                          varchar(100) NOT NULL default '',
  `processor_caption`                       varchar(100) NOT NULL default '',
  `processor_device_id`                     varchar(100) NOT NULL default '',
  `processor_manufacturer`                  varchar(100) NOT NULL default '',
  `processor_name`                          varchar(100) NOT NULL default '',
  `processor_power_management_supported`    varchar(20)  NOT NULL default '',
  `processor_socket_designation`            varchar(50)  NOT NULL default '',
  `processor_current_clock_speed`           int(11)   unsigned NOT NULL default '0',
  `processor_current_voltage`               int(11)   unsigned NOT NULL default '0',
  `processor_ext_clock`                     int(11)   unsigned NOT NULL default '0',
  `processor_max_clock_speed`               int(11)   unsigned NOT NULL default '0',
  `processor_timestamp`                     bigint(20) unsigned NOT NULL default '0',
  `processor_first_timestamp`               bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`processor_id`),
  KEY `id`      (`processor_uuid`),
  KEY `id2`     (`processor_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `service_id`              int(10) unsigned NOT NULL auto_increment,
  `service_uuid`            varchar(100) NOT NULL default '',
  `service_display_name`    varchar(100) NOT NULL default '',
  `service_name`            varchar(100) NOT NULL default '',
  `service_path_name`       varchar(200) NOT NULL default '',
  `service_started`         varchar(10)  NOT NULL default '',
  `service_start_mode`      varchar(10)  NOT NULL default '',
  `service_state`           varchar(10)  NOT NULL default '',
  `service_count`           varchar(5)   NOT NULL default '',
  `service_timestamp`       bigint(20) unsigned NOT NULL default '0',
  `service_first_timestamp` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`service_id`),
  KEY `id`      (`service_uuid`),
  KEY `id2`     (`service_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `service_details`;
CREATE TABLE `service_details` (
  `sd_display_name`     varchar(100) NOT NULL default '',
  `sd_description`      varchar(200) NOT NULL default '',
  PRIMARY KEY  (`sd_display_name`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `shares`;
CREATE TABLE `shares` (
  `shares_id`               int(10) unsigned NOT NULL auto_increment,
  `shares_uuid`             varchar(100) NOT NULL default '',
  `shares_caption`          varchar(100) NOT NULL default '',
  `shares_name`             varchar(100) NOT NULL default '',
  `shares_path`             varchar(100) NOT NULL default '',
  `shares_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `shares_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`shares_id`),
  KEY `id`      (`shares_uuid`),
  KEY `id2`     (`shares_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `software_id`                 int(10) unsigned NOT NULL auto_increment,
  `software_uuid`               varchar(100) NOT NULL default '',
  `software_name`               varchar(100) NOT NULL default '',
  `software_version`            varchar(50)  NOT NULL default '',
  `software_location`           varchar(200) NOT NULL default '',
  `software_uninstall`          varchar(200) NOT NULL default '',
  `software_install_date`       varchar(20)  NOT NULL default '',
  `software_publisher`          varchar(100) NOT NULL default '',
  `software_install_source`     varchar(200) NOT NULL default '',
  `software_system_component`   varchar(2)   NOT NULL default '',
  `software_url`                varchar(100) NOT NULL default '',
  `software_comment`            varchar(200) NOT NULL default '',
  `software_count`              varchar(5)   NOT NULL default '',
  `software_timestamp`          bigint(20) unsigned NOT NULL default '0',
  `software_first_timestamp`    bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`software_id`),
  KEY `id`      (`software_uuid`),
  KEY `id2`     (`software_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `software_group_members`;
CREATE TABLE `software_group_members` (
  `group_id`                int(10) unsigned NOT NULL default '0',
  `group_software_title`    varchar(250) NOT NULL default '',
  UNIQUE KEY `group_id`     (`group_id`,`group_software_title`),
  KEY `group_software_title` (`group_software_title`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `software_group_names`;
CREATE TABLE `software_group_names` (
  `group_id`    int(10) unsigned NOT NULL auto_increment,
  `group_name`  varchar(200) NOT NULL default '',
  `group_desc`  varchar(200) NOT NULL default '',
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `software_licenses`;
CREATE TABLE `software_licenses` (
  `license_id`                  int(10) unsigned NOT NULL auto_increment,
  `license_software_id`         int(10) unsigned NOT NULL default '0',
  `license_purchase_cost_each`  int(10) unsigned NOT NULL default '0',
  `license_purchase_number`     int(10) unsigned NOT NULL default '0',
  `license_purchase_date`       datetime NOT NULL default '0000-00-00 00:00:00',
  `license_mac_address`         varchar(100) NOT NULL default '',
  `license_purchase_vendor`     varchar(150) NOT NULL default '',
  `license_comments`            varchar(200) NOT NULL default '',
  `license_purchase_type`       varchar(50)  NOT NULL default '',
  `license_order_number`        varchar(50)  NOT NULL default '',
  PRIMARY KEY  (`license_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `software_register`;
CREATE TABLE `software_register` (
  `software_reg_id`     int(10) unsigned NOT NULL auto_increment,
  `group_id`            int(10) unsigned NOT NULL default '0',
  `software_title`      varchar(100) NOT NULL default '',
  `software_comments`   varchar(200) NOT NULL default '',
  PRIMARY KEY  (`software_reg_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `software_temp`;
CREATE TABLE `software_temp` (
  `software_name`           varchar(100) NOT NULL default '',
  `software_uuid`           varchar(100) NOT NULL default '',
  `software_timestamp`      bigint(20) unsigned NOT NULL default '0',
  `software_version`        varchar(100) NOT NULL default '',
  KEY `id`  (`software_name`,`software_uuid`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `sound`;
CREATE TABLE `sound` (
  `sound_id`                int(10) unsigned NOT NULL auto_increment,
  `sound_uuid`              varchar(100) NOT NULL default '',
  `sound_manufacturer`      varchar(100) NOT NULL default '',
  `sound_device_id`         varchar(100) NOT NULL default '',
  `sound_name`              varchar(100) NOT NULL default '',
  `sound_timestamp`         bigint(20) unsigned NOT NULL default '0',
  `sound_first_timestamp`   bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`sound_id`),
  KEY `id`      (`sound_uuid`),
  KEY `id2`     (`sound_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `spare`;
CREATE TABLE `spare` (
  `spare_id`            int(10) unsigned NOT NULL auto_increment,
  `spare_uuid`          varchar(100) NOT NULL default '',
  `spare_field_1`       varchar(45)  NOT NULL default '',
  `spare_field_2`       varchar(100) NOT NULL default '',
  `spare_field_3`       varchar(200) NOT NULL default '',
  `spare_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`spare_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `startup`;
CREATE TABLE `startup` (
  `startup_id`                  int(10) unsigned NOT NULL auto_increment,
  `startup_uuid`                varchar(100) NOT NULL default '',
  `startup_caption`             varchar(200) NOT NULL default '',
  `startup_name`                varchar(100) NOT NULL default '',
  `startup_command`             varchar(200) NOT NULL default '',
  `startup_description`         varchar(200) NOT NULL default '',
  `startup_location`            varchar(200) NOT NULL default '',
  `startup_user`                varchar(100) NOT NULL default '',
  `startup_timestamp`           bigint(20) unsigned NOT NULL default '0',
  `startup_first_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`startup_id`),
  KEY `id`      (`startup_uuid`),
  KEY `id2`     (`startup_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system`;
CREATE TABLE `system` (
  `system_num_processors`                   int(11) unsigned NOT NULL default '0',
  `system_memory`                           int(11) unsigned NOT NULL default '0',
  `system_build_number`                     int(11) unsigned NOT NULL default '0',
  `net_ip_address`                          varchar(20)  NOT NULL default '',
  `system_uuid`                             varchar(100) NOT NULL default '',
  `net_domain`                              varchar(100) NOT NULL default '',
  `net_user_name`                           varchar(100) NOT NULL default '',
  `net_client_site_name`                    varchar(100) NOT NULL default '',
  `net_domain_controller_address`           varchar(100) NOT NULL default '',
  `net_domain_controller_name`              varchar(100) NOT NULL default '',
  `system_model`                            varchar(100) NOT NULL default '',
  `system_name`                             varchar(100) NOT NULL default '',
  `system_part_of_domain`                   varchar(10)  NOT NULL default '',
  `system_primary_owner_name`               varchar(100) NOT NULL default '',
  `system_system_type`                      varchar(100) NOT NULL default '',
  `system_id_number`                        varchar(100) NOT NULL default '',
  `system_vendor`                           varchar(100) NOT NULL default '',
  `time_caption`                            varchar(100) NOT NULL default '',
  `time_daylight`                           varchar(100) NOT NULL default '',
  `system_boot_device`                      varchar(100) NOT NULL default '',
  `system_os_type`                          varchar(50)  NOT NULL default '',
  `system_os_name`                          varchar(100) NOT NULL default '',
  `system_country_code`                     varchar(20)  NOT NULL default '',
  `system_description`                      varchar(50)  NOT NULL default '',
  `system_organisation`                     varchar(80)  NOT NULL default '',
  `system_language`                         varchar(50)  NOT NULL default '',
  `system_registered_user`                  varchar(50)  NOT NULL default '',
  `system_serial_number`                    varchar(50)  NOT NULL default '',
  `system_service_pack`                     varchar(20)  NOT NULL default '',
  `system_version`                          varchar(20)  NOT NULL default '',
  `system_windows_directory`                varchar(20)  NOT NULL default '',
  `audit_type`                              varchar(20)  NOT NULL default '',
  `firewall_enabled_domain`                 varchar(45)  NOT NULL default '',
  `firewall_disablenotifications_domain`    varchar(45)  NOT NULL default '',
  `firewall_donotallowexceptions_domain`    varchar(45)  NOT NULL default '',
  `net_domain_role`                         varchar(40)  NOT NULL default '',
  `firewall_enabled_standard`               varchar(45)  NOT NULL default '',
  `firewall_disablenotifications_standard`  varchar(45)  NOT NULL default '',
  `firewall_donotallowexceptions_standard`  varchar(45)  NOT NULL default '',
  `virus_manufacturer`                      varchar(150) NOT NULL default '',
  `virus_version`                           varchar(45)  NOT NULL default '',
  `virus_name`                              varchar(100) NOT NULL default '',
  `virus_uptodate`                          varchar(45)  NOT NULL default '',
  `date_virus_def`                          date NOT NULL default '0000-00-00',
  `date_system_install`                     date NOT NULL default '0000-00-00', 
  `system_timestamp`                        bigint(20) unsigned NOT NULL default '0',
  `system_first_timestamp`                  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`system_uuid`),
  KEY `id2`     (`system_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_audits`;
CREATE TABLE `system_audits` (
  `system_audits_id`            int(10) unsigned NOT NULL auto_increment,
  `system_audits_uuid`          varchar(100) NOT NULL default '',
  `system_audits_username`      varchar(45)  NOT NULL default '',
  `system_audits_time`          varchar(45)  NOT NULL default '',
  `system_audits_timestamp`     bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`system_audits_id`),
  KEY `Index_1` (`system_audits_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_change`;
CREATE TABLE `system_change` (
  `system_change_id`                    int(10) unsigned NOT NULL auto_increment,
  `system_change_date`                  datetime NOT NULL default '0000-00-00 00:00:00',
  `system_change_uuid`                  varchar(100) NOT NULL default '',
  `system_change_short_desc`            varchar(200) NOT NULL default '',
  `system_change_detailed_desc`         varchar(200) NOT NULL default '',
  `system_change_authorising_person`    varchar(45)  NOT NULL default '',
  `system_change_reason`                varchar(200) NOT NULL default '',
  `system_change_potential_issues`      varchar(200) NOT NULL default '',
  `system_change_backout_plan`          varchar(200) NOT NULL default '',
  `system_change_callid`                int(10) unsigned NOT NULL default '0',
  `system_change_call_techid`           int(10) unsigned NOT NULL default '0',
  `system_change_timestamp`             bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`system_change_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_change_log`;
CREATE TABLE `system_change_log` (
  `system_change_log_id`            int(10) unsigned NOT NULL auto_increment,
  `system_change_log_changeid`      int(10) unsigned NOT NULL default '0',
  `system_change_log_attachmentid`  int(10) unsigned NOT NULL default '0',
  `system_change_log_call_techid`   int(10) unsigned NOT NULL default '0',
  `system_change_log_date`          datetime NOT NULL default '0000-00-00 00:00:00',
  `system_change_log_comments`      varchar(200) NOT NULL default '',
  PRIMARY KEY  (`system_change_log_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_man`;
CREATE TABLE `system_man` (
  `system_man_id`                       int(10) unsigned NOT NULL auto_increment,
  `system_man_uuid`                     varchar(100) NOT NULL default '',
  `system_man_value`                    varchar(50)  NOT NULL default '',
  `system_man_description`              varchar(100) NOT NULL default '',
  `system_man_location`                 varchar(100) NOT NULL default '',
  `system_man_serial_number`            varchar(50)  NOT NULL default '',
  `system_man_vendor`                   varchar(150) NOT NULL default '',
  `system_man_purchase_order_number`    varchar(50)  NOT NULL default '',
  `system_man_invoice`                  varchar(100) NOT NULL default '',
  `system_man_ethernet_socket`          varchar(45)  NOT NULL default '',
  `system_man_phone_number`             varchar(45)  NOT NULL default '',
  `system_man_date_of_purchase`         date NOT NULL default '0000-00-00',
  `system_man_terminal_number`          int(10) unsigned NOT NULL default '0',
  PRIMARY KEY   (`system_man_id`),
  KEY `id`      (`system_man_uuid`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_security`;
CREATE TABLE `system_security` (
  `ss_id`       int(10) unsigned NOT NULL auto_increment,
  `ss_name`     varchar(45)  NOT NULL default '',
  `ss_qno`      varchar(45)  NOT NULL default '',
  `ss_status`   varchar(45)  NOT NULL default '',
  `ss_reason`   varchar(200) NOT NULL default '',
  `ss_product`  varchar(45)  NOT NULL default '',
  PRIMARY KEY  (`ss_id`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_security_bulletins`;
CREATE TABLE `system_security_bulletins` (
  `ssb_title`       varchar(200) NOT NULL default '',
  `ssb_description` varchar(250) NOT NULL default '',
  `ssb_bulletin`    varchar(45)  NOT NULL default '',
  `ssb_qno`         varchar(45)  NOT NULL default '',
  `ssb_url`         varchar(100) NOT NULL default '',
  PRIMARY KEY  (`ssb_qno`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `system_security_temp`;
CREATE TABLE `system_security_temp` (
  `count` int(11) unsigned NOT NULL default '0',
  `qno`   varchar(10) default NULL
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `tape_drive`;
CREATE TABLE `tape_drive` (
  `tape_drive_id`               int(10) unsigned NOT NULL auto_increment,
  `tape_drive_uuid`             varchar(100) NOT NULL default '',
  `tape_drive_caption`          varchar(100) NOT NULL default '',
  `tape_drive_description`      varchar(100) NOT NULL default '',
  `tape_drive_device_id`        varchar(100) NOT NULL default '',
  `tape_drive_manufacturer`     varchar(100) NOT NULL default '',
  `tape_drive_name`             varchar(100) NOT NULL default '',
  `tape_drive_timestamp`        bigint(20) unsigned NOT NULL default '0',
  `tape_drive_first_timestamp`  bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`tape_drive_id`),
  KEY `id`      (`tape_drive_uuid`),
  KEY `id2`     (`tape_drive_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `usb`;
CREATE TABLE `usb` (
  `usb_id`              int(10) unsigned NOT NULL auto_increment,
  `usb_uuid`            varchar(100) NOT NULL default '',
  `usb_caption`         varchar(100) NOT NULL default '',
  `usb_description`     varchar(100) NOT NULL default '',
  `usb_manufacturer`    varchar(100) NOT NULL default '',
  `usb_device_id`       varchar(120) NOT NULL default '',
  `usb_timestamp`       bigint(20) unsigned NOT NULL default '0',
  `usb_first_timestamp` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`usb_id`),
  KEY `id`      (`usb_uuid`),
  KEY `id2`     (`usb_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `users_id`                    int(10) unsigned NOT NULL auto_increment,
  `users_uuid`                  varchar(100) NOT NULL default '',
  `users_disabled`              varchar(20)  NOT NULL default '',
  `users_full_name`             varchar(100) NOT NULL default '',
  `users_name`                  varchar(100) NOT NULL default '',
  `users_password_changeable`   varchar(20)  NOT NULL default '',
  `users_password_expires`      varchar(20)  NOT NULL default '',
  `users_password_required`     varchar(20)  NOT NULL default '',
  `users_sid`                   varchar(100) NOT NULL default '',
  `users_timestamp`             bigint(20) unsigned NOT NULL default '0',
  `users_first_timestamp`       bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`users_id`),
  KEY `id`      (`users_uuid`),
  KEY `id2`     (`users_timestamp`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `users_detail`;
CREATE TABLE `users_detail` (
  `ud_name`             varchar(100) NOT NULL default '',
  `ud_description`      varchar(200) NOT NULL default '',
  PRIMARY KEY  (`ud_name`)
) ENGINE=MyISAM;



DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `video_id`                        int(10) unsigned NOT NULL auto_increment,
  `video_uuid`                      varchar(100) NOT NULL default '',
  `video_adapter_ram`               varchar(100) NOT NULL default '',
  `video_caption`                   varchar(100) NOT NULL default '',
  `video_current_horizontal_res`    varchar(20)  NOT NULL default '',
  `video_current_number_colours`    varchar(20)  NOT NULL default '',
  `video_current_refresh_rate`      varchar(20)  NOT NULL default '',
  `video_current_vertical_res`      varchar(20)  NOT NULL default '',
  `video_description`               varchar(100) NOT NULL default '',
  `video_device_id`                 varchar(100) NOT NULL default '',
  `video_driver_date`               varchar(20)  NOT NULL default '',
  `video_driver_version`            varchar(20)  NOT NULL default '',
  `video_max_refresh_rate`          varchar(20)  NOT NULL default '',
  `video_min_refresh_rate`          varchar(20)  NOT NULL default '',
  `video_timestamp`                 bigint(20) unsigned NOT NULL default '0',
  `video_first_timestamp`           bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY   (`video_id`),
  KEY `id`      (`video_uuid`),
  KEY `id2`     (`video_timestamp`)
) ENGINE=MyISAM;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;