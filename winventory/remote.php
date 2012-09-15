<?php
include "include_config.php";

// Connect the database
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

// IP address
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        $ipadr=$_SERVER["HTTP_X_FORWARDED_FOR"];
else
        $ipadr=$_SERVER["REMOTE_ADDR"];
$ip=explode('.',$ipadr);
$ip=substr('00'.$ip[0],strlen($ip[0])-1,3).".".substr('00'.$ip[1],strlen($ip[1])-1,3).".".
	substr('00'.$ip[2],strlen($ip[2])-1,3).".".substr('00'.$ip[3],strlen($ip[3])-1,3);

// MAC address

// arp request only valid in local network
//$arp=system("arp $ipadr | grep ether |cut -c34-50 ");

$sql="select net_mac_linked FROM network_card where net_ip_address='$ip'"; 
	//!!! net_mac_address empty => using net_mac_linked 
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$mac=$row[0];

// cleaning if requested for testing purpose (remote.php?clean=1)
if ($_GET['clean']=='1') {
	$sql="DELETE FROM network_card WHERE net_mac_linked='$mac'";
	mysql_query($sql);
	$sql="DELETE FROM system where net_mac_address='$mac'";
	mysql_query($sql);
	$sql="DELETE FROM other where other_linked_pc='$mac'";
	mysql_query($sql);
	$sql="DELETE FROM software where software_mac='$mac'";
	mysql_query($sql);
	die('Cleaned');
}
	
foreach($_POST as $parm => $val) {
	$_POST[$parm]=addslashes(trim($val));
}
	
$sql='';
switch($_POST['req']) {
	case 'network_card0':
		$sql="DELETE FROM network_card WHERE net_mac_linked='".$_POST['mac']."'";
		break;
	case 'network_card1' :
		$sql= "INSERT INTO network_card (net_mac_address, net_mac_linked, net_description, net_dhcp_enabled, net_dhcp_server, ".
  			"net_dns_host_name, net_dns_server, net_ip_address, net_ip_subnet,  ".
  			"net_wins_primary, net_wins_secondary, net_adapter_type, net_manufacturer) VALUES ('".
			$_POST['mac']."','".$_POST['mac_address']."','".$_POST['description']."','".
			$_POST['dhcp_enabled']."','".$_POST['dhcp_server']."','".$_POST['dns_host_name']."','".
			$_POST['dns_server']."','".$_POST['ip_address']."','".$_POST['ip_subnet']."','".
			$_POST['wins_primary']."','".$_POST['wins_secondary']."','".$_POST['adapter_type']."','".
			$_POST['manufacturer']."')";
		break;
	case 'system0' :
		$sql="INSERT IGNORE INTO system (net_mac_address, date_first_audited) VALUES ( '$mac', CURDATE()) ";
		break;
	case 'system1' :
		$sql="UPDATE system SET net_ip_address='".$_POST['ip_address']."',net_domain='".$_POST['domain'].
			"',net_user_name='".$_POST['user_name']."',net_client_site_name='".$_POST['client_site_name'].
			"',net_domain_controller_address='".$_POST['domain_controller_address'].
			"',net_domain_controller_name='".$_POST['domain_controller_name']."',audit_type='online'".
			" WHERE net_mac_address='$mac'";
		break;
	case 'system2' : 
		$sql="UPDATE system SET system_model='".$_POST['model'].
			"',system_name='".$_POST['name'].
			"',system_num_processors='".$_POST['num_processors'].
			"',system_part_of_domain='".$_POST['part_of_domain'].
			"',system_primary_owner_name='".$_POST['primary_owner_name'].
			"',system_system_type='".$_POST['system_type'].
			"',system_memory='".$_POST['memory'].
			"',system_id_number='".$_POST['id_number'].
			"',system_vendor='".$_POST['vendor'].
			"' WHERE net_mac_address='$mac'";
		break;
	case 'video' :
		$sql="DELETE FROM video WHERE video_mac_address='$mac'";
		mysql_query($sql);
		$sql="INSERT INTO video (video_mac_address, video_adapter_ram, ".
			"video_caption, video_current_horizontal_res, video_current_number_colours, ".
			"video_current_refresh_rate, video_current_vertical_res, video_description, ".
			"video_driver_date, video_driver_version, video_max_refresh_rate, ".
			"video_min_refresh_rate) VALUES ('$mac','".$_POST['adapter_ram'].
			"','".$_POST['caption']."','".$_POST['current_horizontal_res'].
			"','".$_POST['current_number_colours']."','".$_POST['current_refresh_rate'].
			"','".$_POST['current_vertical_res']."','".$_POST['description'].
			"','".$_POST['driver_date']."','".$_POST['driver_version'].
			"','".$_POST['max_refresh_rate']."','".$_POST['min_refresh_rate']."')";
		break;
	case 'monitor0' :
		$sql="DELETE FROM other WHERE other_type='monitor' AND other_linked_pc='$mac'";
		break;
	case 'monitor1' :
		$sql="UPDATE system SET monitor_manufacturer='".$_POST['manufacturer'].
			"',monitor_model='".$_POST['model']."',monitor_pixels_v='".$_POST['pixels_v'].
			"',monitor_pixels_h='".$_POST['pixels_h']."' WHERE net_mac_address='$mac'";
		break;
	case 'other1' :
		$sql="INSERT INTO other (other_linked_pc, other_name, other_description, other_model, ".
			"other_type, other_location, other_manufacturer) VALUES ('$mac','".
			$_POST['name']."','".$_POST['description']."','".$_POST['model']."','".
			$_POST['type']."','".$_POST['location']."','".$_POST['manufacturer']."')";
		break;
	case 'processor0' :
		$sql= "DELETE FROM processor WHERE processor_mac_address='$mac'";
		break;
	case 'processor1' :
		$sql="INSERT INTO processor ( processor_mac_address, processor_caption, ".
			"processor_current_clock_speed, processor_current_voltage, processor_device_id, ".
			"processor_ext_clock, processor_manufacturer, processor_max_clock_speed, ".
			"processor_name, processor_power_management_supported, ".
		        "processor_socket_designation) VALUES ('$mac','".
			$_POST['caption']."','".$_POST['current_clock_speed']."','".
			$_POST['current_voltage']."','".$_POST['device_id']."','".
			$_POST['ext_clock']."','".$_POST['manufacturer']."','".
			$_POST['max_clock_speed']."','".$_POST['name']."','".
			$_POST['power_management_supported']."','".$_POST['socket_designation']."')";
		break;
	case 'bios' :
		$sql="UPDATE system SET bios_description='".$_POST['description']."',".
	       		"bios_manufacturer='".$_POST['manufacturer']."',".
			"bios_serial_number='".$_POST['serial_number']."',".
  			"bios_sm_bios_version='".$_POST['sm_bios_version']."',".
   			"bios_version='".$_POST['version']."' WHERE net_mac_address='$mac'";
		break;
	case 'hard_drive0' :
		$sql="DELETE FROM hard_drive WHERE hard_drive_mac_address='$mac'";
		break;
	case 'hard_drive1' :
		$sql="INSERT INTO hard_drive ( hard_drive_mac_address, hard_drive_caption, hard_drive_index, ".
	       		"hard_drive_interface_type, hard_drive_manufacturer, hard_drive_model, ".
		        "hard_drive_partitions, hard_drive_scsi_bus, hard_drive_scsi_logical_unit, ".
		        "hard_drive_scsi_port, hard_drive_size) VALUES ('$mac','".
    			$_POST['caption']."','".$_POST['index']."','".$_POST['interface_type']."','".
			$_POST['manufacture']."','".$_POST['model']."','".$_POST['partitions']."','".
			$_POST['scsi_bus']."','".$_POST['scsi_logical_unit']."','".
			$_POST['scsi_port']."','".$_POST['size']."')";
		break;
	case 'partition0':
		$sql="DELETE FROM partition WHERE partition_mac_address='$mac'";
		break;
	case 'partition1':
		 $sql="INSERT INTO partition ( partition_mac_address, partition_bootable, partition_boot_partition, ".
			"partition_device_id, partition_disk_index, partition_index, partition_primary_partition, ".
			"partition_caption, partition_file_system, partition_free_space, partition_size, ". 
			"partition_volume_name) VALUES ('$mac','".
    			$_POST['bootable']."','".$_POST['boot_partition']."','".$_POST['device_id']."','".
    			$_POST['disk_index']."','".$_POST['index']."','".$_POST['primary_partition']."','".
    			$_POST['caption']."','".$_POST['file_system']."','".$_POST['free_space']."','".
    			$_POST['size']."','".$_POST['volume_name']."')";
		break;
	case 'optical_drive0':
		$sql="DELETE FROM optical_drive WHERE optical_drive_mac_address='$mac'";
		break;
	case 'optical_drive1':
		$sql="INSERT INTO optical_drive ( optical_drive_mac_address, optical_drive_caption,".
			"optical_drive_drive) VALUES ('$mac','".
			$_POST['caption']."','".$_POST['drive']."')";
		break;
	case 'tape_drive0' :
		$sql="DELETE FROM tape_drive WHERE tape_drive_mac_address='$mac'";
		break;
	case 'tape_drive1' : 
		$sql="INSERT INTO tape_drive ( tape_drive_mac_address, tape_drive_caption, ".
   			"tape_drive_description, tape_drive_manufacturer, tape_drive_name) VALUES ('$mac','".
			$_POST['caption']."','".$_POST['description']."','".
			$_POST['manufacturer']."','".$_POST['name']."')";
		break;
	case 'keyboard' :
		$sql="UPDATE system SET keyboard_caption='".$_POST['caption'].
		   	"', keyboard_description='".$_POST['description'].
   			"' WHERE net_mac_address='$mac'";
		break;
	case 'battery' :
	 	$sql="UPDATE system SET battery_description='".$_POST['description'].
		 	"',battery_device_id='".$_POST['device_id'].
   			"' WHERE net_mac_address='$mac'";
		break;
	case 'modem0' :
		$sql="DELETE FROM modem WHERE modem_mac_address='$mac'";
		break;
	case 'modem1' :
  		$sql="INSERT INTO modem ( modem_mac_address, modem_attached_to, " .
			"modem_country_selected, modem_description, modem_device_type VALUES ('$mac','" .
			$_POST['attached_to']."','".$_POST['country_selected']."','".
			$_POST['description']."','".$_POST['device_type']."')";
		break;
	case 'mouse' :
	 	$sql="UPDATE system SET mouse_description='".$_POST['description'].
			"', mouse_number_of_buttons='".$_POST['number_of_buttons'].
   			"' WHERE net_mac_address='$mac'";
		break;
	case 'soundcard' :
	 	$sql="UPDATE system SET sound_manufacturer='".$_POST['manufacturer'].
			"', sound_name='".$_POST['name'].
   			"' WHERE net_mac_address='$mac'";
		break;
	case 'printer0' :
		$sql= "DELETE FROM printer WHERE printer_mac_address='$mac'";
		mysql_query($sql);
		$sql="DELETE FROM other WHERE other_type='printer' AND other_linked_pc='$mac'";
		break;
	case 'printer1' :
		$sql="INSERT INTO printer ( printer_mac_address, printer_caption, ".
			"printer_default, printer_horizontal_resolution, printer_local, ".
			"printer_port_name, printer_shared, printer_share_name, ".
			"printer_vertical_resolution, printer_duplex, printer_form_name, ".
			"printer_paper_length, printer_paper_size, printer_paper_width, ".
			"printer_print_quality ) VALUES ('$mac','".
			$_POST['caption']."','".$_POST['default']."','".
			$_POST['horizontal_resolution']."','".$_POST['local']."','".
			$_POST['port_name']."','".$_POST['shared']."','".
			$_POST['share_name']."','".$_POST['vertical_resolution']."','".
			$_POST['duplex']."','".$_POST['form_name']."','".
			$_POST['paper_length']."','".$_POST['paper_size']."','".
			$_POST['paper_width']."','".$_POST['print_quality']."')";
  		break;
	case 'shares0' :
		$sql="DELETE FROM shares WHERE shares_mac_address='$mac'";
		break;
	case 'shares1' :
	  	$sql="INSERT INTO shares ( shares_mac_address, shares_caption, " .
   			"shares_name, shares_path  ) VALUES ('$mac','" .
			$_POST['caption']."','".$_POST['name']."','".$_POST['path']."')";
		break;
	case 'mapped0' :
		$sql="DELETE FROM mapped WHERE mapped_mac_address='$mac'";
		break;
	case 'mapped1' :
		$sql="INSERT INTO mapped ( mapped_mac_address, mapped_device_id, " .
   			"mapped_file_system, mapped_free_space, mapped_provider_name, " .
   			"mapped_size ) VALUES ('$mac','".
		      	$_POST['device_id']."','".$_POST['file_system']."','".
			$_POST['free_space']."','".$_POST['provider_name']."','".
			$_POST['size']."')";
		break;
	case 'audited' :
		$sql="UPDATE system SET date_audited=NOW()  WHERE net_mac_address='$mac'";
		break;
	case 'windows' :
		$sql="UPDATE system SET system_boot_device='".$_POST['boot_device'].
		 "', system_build_number='".$_POST['build_number'].
		 "', system_caption='".$_POST['caption'].
		 "', system_os_type='".$_POST['os_type'].
		 "', system_os_name='".$_POST['os_name']. 
		 "', system_country_code='".$_POST['country_code'].
		 "', system_description='" .$_POST['description'].
		 "', date_system_install='".$_POST['date_install'].
		 "', system_organisation='".$_POST['organisation'].
		 "', system_language='" .$_POST['language'].
		 "', system_registered_user='"  .$_POST['registered_user'].
		 "', system_serial_number='" .$_POST['serial_number'].
		 "', system_service_pack='" .$_POST['service_pack'].
		 "', system_version='".$_POST['version'].
		 "', system_windows_directory='" .$_POST['windows_directory'].
		 "' WHERE net_mac_address='$mac'";
		 break;
	case 'groups0' :
		$sql="DELETE FROM groups WHERE groups_mac_address='$mac'";
		break;
	case 'groups1' :
		$sql="INSERT INTO groups ( groups_mac_address, groups_description, ".
   			"groups_name, groups_members ) VALUES ('$mac','".
   			$_POST['description']."','".$_POST['name']."','".$_POST['members']."')";
		break;
	case 'users0' :
		$sql="DELETE FROM users WHERE users_mac_address='$mac'";
		break;
	case 'users1' :
		$sql="INSERT INTO users ( users_mac_address, users_description, ".
   			"users_disabled, users_full_name, users_name, users_password_changeable, ".
   			"users_password_expires, users_password_required ) VALUES ('$mac','".
			$_POST['description']."','".$_POST['disabled']."','".
			$_POST['full_name']."','".$_POST['name']."','".
			$_POST['password_changeable']."','".$_POST['password_expires']."','".
			$_POST['password_required']."')"; 
		break;
	case 'time' :
		$sql="UPDATE system SET time_caption='".$_POST['caption'].
   			".',time_daylight='".$_POST['daylight'].
			"' WHERE net_mac_address='$mac'";
		break;
	case 'startup0' :
		$sql="DELETE FROM startup WHERE startup_mac_address='$mac'";
		break;
	case 'startup1' :
		$sql="INSERT INTO startup ( startup_mac_address, startup_caption, startup_command, ".
			"startup_description, startup_location, startup_user) VALUES ('$mac','".
    			$_POST['caption']."','".$_POST['command']."','".$_POST['description']."','".
			$_POST['location']."','".$_POST['user']."')";
     		break;
	case 'services0' :
		$sql="DELETE FROM services WHERE services_mac_address='$mac'";
		break;
	case 'services1' :
	  	$sql="INSERT INTO services ( services_mac_address, services_description, ".
   			"services_display_name, services_name, services_path_name, services_started, ".
			"services_start_mode, services_state) VALUES ('$mac','".
   			$_POST['description']."','".$_POST['display_name']."','".
			$_POST['name']."','".$_POST['path_name']."','".
			$_POST['started']."','".$_POST['start_mode']."','".
			$_POST['state']."')";
		break;
	case 'hotfixes0' :
		$sql="DELETE FROM hotfixes WHERE hotfixes_mac_address='$mac'";
		break;
	case 'hotfixes1' :
		$sql="INSERT INTO hotfixes ( hotfixes_mac_address, hotfixes_description, ".
        		"hotfixes_hot_fix_id, hotfixes_installed_by, ".
		        "hotfixes_service_pack_in_effect) VALUES ('$mac','".
			$_POST['description']."','".$_POST['hot_fix_id']."','".
			$_POST['installed_by']."','".$_POST['service_pack_in_effect']."')";
		break;
	case 'ie' :
		$sql="UPDATE system SET version_ie='".$_POST['version']."' WHERE net_mac_address='$mac'";
		break;
	case 'dxwmp' :
		$sql="UPDATE system SET version_dx='".$_POST['dx']."', version_wmp='".$_POST['wmp'].
			"' WHERE net_mac_address='$mac'";
		break;
	case 'software0' :
		$sql="UPDATE software SET software_detect_current_scan='false' WHERE software_mac='$mac'";
		break;
	case 'software1' :
	       	$count=mysql_query("select count(*) from software WHERE software_mac='$mac' AND software_name='".$_POST['name']."' AND software_detect_current_scan='false'");
       		$row=mysql_fetch_array($count);
		if ($row[0]=='0') {
         		$sql="UPDATE software SET software_detect_current_scan='true' WHERE software_mac='$mac' AND software_name='".$_POST['name']."'";
			$count=mysql_query($sql);
		}
		$count=mysql_query("select count(*) from software WHERE software_mac='$mac' AND software_name='".$_POST['name']."' AND software_no_detect_date='1111-11-11'");
       		$row=mysql_fetch_array($count);
		if ($row[0]=='0') {
		         $sql="INSERT into software (software_mac, software_name, software_version, software_location, software_uninstall, software_install_date, software_publisher, software_install_source, software_detect_date, software_detect_current_scan, software_no_detect_date) VALUES ('$mac','" .
			$_POST['name']."','".$_POST['version']."','".$_POST['location']."','".
			$_POST['uninstall']."','".$_POST['install_date']."','".$_POST['publisher']."','".
			$_POST['install_source']."','".$_POST['detect_date']."','true','1111-11-11')";
			$count=mysql_query($sql);
		}
		$count=mysql_query("select count(*) from software WHERE software_mac='$mac' AND software_name='".$_POST['name']."'");
       		$row=mysql_fetch_array($count);
		if ($row[0]=='0') {
		         $sql="INSERT into software (software_mac, software_name, software_version, software_location, software_uninstall, software_install_date, software_publisher, software_install_source, software_detect_date, software_detect_current_scan, software_no_detect_date) VALUES ('$mac','".
        		$_POST['name']."','".$_POST['version']."','".$_POST['location']."','".
			$_POST['uninstall']."','".$_POST['install_date']."','".$_POST['publisher']."','".
			$_POST['install_source']."','".$_POST['detect_date']."','true','1111-11-11')";
			$count=mysql_query($sql);
		}
		$sql='';
		break;
	case 'software2' :
		$sql="UPDATE software SET software_no_detect_date='".$_POST['no_detect_date'].
			"' WHERE software_mac='$mac' AND software_detect_current_scan='false' ".
		       " AND software_no_detect_date='1111-11-11'";
		break;
	case 'firewall0' :
		$sql="UPDATE system SET firewall_enabled_standard='".$_POST['firewall_enabled_standard'].
			"', firewall_disablenotifications_standard='".$_POST['firewall_disablenotifications_standard'].
			"', firewall_donotallowexceptions_standard='".$_POST['firewall_donotallowexceptions_standard'].
			"' WHERE net_mac_address='$mac'";
		mysql_query($sql);
		$sql="DELETE from firewall_auth_app WHERE firewall_app_mac_address='$mac'";
		mysql_query($sql);
		$sql="DELETE from firewall_ports WHERE port_mac_address='$mac'";
		break;
	case 'firewall1' :
		$sql="INSERT into firewall_auth_app (firewall_app_mac_address, firewall_app_name, ".
			"firewall_app_executable, firewall_app_remote_address, firewall_app_enabled, ".
	       		"firewall_app_profile) VALUES ('$mac','".
  			$_POST['name']."','".$_POST['executable']."','".$_POST['remote_address']."','".
			$_POST['enabled']."','".$_POST['profile']."')";
		break;
	case 'firewall2' :
		$sql="INSERT into firewall_ports (port_mac_address, port_number, " .
  			"port_protocol, port_scope, port_enabled, port_profile) VALUES ('$mac','" .
			$_POST['number']."','".$_POST['protocol']."','".
			$_POST['scope']."','".$_POST['enabled']."','".
			$_POST['profile']."')";
		break;
	case 'mskeys0' :
		$sql="DELETE from ms_keys WHERE ms_keys_mac_address='$mac'";
		break;
	case 'mskeys1' :
		 $sql="INSERT into ms_keys (ms_keys_mac_address, ms_keys_name, ms_keys_cd_key, ms_keys_release, ms_keys_edition, ms_keys_key_type) VALUES ('$mac','".
			$_POST['name']."','".$_POST['cd_key']."','". 
			$_POST['release']."','".$_POST['edition']."','".
   			$_POST['key_type']."')";
		break;
	case 'mskeys2' :
		$sql="DELETE from ms_keys WHERE ms_keys_mac_address='$mac' AND ms_keys_name='".$_POST['name']."'";
		break;
	case 'iis0' :
		$sql="DELETE FROM iis WHERE iis_mac_address='$mac'";
		mysql_query($sql);
	 	$sql="DELETE FROM iis_ip WHERE iis_ip_mac_address='$mac'";
		mysql_query($sql);
		$sql="DELETE FROM iis_vd WHERE iis_vd_mac_address='$mac'";
		mysql_query($sql);
		$sql='';
		break;
	case 'iis1' :
		$sql="insert into iis_ip (iis_ip_mac_address, iis_ip_site, iis_ip_ip_address, iis_ip_port, iis_ip_host_header) VALUES ('$mac','".
			$_POST['site']."','".$_POST['ip_address']."','".
			$_POST['port']."','".$_POST['host_header']."')";
		break;
	case 'iis2' :
		$sql="insert into iis (iis_mac_address, iis_site, iis_description, iis_logging_enabled, ".
		"iis_logging_dir, iis_logging_format, iis_logging_time_period, iis_home_directory, ".
		"iis_directory_browsing, iis_default_documents, iis_secure_ip, iis_secure_port) VALUES('$mac','".
			$_POST['site']."','".$_POST['description']."','".$_POST['logging_enabled']."','".
			$_POST['logging_dir']."','".$_POST['logging_format']."','".
			$_POST['logging_time_period']."','".$_POST['home_directory']."','".
			$_POST['directory_browsing']."','".$_POST['default_documents']."','".
			$_POST['secure_ip']."','".$_POST['secure_port']."')";
		break;
	case 'iis3' :
		$sql="insert into iis_vd (iis_vd_mac_address, iis_vd_site, iis_vd_name, iis_vd_path) VALUES ('$mac','".
			$_POST['site']."','".$_POST['name']."','".$_POST['path']."')";
		break;
	default :
		echo "ERROR : unknow request";
}
echo "REMOTE\n";
var_dump($_POST);
if ($sql!='') {
	$result=mysql_query($sql);
	echo "\n".$sql."\n\n";
	if (!$result) {
   		$message='Wrong request : ' . mysql_error() . "\n$sql\n";
		die($message);
	} else {
		echo "REQUEST OK : affected= ".mysql_affected_rows();
	}
}

?>





