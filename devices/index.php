<?php
/*
 ----------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2005 by the INDEPNET Development Team.
 
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------

 LICENSE

	This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ------------------------------------------------------------------------
*/
 
// Based on:
// IRMA, Information Resource-Management and Administration
// Christian Bauer 
// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

include ("_relpos.php");
include ($phproot . "/glpi/includes.php");
include ($phproot . "/glpi/includes_devices.php");
include ($phproot . "/glpi/includes_enterprises.php");



checkAuthentication("normal");

commonHeader($lang["title"][8],$_SERVER["PHP_SELF"]);

if(isset($_GET)) $tab = $_GET;
if(empty($tab) && isset($_POST)) $tab = $_POST; 
if(!isset($tab["start"])) $tab["start"] = 0;
if(!isset($tab["order"])) $tab["order"] = "ASC";
if(!isset($tab["field"])) $tab["field"] = "all";
if(!isset($tab["phrasetype"])) $tab["phrasetype"] = "contains";
if(!isset($tab["contains"])) $tab["contains"] = "";
if(!isset($tab["sort"])) $tab["sort"] = "device.designation";
if(!isset($tab["deleted"])) $tab["deleted"] = "N";
if(!empty($tab["device_type"])) {
	titleDevices($tab["device_type"]);
}

echo "<div align='center'><form method='post' action=\"".$cfg_install["root"]."/devices/index.php\">";
echo "<table class='tab_cadre' cellpadding='3'><tr><th colspan='2'>";
echo $lang["devices"][17].": </th></tr><tr class='tab_bg_1'><td><select name='device_type'>";
$dp=array();
$dp[MOBOARD_DEVICE]=$lang["devices"][5];	
$dp[PROCESSOR_DEVICE]=$lang["devices"][4];	
$dp[RAM_DEVICE]=$lang["devices"][6];	
$dp[HDD_DEVICE]=$lang["devices"][1];	
$dp[DRIVE_DEVICE]=$lang["devices"][19];		
$dp[CONTROL_DEVICE]=$lang["devices"][20];		
$dp[GFX_DEVICE]=$lang["devices"][2];		
$dp[SND_DEVICE]=$lang["devices"][7];		
$dp[PCI_DEVICE]=$lang["devices"][21];		
$dp[CASE_DEVICE]=$lang["devices"][22];		
$dp[POWER_DEVICE]=$lang["devices"][23];

foreach ($dp as $key=>$val) {
	$sel="";
	if ($tab["device_type"]==$key) $sel="selected";
	echo "<option value='$key' $sel>".$val."</option>";	
}
echo "</select></td>";
echo "<td><input type='submit' value=\"".$lang["buttons"][2]."\" class='submit' ></td></tr>";
echo "</table></form></div>";

if(!empty($tab["device_type"])) {
	showDevicesList($tab["device_type"],$_SERVER["PHP_SELF"]);
}


commonFooter();
?>
