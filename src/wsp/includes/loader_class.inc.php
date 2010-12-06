<?php
	function loadWspClass($folder, $sub_folder=false) {
		$array_components_dir = scandir($folder);
		for ($i=0; $i < sizeof($array_components_dir); $i++) {
			if (is_file($folder."/".$array_components_dir[$i]) && 
					strtolower(substr($array_components_dir[$i], strlen($array_components_dir[$i])-10, 10)) == ".class.php") {
				require_once($folder."/".$array_components_dir[$i]);
			} else if ($sub_folder==true && is_dir($folder."/".$array_components_dir[$i]) && 
					$array_components_dir[$i] != "." && $array_components_dir[$i] != "..") {
				loadWspClass($folder."/".$array_components_dir[$i], $sub_folder);
			}
		}
	}

	// Load standard classes
	loadWspClass("wsp/class");
	
	// Load display classes
	loadWspClass("wsp/class/display", true);
	
	// Load database classes
	loadWspClass("wsp/class/database");
	
	// Load database_object classes
	loadWspClass("wsp/class/database_object");
	
	// Load wsp database_model classes
	loadWspClass("wsp/class/database_model/wsp");
	
	// Load database_model classes
	loadWspClass("wsp/class/database_model");
	
	// Load utils classes
	loadWspClass("wsp/class/utils");
	
	// Load wsp webservice classes
	if (in_array("soap", get_loaded_extensions(false))) {
		loadWspClass("wsp/class/webservice/wsp");
	}

	// PHP Mailer
	require("wsp/includes/PHP-Mailer/class.phpmailer.php"); 
	
	// RSS Feed parser (magpierss)
	require("wsp/includes/RSS-Reader/feedparser.php");
	
	// RSS Feed generator
	require("wsp/includes/RSS-Generator/RSSFeed.class.php");
	
	// PDF generator
	require("wsp/includes/fpdf/fpdf.php");
	
	// Load Defined Zone
	$array_defined_zone_dir = scandir("pages/defined_zone");
	for ($i=0; $i < sizeof($array_defined_zone_dir); $i++) {
		if (is_file("pages/defined_zone/".$array_defined_zone_dir[$i]) && 
				strtolower(substr($array_defined_zone_dir[$i], strlen($array_defined_zone_dir[$i])-4, 4)) == ".php") {
			try {
				require_once("pages/defined_zone/".$array_defined_zone_dir[$i]);
			} catch (Exception $e) {}
		}
	}
?>