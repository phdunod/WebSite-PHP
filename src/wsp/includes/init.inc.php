<?php
/**
 * PHP file wsp\includes\init.inc.php
 */
/**
 * WebSite-PHP file init.inc.php
 *
 * WebSite-PHP : PHP Framework 100% object (http://www.website-php.com)
 * Copyright (c) 2009-2012 WebSite-PHP.com
 * PHP versions >= 5.2
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @author      Emilien MOREL <admin@website-php.com>
 * @link        http://www.website-php.com
 * @copyright   WebSite-PHP.com 26/05/2011
 * @version     1.0.103
 * @access      public
 * @since       1.0.0
 */

	if (version_compare(PHP_VERSION, '5.2.0', '<') ) { 
		// Use of DateTime classes
		echo "Sorry, the FrameWork <a href='http://www.website-php.com' target='_blank'>WebSite-PHP</a> will only run on PHP version 5.2 or greater!<br/>Update your PHP version <a href='http://php.net/downloads.php' target='_blank'>http://php.net/downloads.php</a>\n";
		exit;
	}
	
	if (strtolower(substr($_SERVER['SERVER_SOFTWARE'], 0, 6)) == "apache") {
		if(!in_array("mod_rewrite", apache_get_modules())) {
			echo "Please change your Apache configuration to be compatible with <a href='http://www.website-php.com' target='_blank'>WebSite-PHP</a>:<br/>- You must activate the apache module mod_rewrite!<br/><a href='http://httpd.apache.org/docs/current/en/mod/mod_rewrite.html' target='_blank'>http://httpd.apache.org/docs/current/en/mod/mod_rewrite.html</a>\n";
			exit;
		}
	}
		
	if (!defined("DEFAULT_TIMEZONE") || DEFAULT_TIMEZONE == "") {
		define("DEFAULT_TIMEZONE", "Europe/Paris");
	}
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$http_type = "";
	$split_request_uri = explode("\?", $_SERVER['REQUEST_URI']);
	if (!defined('FORCE_SERVER_NAME') || FORCE_SERVER_NAME == "") {
		if ($_SERVER['SERVER_PORT'] == 443) {
			$http_type = "https://";
			$current_url = str_replace("//", "/", $_SERVER['SERVER_NAME'].substr($split_request_uri[0], 0, strrpos($split_request_uri[0], "/"))."/");
		} else {
			$port = "";
			if ($_SERVER['SERVER_PORT'] != 80 &&  $_SERVER['SERVER_PORT'] != "") {
				$port = ":".$_SERVER['SERVER_PORT'];
			}
			$http_type = "http://";
			$current_url = str_replace("//", "/", $_SERVER['SERVER_NAME'].$port.substr($split_request_uri[0], 0, strrpos($split_request_uri[0], "/"))."/");
		}
	} else {
		$http_type = "http://";
		$current_url = str_replace("//", "/", FORCE_SERVER_NAME.substr($split_request_uri[0], 0, strrpos($split_request_uri[0], "/"))."/");
	}
	define("SITE_URL", $http_type.$current_url);
	$_SESSION['websitephp_register_object'] = null;
	
	// define the base URL of the website
	$my_base_url = "";
	$array_cwd = explode('/',  str_replace('\\', '/', getcwd()));
	$wsp_folder_name = $array_cwd[sizeof($array_cwd)-1];
	
	$array_current_url = explode('/', $current_url);
	for ($i=sizeof($array_current_url)-2; $i >= 0; $i--) {
		if ($array_current_url[$i] == $wsp_folder_name) {
			$my_base_url = $http_type;
			for ($j=0; $j <= $i; $j++) {
				$my_base_url .= $array_current_url[$j]."/";
			}
			break;
		}
	}
	if ($my_base_url == "") {
		$my_base_url = $http_type.$array_current_url[0]."/";
	}
	$my_subfolder_url = str_replace($my_base_url, "", $http_type.$current_url);
	define("BASE_URL", $my_base_url);
	define("LANGUAGE_URL", substr($my_subfolder_url, 0, 2));
	define("SUBFOLDER_URL", $my_subfolder_url);
	
	if (file_exists('install.htaccess')) {
		$tmp_lang = SITE_DEFAULT_LANG;
    	$lang_folder = dirname(__FILE__)."/../../lang/";
    	if (!is_dir($lang_folder.$tmp_lang)) {
    		$tmp_lang = "";
	    	$array_lang_dir = scandir($lang_folder);
			for ($i=0; $i < sizeof($array_lang_dir); $i++) {
				if (is_dir($lang_folder.$array_lang_dir[$i]) && $array_lang_dir[$i] != "" && 
					$array_lang_dir[$i] != "." && $array_lang_dir[$i] != ".." && $array_lang_dir[$i] != ".svn" && 
					strlen($array_lang_dir[$i]) == 2) {
						$tmp_lang = $array_lang_dir[$i];
						break;
				}
			}
    	}
    	if (strlen($tmp_lang) != 2) {
    		echo "No language defined in WSP lang folder (".realpath($lang_folder).")\n";
    		exit;
    	}
		rename('install.htaccess', '.htaccess');
    	$test_url = @file_get_contents(BASE_URL.$tmp_lang);
    	if ($test_url == "") {
    		rename('.htaccess', 'install.htaccess');
    		echo "Please change your configuration to be compatible with <a href='http://www.website-php.com' target='_blank'>WebSite-PHP</a>:<br/>- Webserver needs to support \"AllowOverride All\" for your website directory!<br/>&lt;Directory /your_directory&gt;<br/>&nbsp;&nbsp;&nbsp;AllowOverride all<br/>&lt;/Directory&gt;<br/><a href='http://httpd.apache.org/docs/current/mod/core.html#allowoverride' target='_blank'>http://httpd.apache.org/docs/current/mod/core.html#allowoverride</a>\n";
    		exit;
    	}
	}
	
	$array_server_name = explode('.', $_SERVER['SERVER_NAME']);
	if (sizeof($array_server_name) > 1) {
		if ($array_server_name[0] != "www" && $array_server_name[0] != "127") {
			define("SUBDOMAIN_URL", $array_server_name[0]);
		} else {
			define("SUBDOMAIN_URL", "");
		}
	} else {
		define("SUBDOMAIN_URL", "");
	}
	
	$ind = 0;
	$params_url = "";
	if ($_GET['p'] != "" && strtoupper($_GET['p']) != "HOME") {
		if (isset($_GET['mime'])) {
			$params_url = $_GET['p'].".".$_GET['mime']; // mime type
		} else {
			$params_url = $_GET['p'].".html";
		}
	}
	foreach ($_GET as $key => $value) {
		if ($key != "l") {
			if ($key != "p" && $key != "mime" && $key != "folder_level") {
				if ($ind == 0) {
					$params_url .= "?";
				} else {
					$params_url .= "&";
				}
				$params_url .= $key."=".urlencode($value);
				$ind++;
			}
		}
	}
	define("PARAMS_URL", $params_url);
	define("SITE_DIRECTORY", dirname($_SERVER['SCRIPT_FILENAME']));
	
	include_once("wsp/config/config_db.inc.php"); 
	include_once("wsp/config/config_smtp.inc.php"); 
	include_once("wsp/includes/utils.inc.php");

	// Redirect wrong URL
	if (strtoupper($_GET['p']) != "HOME") {
		if (find($_SERVER['REQUEST_URI'], ".html", 1, 0) == 0 && !isset($_GET['mime']) && 
			 (!isset($_GET['error-redirect-url']) && !isset($_GET['error-redirect']))) {
			header('HTTP/1.1 301 Moved Temporarily');  
			header('Status: 301 Moved Temporarily');  
			if (isset($_SESSION['lang']) || isset($_GET['l'])) {
				if (isset($_SESSION['lang'])) {
					header("Location:".BASE_URL.$_SESSION['lang']."/".PARAMS_URL);
				} else {
					header("Location:".BASE_URL.$_GET['l']."/".PARAMS_URL);
				}
			} else {
				header("Location:".BASE_URL.PARAMS_URL);
			}
			exit;
		}
	}
	
	include_once("wsp/includes/utils_image.inc.php"); 
	include_once("wsp/includes/utils_openssl.inc.php");
	include_once("wsp/includes/loader_lang.inc.php");

	global $months;
	$months = array(translate(__JANUARY__), translate(__FEBRUARY__), translate(__MARCH__), 
									translate(__APRIL__), translate(__MAY__), translate(__JUNE__), 
									translate(__JULY__), translate(__AUGUST__), translate(__SEPTEMBER__), 
									translate(__OCTOBER__), translate(__NOVEMBER__), translate(__DECEMBER__));
	
	global $days_week;
	$days_week = array(translate(__MONDAY__), translate(__TUESDAY__), translate(__WEDNESDAY__), translate(__THURSDAY__), 
									translate(__FRIDAY__), translate(__SATURDAY__), translate(__SUNDAY__));
	
	
	register_shutdown_function("register_shutdown_handler");
	set_error_handler("error_handler");
	require_once(dirname(__FILE__)."/../class/NewException.class.php");
	set_exception_handler(array("NewException", "printStaticException"));
									
	include_once("wsp/includes/loader_class.inc.php");
	include_once("wsp/includes/wsp_user_ban.inc.php");
	
	include_once("wsp/includes/html2text.inc.php"); 
	include_once("wsp/includes/securimage/securimage.php");
?>
