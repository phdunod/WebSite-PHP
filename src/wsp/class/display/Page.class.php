<?php
/**
 * PHP file wsp\class\display\Page.class.php
 * @package display
 */
/**
 * Class Page
 *
 * WebSite-PHP : PHP Framework 100% object (http://www.website-php.com)
 * Copyright (c) 2009-2014 WebSite-PHP.com
 * PHP versions >= 5.2
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @package display
 * @author      Emilien MOREL <admin@website-php.com>
 * @link        http://www.website-php.com
 * @copyright   WebSite-PHP.com 17/01/2014
 * @version     1.2.7
 * @access      public
 * @since       1.0.0
 */

require_once(dirname(__FILE__)."/../abstract/display/AbstractPage.class.php");

class Page extends AbstractPage {
	/**#@+
	* cache time
	* @access public
	* @var integer
	*/
	const CACHE_TIME_1MIN = 60;
	const CACHE_TIME_2MIN = 120;
	const CACHE_TIME_10MIN = 600;
	const CACHE_TIME_20MIN = 1200;
	const CACHE_TIME_30MIN = 1800;
	const CACHE_TIME_1HOUR = 3600;
	const CACHE_TIME_2HOURS = 7200;
	const CACHE_TIME_3HOURS = 10800;
	const CACHE_TIME_4HOURS = 14400;
	const CACHE_TIME_6HOURS = 21600;
	const CACHE_TIME_8HOURS = 28800;
	const CACHE_TIME_10HOURS = 36000;
	const CACHE_TIME_12HOURS = 43200;
	const CACHE_TIME_1DAY = 86400;
	const CACHE_TIME_2DAYS = 172800;
	const CACHE_TIME_3DAYS = 259200;
	const CACHE_TIME_4DAYS = 345600;
	const CACHE_TIME_7DAYS = 604800;
	const CACHE_TIME_14DAYS = 1209600;
	const CACHE_TIME_1MONTH = 2678400;
	const CACHE_TIME_2MONTHS = 5270400;
	const CACHE_TIME_3MONTHS = 8035200;
	const CACHE_TIME_4MONTHS = 10713600;
	const CACHE_TIME_6MONTHS = 15724800;
	const CACHE_TIME_1YEAR = 31536000;
	const CACHE_TIME_2YEARS = 63072000;
	/**#@-*/
	
	/**#@+
	* meta robots
	* @access public
	* @var string
	*/
	const META_ROBOTS_INDEX_FOLLOW = "index, follow";
	const META_ROBOTS_NOINDEX_NOFOLLOW = "noindex, nofollow";
	const META_ROBOTS_INDEX_NOFOLLOW = "index, nofollow";
	const META_ROBOTS_NOINDEX_FOLLOW = "noindex, follow";
	/**#@-*/
	
	/**#@+
	* Open Graph Theme (http://ogp.me/#types)
	* @access public
	* @var string
	*/
	const OPENGRAPH_TYPE_ACTIVITY = "activity";
	const OPENGRAPH_TYPE_SPORT = "sport";
	const OPENGRAPH_TYPE_BAR = "bar";
	const OPENGRAPH_TYPE_COMPANY = "company";
	const OPENGRAPH_TYPE_CAFE = "cafe";
	const OPENGRAPH_TYPE_HOTEL = "hotel";
	const OPENGRAPH_TYPE_RESTAURANT = "restaurant";
	const OPENGRAPH_TYPE_CAUSE = "cause";
	const OPENGRAPH_TYPE_SPORTS_LEAGUE = "sports_league";
	const OPENGRAPH_TYPE_SPORTS_TEAM = "sports_team";
	const OPENGRAPH_TYPE_BAND = "band";
	const OPENGRAPH_TYPE_GOVERNMENT = "government";
	const OPENGRAPH_TYPE_NON_PROFIT = "non_profit";
	const OPENGRAPH_TYPE_SCHOOL = "school";
	const OPENGRAPH_TYPE_UNIVERSITY = "university";
	const OPENGRAPH_TYPE_ACTOR = "actor";
	const OPENGRAPH_TYPE_ATHLETE = "athlete";
	const OPENGRAPH_TYPE_AUTHOR = "author";
	const OPENGRAPH_TYPE_DIRECTOR = "director";
	const OPENGRAPH_TYPE_MUSICIAN = "musician";
	const OPENGRAPH_TYPE_POLITICIAN = "politician";
	const OPENGRAPH_TYPE_PROFILE = "profile";
	const OPENGRAPH_TYPE_PUBLIC_FIGURE = "public_figure";
	const OPENGRAPH_TYPE_CITY = "city";
	const OPENGRAPH_TYPE_COUNTRY = "country";
	const OPENGRAPH_TYPE_LANDMARK = "landmark";
	const OPENGRAPH_TYPE_STATE_PROVINCE = "state_province";
	const OPENGRAPH_TYPE_ALBUM = "album";
	const OPENGRAPH_TYPE_BOOK = "book";
	const OPENGRAPH_TYPE_DRINK = "drink";
	const OPENGRAPH_TYPE_FOOD = "food";
	const OPENGRAPH_TYPE_GAME = "game";
	const OPENGRAPH_TYPE_MOVIE = "movie";
	const OPENGRAPH_TYPE_PRODUCT = "product";
	const OPENGRAPH_TYPE_SONG = "song";
	const OPENGRAPH_TYPE_TV_SHOW = "tv_show";
	const OPENGRAPH_TYPE_ARTICLE = "article";
	const OPENGRAPH_TYPE_BLOG = "blog";
	const OPENGRAPH_TYPE_WEBSITE = "website";
	/**#@-*/
	
	/**#@+
	* Page Rights
	* @access public
	* @var string
	*/
	const RIGHTS_ADMINISTRATOR = "administrator";
	const RIGHTS_MODERATOR = "moderator";
	const RIGHTS_TRANSLATOR = "translator";
	const RIGHTS_DEVELOPER = "developer";
	const RIGHTS_AUTH_USER = "auth_user";
	const RIGHTS_GUEST = "guest";
	/**#@-*/
	
	/**#@+
	* @access protected
	*/
	protected $render = null;
	
	protected static $PAGE_TITLE = "";
	protected static $PAGE_KEYWORDS = "";
	protected static $PAGE_DESCRIPTION = "";
	protected static $PAGE_META_ROBOTS = "";
	protected static $PAGE_META_GOOGLEBOTS = "";
	protected static $PAGE_META_REVISIT_AFTER = "";
	
	protected static $PAGE_META_OPENGRAPH_TYPE = "";
	protected static $PAGE_META_OPENGRAPH_IMAGE = "";
	protected static $PAGE_META_IPHONE_IMAGE_57PX = "";
	protected static $PAGE_META_IPHONE_IMAGE_72PX = "";
	protected static $PAGE_META_IPHONE_IMAGE_114PX = "";
	
	protected $USER_RIGHTS = "";
	protected $USER_NO_RIGHTS_REDIRECT = "";
	protected $PAGE_CACHING = false;
	/**#@-*/
	
	/**#@+
	* @access private
	*/
	private $add_to_render = array();
	private $add_to_render_begining = array();
	private $add_to_render_ending = array();
	private $page_is_display = false;
	
	private $page_is_caching = false;
	private $class_name = "";
	private $page = "";
	private $cache_file_name = "";
	private $cache_file_name_orig = "";
	private $cache_time = 0;
	private $cache_timezone = "";
	private $cache_reset_on_midnight = false;
	
	private $is_browser_ie_6 = false;
	private $is_browser_ie = false;
	private $browser = null;
	
	private $objects = array();
	private $force_objects_default_values = false;
	private $log_debug_str = array();
	
	private $callback_method = "";
	private $callback_object = null;
	private $callback_method_called = false;
	private $callback_method_params = array();
	private $array_callback_object = array("Button", "ComboBox", "TextBox", "Password", "ColorPicker", "CheckBox", 
											"ContextMenuEvent", "DroppableEvent", "SortableEvent", "Object", "Picture", 
											"Calendar", "AutoCompleteEvent", "Raty", "TextArea", "RadioButtonGroup", 
											"UploadFile");
	
	private $create_object_to_get_css_js = false;
	private $ended_added_object_loaded = false;
	private $array_decrypted_form = array();
	
	private $is_mobile_meta_tag = false;
	private $is_mobile_webapp_meta_tag = false;
	/**#@-*/
	
	/**
	 * Constructor Page
	 */
	function __construct() {
		$this->is_browser_ie_6 = is_browser_ie_6();
		$this->is_browser_ie = is_browser_ie();
	}
	
	/**
	 * Destructor Page
	 */
	function __destruct() {
		try {
			if ($this->page_is_display) {
				if ((CACHING_ALL_PAGES || $this->PAGE_CACHING) && !$this->page_is_caching && $this->cache_time != -1) {
					if (strtoupper(substr($this->class_name, 0, 5)) != "ERROR" && $GLOBALS['__ERROR_DEBUG_PAGE__'] != true) {
						$cache_file = new File($this->cache_file_name, false, true);
						$cache_file->write(ob_get_contents());
						$cache_file->close();
					}
				}
			}
			@ob_end_flush();
		} catch(Exception $e) {
			// No action
		}
	}
	
	/**
	 * Method getInstance
	 * @access static
	 * @param string $page file path of the page in the folder pages (without pages/ folder and .php extension)
	 * @return Page
	 * @since 1.0.0
	 */
	final public static function getInstance($page) {
		$page_tmp = str_replace("_", "-", $page);
		$page_tmp = explode('/', $page_tmp);
		$page_names = explode('-', $page_tmp[sizeof($page_tmp)-1]);
		$page_class_name = "";
		for ($i=0; $i < sizeof($page_names); $i++) {
			$page_class_name .= ucfirst($page_names[$i]);
		}
		
		static $aoInstance = array();
		if (!isset($aoInstance[$page_class_name])) {
			if (strtoupper(substr($page, 0, 6)) == "ERROR-") {
				require_once(dirname(__FILE__)."/../../../pages/error/".$page.".php");
			} else {
				require_once(dirname(__FILE__)."/../../../pages/".$page.".php");
			}
			$aoInstance[$page_class_name] = new $page_class_name();
			
			// run ob_start only for current page and not for user rights testing
			if (sizeof($aoInstance) == 1) { 
				ob_start(array('NewException', 'redirectOnError'));
			}
			
			$aoInstance[$page_class_name]->page = $page;
			$aoInstance[$page_class_name]->setCacheFileName($page);
			$aoInstance[$page_class_name]->class_name = $page_class_name;
		}
		return $aoInstance[$page_class_name];
	}
   
	/**
	 * Method setCache
	 * return true if the cache must be replace or write
	 * @access public
	 * @return boolean
	 * @since 1.0.3
	 */
	public function setCache() {
		$this->page_is_display = true;
		$this->PAGE_CACHING = true;
		if (CACHING_ALL_PAGES || $this->PAGE_CACHING) {
			$cache_file = $this->cache_file_name;
			$cache_file_existe = (@file_exists($cache_file)) ? @filemtime($cache_file) : 0;
			$cache_time = CACHE_TIME;
			if ($this->cache_time > 0) {
				$cache_time = $this->cache_time;
			} 
			
			$render_current_cache = false;
			// cache is always to define time
			if ($cache_file_existe > time() - $cache_time) {
				$render_current_cache = true;
				
				// if cache_reset_on_midnight is true and the caching file has not the same date like today
				$date_cachefile = date("Ymd", $cache_file_existe);
				$date_timezone = date("Ymd");
				if ($this->cache_timezone == "") {
					$this->cache_timezone = date_default_timezone_get();
				}
				if ($this->cache_timezone != "") {
					// Compute date of the defined timezone to check if the day change
					$offset_server = SERVER_TIMEZONE_OFFSET_SECONDES;
					$tmp_date = new DateTime(null, new DateTimeZone($this->cache_timezone));
					$offset_timezone = $tmp_date->getOffset();
					if (is_numeric($offset_timezone) && is_numeric($offset_server)) {
						$diff_time = $offset_timezone - $offset_server;
						// compute dates with diff timezone
						$date_cachefile = date("Ymd", $cache_file_existe + $diff_time);
						$date_timezone = date("Ymd", time() + $diff_time);
					}
				}
				if ($this->cache_reset_on_midnight && $date_cachefile != $date_timezone) {
					$render_current_cache = false;
				}
			}
			
			// read the cache and display it in the render
			if ($render_current_cache) { 
				$tmp_render = file_get_contents($cache_file);
				if ($tmp_render == null) {
					return false;
				}
				$this->render = $tmp_render;
				$this->page_is_caching = true;
				return true;
			}
			return false;
		}
		return false;
	}
	
	/**
	 * Method setCacheFileName
	 * @access protected
	 * @param string $file_name base of file name of the caching file
	 * @since 1.0.3
	 */
	protected function setCacheFileName($file_name) {
		if (trim($file_name) != "") {
			$cache_directory = $this->getCacheDirectory();
			if (!is_dir($cache_directory)) {
				mkdir($cache_directory);
			}
			if ($_SESSION['lang'] != "") {
				$cache_directory = $cache_directory."/".$_SESSION['lang'];
				if (!is_dir($cache_directory)) {
					mkdir($cache_directory);
				}
			}
			$this->cache_file_name_orig = $cache_directory."/".$file_name;
			$this->cache_file_name = $this->getRealCacheFileName();
		} else {
			$this->cache_file_name_orig = "";
			$this->cache_file_name = "";
			$this->disableCache();
		}
	}
	
	/**
	 * Method getRealCacheFileName
	 * @access public
	 * @param string $cache_file_name_orig 
	 * @return string
	 * @since 1.1.3
	 */
	public function getRealCacheFileName($cache_file_name_orig="") {
		$cache_file_name = "";
		if ($cache_file_name_orig == "" && $this->cache_file_name_orig != "") {
			$cache_file_name_orig = $this->cache_file_name_orig;
		}
		if ($cache_file_name_orig != "") {
			$cache_directory = $this->getCacheDirectory();
			if ($_SESSION['lang'] != "") {
				$cache_directory = $cache_directory."/".$_SESSION['lang'];
			}
			$cache_file_name = str_replace($cache_directory, "", $cache_file_name_orig);
			
			$cache_file_name_ext = "";
			if (find($cache_file_name, ".cache", 1, 0) == 0) {
				$cache_file_name_ext = ".cache";
			}
			$cache_file_name = $cache_file_name.$cache_file_name_ext;
			
			if (!isset($_GET['mime']) || (isset($_GET['mime']) && ($_GET['mime'] == "text/html" || $_GET['mime'] == "html"))) {
				if ($this->is_browser_ie_6) {
					$cache_file_name = str_replace(".cache", "_ie6.cache", $cache_file_name);
				} else if ($this->is_browser_ie) {
					$cache_file_name = str_replace(".cache", "_ie".get_browser_ie_version().".cache", $cache_file_name);
				}
				if (!$this->isAjaxPage()) {
					$last_css_config_file = CssInclude::getInstance()->getLastCssConfigFileSession();
					if ($last_css_config_file != "config_css.inc.php" && trim($last_css_config_file) != "") {
						$cache_file_name = str_replace(".cache", "_".$last_css_config_file.".cache", $cache_file_name);
					}
				}
				if ($this->isCss3Browser()){
					$cache_file_name = str_replace(".cache", "_css3.cache", $cache_file_name);
				}
				if ($this->isAjaxPage()){
					$cache_file_name = str_replace(".cache", "_ajax.cache", $cache_file_name);
				} else if ($this->isAjaxLoadPage()){
					$cache_file_name = str_replace(".cache", "_load.cache", $cache_file_name);
				}
			}
			$cache_file_name = $cache_directory.str_replace("%2F", "/", urlencode($cache_file_name));
		}
		return str_replace("\"", "", $cache_file_name);
	}
	
	/**
	 * Method deleteCacheFilesPage
	 * @access public
	 * @return Page
	 * @since 1.0.103
	 */
	public function deleteCacheFilesPage() {
		$files = glob($this->cache_file_name_orig."*.cache");
		if (is_array($files)) {
			foreach ($files as $filename) {
			  @unlink($filename);
			}
		}
		return $this;
	}
	
	/**
	 * Method getCacheFileName
	 * @access protected
	 * @return mixed
	 * @since 1.0.73
	 */
	protected function getCacheFileName() {
		return $this->cache_file_name;
	}
	
	/**
	 * Method getOriginalCacheFileName
	 * @access public
	 * @return mixed
	 * @since 1.1.3
	 */
	public function getOriginalCacheFileName() {
		return $this->cache_file_name_orig;
	}
	
	/**
	 * Method setCacheTime
	 * @access protected
	 * @param integer $cache_time time in seconds
	 * @param boolean $reset_on_midnight true if the cache is replace after midnight [default value: false]
	 * @param string $cache_timezone_id if $reset_on_midnight is true, then the time zone id can be defined to detect the change of the day [default value: '']
	 * @since 1.0.3
	 */
	protected function setCacheTime($cache_time, $reset_on_midnight=false, $cache_timezone_id='') {
		$this->cache_time = $cache_time;
		$this->cache_reset_on_midnight = $reset_on_midnight;
		$this->cache_timezone = $cache_timezone_id;
	}
	
	/**
	 * Method getCacheTime
	 * @access public
	 * @return mixed
	 * @since 1.2.7
	 */
	public function getCacheTime() {
		return $this->cache_time;
	}
	
	/**
	 * Method disableCache
	 * @access public
	 * @since 1.0.3
	 */
	public function disableCache() {
		$this->PAGE_CACHING = false;
	}
	
	/**
	 * Method loadStretchBackground
	 * @access private
	 * @since 1.0.83
	 */
	private function loadStretchBackground() {
		// add stretch fixe background
		CssInclude::getInstance()->loadCssConfigFileInMemory(false);
		if (!$this->isAjaxLoadPage() && !$this->isAjaxPage() && 
			defined('DEFINE_STYLE_BCK_BODY_PIC_POSITION') && strtoupper(DEFINE_STYLE_BCK_BODY_PIC_POSITION) == "STRETCH" &&
			defined('DEFINE_STYLE_BCK_BODY_PIC') && DEFINE_STYLE_BCK_BODY_PIC_POSITION != "") {
				JavaScriptInclude::getInstance()->add(BASE_URL."wsp/js/jquery.backstretch.min.js", "", true);
				$background_body_pic = "";
				if (find(DEFINE_STYLE_BCK_BODY_PIC, "http://") == 0 && find(DEFINE_STYLE_BCK_BODY_PIC, "https://") == 0) {
					$background_body_pic = $this->getBaseURL().DEFINE_STYLE_BCK_BODY_PIC;
				} else {
					$background_body_pic = DEFINE_STYLE_BCK_BODY_PIC;
				}
				if (trim($background_body_pic) != "" && $background_body_pic != $this->getBaseURL()) {
					$this->addObject(new JavaScript("$.backstretch(\"".$background_body_pic."\");"), true);
				}
		}
	}
		
	/**
	 * Method getPageTitle
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getPageTitle() {
		return strip_tags(self::$PAGE_TITLE);
	}
	
	/**
	 * Method getPageKeywords
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getPageKeywords() {
		return strip_tags(self::$PAGE_KEYWORDS);
	}
	
	/**
	 * Method getPageDescription
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getPageDescription() {
		return strip_tags(self::$PAGE_DESCRIPTION);
	}
	
	/**
	 * Method getPageMetaRobots
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getPageMetaRobots() {
		return self::$PAGE_META_ROBOTS;
	}
	
	/**
	 * Method getPageMetaGooglebots
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getPageMetaGooglebots() {
		return self::$PAGE_META_GOOGLEBOTS;
	}
	
	/**
	 * Method getPageMetaRevisitAfter
	 * @access public
	 * @return string
	 * @since 1.0.33
	 */
	public function getPageMetaRevisitAfter() {
		return self::$PAGE_META_REVISIT_AFTER;
	}
	
	/**
	 * Method getPageMetaOpenGraphType
	 * @access public
	 * @return mixed
	 * @since 1.0.94
	 */
	public function getPageMetaOpenGraphType() {
		return strip_tags(self::$PAGE_META_OPENGRAPH_TYPE);
	}
	
	/**
	 * Method getPageMetaOpenGraphImage
	 * @access public
	 * @return mixed
	 * @since 1.0.94
	 */
	public function getPageMetaOpenGraphImage() {
		return strip_tags(self::$PAGE_META_OPENGRAPH_IMAGE);
	}
	
	/**
	 * Method getPageMetaIphoneImage57Px
	 * @access public
	 * @return mixed
	 * @since 1.0.98
	 */
	public function getPageMetaIphoneImage57Px() {
		return strip_tags(self::$PAGE_META_IPHONE_IMAGE_57PX);
	}
	
	/**
	 * Method getPageMetaIphoneImage72Px
	 * @access public
	 * @return mixed
	 * @since 1.0.98
	 */
	public function getPageMetaIphoneImage72Px() {
		return strip_tags(self::$PAGE_META_IPHONE_IMAGE_72PX);
	}
	
	/**
	 * Method getPageMetaIphoneImage114Px
	 * @access public
	 * @return mixed
	 * @since 1.0.98
	 */
	public function getPageMetaIphoneImage114Px() {
		return strip_tags(self::$PAGE_META_IPHONE_IMAGE_114PX);
	}
	
	/**
	 * Method getPageIsCaching
	 * @access public
	 * @return boolean
	 * @since 1.0.3
	 */
	public function getPageIsCaching() {
		return $this->page_is_caching;
	}
	
	/**
	 * Method isCachingAsked
	 * @access public
	 * @return mixed
	 * @since 1.1.3
	 */
	public function isCachingAsked() {
		return $this->page_is_display;
	}	
	
	/**
	 * Method getPage
	 * @access public
	 * @return Page
	 * @since 1.0.0
	 */
	public function getPage() {
		return $this->page;
	}
	
	/**
	 * Method getClassName
	 * @access public
	 * @return mixed
	 * @since 1.0.67
	 */
	public function getClassName() {
		return $this->class_name;
	}
	
	/**
	 * Method addEventObject
	 * @access public
	 * @param WebSitePhpObject $object 
	 * @param Form $form_object [default value: null]
	 * @since 1.0.18
	 */
	public function addEventObject($object, $form_object=null) {
		if (($object->isEventObject() || get_class($object) == "Form") && !$this->create_object_to_get_css_js) {
			$class_name = get_class($object);
			if ($form_object != null) {
				if (get_class($form_object) != "Form") {
					throw new NewException("addEventObject error in the second parameter : must be a Form object", 0, getDebugBacktrace(1));
				}
				$class_name .= "_".$form_object->getName();
				$form_object->registerObjectToForm($object);
			}
			if (!isset($this->objects[$class_name])) {
				$this->objects[$class_name] = array();
			}
			$this->objects[$class_name][] = $object;
		}
	}
	
	/**
	 * Method getEventObjects
	 * @access public
	 * @param mixed $event_object_name 
	 * @return array
	 * @since 1.0.18
	 */
	public function getEventObjects($event_object_name) {
		if (isset($this->objects[$event_object_name])) {
			return $this->objects[$event_object_name];
		} else {
			return array();
		}
	}
	
	/**
	 * Method getAllEventObjects
	 * @access public
	 * @return array
	 * @since 1.0.18
	 */
	public function getAllEventObjects() {
		return $this->objects;
	}
	
	/**
	 * Method getObjectId
	 * @access public
	 * @param string $id 
	 * @return mixed
	 * @since 1.0.18
	 */
	public function getObjectId($id) {
		$register_objects = WebSitePhpObject::getRegisterObjects();
		for ($i=0; $i < sizeof($register_objects); $i++) {
			if (method_exists($register_objects[$i], "getId")) {
				if ($register_objects[$i]->getId() == $id || $register_objects[$i]->getId()."_id" == $id) {
					return $register_objects[$i];
				}
			}
		}
		return null;
	}
	
	/**
	 * Method createObjectName
	 * Create an automatique and unique name for an event object
	 * @access public
	 * @param WebSitePhpObject $object event object (ex: TextBox, Editor, Button, ...)
	 * @return string
	 * @since 1.0.18
	 */
	public function createObjectName($object) {
		$class_name = get_class($object);
		$form_object = null;
		if ($class_name != "Form") {
			if (method_exists($object, "getFormObject")) {
				$form_object = $object->getFormObject();
				if ($form_object != null) {
					$class_name .= "_".$form_object->getName();
				}
			}
		}
		$nb_elem_object = sizeof($this->getEventObjects($class_name));
		if (isset($_GET['tabs_object_id'])) {
			$nb_elem_object = $_GET['tabs_object_id']."_".$nb_elem_object;
		}
		if (DialogBox::getCurrentDialogBoxLevel() != -1) {
			$nb_elem_object = (DialogBox::getCurrentDialogBoxLevel()*1000) + $nb_elem_object;
		}
		$this->addEventObject($object, $form_object);
		return $class_name."_".$nb_elem_object;
	}
	
	/**
	 * Method existsObjectName
	 * Test if an event object already exists for this name
	 * @access public
	 * @param string $name 
	 * @return boolean
	 * @since 1.0.18
	 */
	public function existsObjectName($name) {
		foreach ($this->objects as $object_array) {
			foreach ($object_array as $object) {
				if ($object->getName() == $name) {
					return $object;
				}
			}
		}
		return false;
	}
	
	/**
	 * Method getObjectValue
	 * @access public
	 * @param string $name get the value of an event object (ex: TextBox, Editor, Button, ...)
	 * @return boolean
	 * @since 1.0.18
	 */
	public function getObjectValue($name) {
		$object = $this->existsObjectName($name);
		if ($object != false) {
			return $object->getValue();
		}
		return false;
	}
	
	/**
	 * Method setObjectValue
	 * @access public
	 * @param string $name set the value of an event object (ex: TextBox, Editor, Button, ...)
	 * @param string $value 
	 * @since 1.0.18
	 */
	public function setObjectValue($name, $value) {
		$object = $this->existsObjectName($name);
		if ($object != false) {
			$object->setValue($value);
		}
	}
	
	/**
	 * Method loadAllVariables
	 * Load all GET and POST Varaibles after submit a form
	 * @access public
	 * @since 1.0.22
	 */
	public function loadAllVariables() {
		//$this->addLogDebug(echo_r($_POST));
		$GLOBALS['__LOAD_VARIABLES__'] = true;
		foreach ($this->objects as $class_name => $object_array) {
			$array_class_name = explode('_', $class_name);
			// Load variables for all event objects except Form object
			if ($array_class_name[0] != "Form") {
				$form_name = "";
				for ($i=1; $i < sizeof($array_class_name); $i++) {
					if ($i > 1) {
						$form_name .= "_";
					}
					$form_name .= $array_class_name[$i];
				}
				foreach ($object_array as $object) {
					// WARNING if change : This code is almost identical with: Page->getUserEventObject(), WebSitePhpEventObject->initSubmitValue()
					
					// create object name
					if ($form_name == "") {
						$name = $this->class_name."_".$object->getName();
					} else {
						$name = $this->class_name."_".$form_name."_".$object->getName();
					}
					$name_hidden = "";
					// use for component with hidden value
					if ($array_class_name[0] == "Editor" && $GLOBALS['__AJAX_PAGE__'] == true) { 
						if ($form_name == "") {
							$name_hidden = $this->class_name."_hidden_".$object->getName();
						} else {
							$name_hidden = $this->class_name."_".$form_name."_hidden_".$object->getName();
						}
					}
					if (method_exists($object, "getFormObject")) {
						$form_object = $object->getFormObject();
						if ($form_object != null) {
							if (!in_array($this->class_name."_".$form_object->getName(), $this->array_decrypted_form)) {
								decryptRequestEncryptData($form_object, $this->class_name."_".$form_object->getName()); // decrypt Form data
								$this->array_decrypted_form[] = $this->class_name."_".$form_object->getName();
							}
						}
					} else {
						$form_object = null;
					}
					// check object's form rights (POST or GET) before load variable
					// If this variable exists load it into the object
					$find_in_form = false;
					if ($form_object == null) { // no form associate to event object
						if (isset($_POST[$name])) {
							if ($name_hidden != "") {
								$object->setValue(decryptRequestEncryptData($object, $name_hidden, "POST"));
								$find_in_form = true;
							} else {
								$object->setValue(decryptRequestEncryptData($object, $name, "POST"));
								$find_in_form = true;
							}
						} else if (isset($_GET[$name])) {
							if ($name_hidden != "") {
								$object->setValue(decryptRequestEncryptData($object, $name_hidden, "GET"));
								$find_in_form = true;
							} else {
								$object->setValue(decryptRequestEncryptData($object, $name, "GET"));
								$find_in_form = true;
							}
						}
					} else if ($form_object->getMethod() == "POST") { // form rights is POST
						if (isset($_POST[$name])) {
							if ($name_hidden != "") {
								$object->setValue(decryptRequestEncryptData($object, $name_hidden, "POST"));
								$find_in_form = true;
							} else {
								$object->setValue(decryptRequestEncryptData($object, $name, "POST"));
								$find_in_form = true;
							}
						}
					} else { // form rights is GET
						if (isset($_GET[$name])) {
							if ($name_hidden != "") {
								$object->setValue(decryptRequestEncryptData($object, $name_hidden, "GET"));
								$find_in_form = true;
							} else {
								$object->setValue(decryptRequestEncryptData($object, $name, "GET"));
								$find_in_form = true;
							}
						}
					}
					if ($find_in_form == true && is_subclass_of($object, "WebSitePhpEventObject")) {
						$object->setSubmitValueIsInit();
					}
					//$this->addLogDebug("Page->loadAllVariables: ".$name." - ".isset($_GET[$name])." - ".isset($_POST[$name]));
				}
			}
		}
		$GLOBALS['__LOAD_VARIABLES__'] = false;
		$this->loadStretchBackground();
	}
	
	/**
	 * Method forceObjectsDefaultValues
	 * Force all event object (ex: TextBox, Editor, Button, ...) to the default value (like a reset)
	 * Cancel method loadAllVariables
	 * @access public
	 * @since 1.0.33
	 */
	public function forceObjectsDefaultValues() {
		foreach ($this->objects as $class_name => $object_array) {
			if ($class_name != "Form") {
				foreach ($object_array as $object) {
					if (get_class($object) != "Button" && 
						method_exists($object, "setValue") && method_exists($object, "getDefaultValue")) {
							$object->setValue($object->getDefaultValue());
					}
				}
			}
		}
		$this->force_objects_default_values = true;
	}
	
	/**
	 * Method getUserEventObject
	 * Save the callback method and params from user event
	 * @access public
	 * @return mixed
	 * @since 1.0.35
	 */
	public function getUserEventObject() {
		if ($this->callback_method == "") {
			//$this->addLogDebugRegisterObjects("ComboBox");
			foreach ($this->objects as $class_name => $object_array) {
				$array_class_name = explode('_', $class_name);
				// For all event objects (button, combobox, ...), check if event exists
				if (in_array($array_class_name[0], $this->array_callback_object)) {
					foreach ($object_array as $object) {
						// WARNING if change : This code is almost identical with WebSitePhpEventObject->initSubmitValue(), Page->loadAllVariables()
						 
						// create object name
						if ($object->getFormObject() == null) {
							$name = "Callback_".$this->class_name."_".$object->getName();
						} else {
							if (!in_array($this->class_name."_".$object->getFormObject()->getName(), $this->array_decrypted_form)) {
								decryptRequestEncryptData($object->getFormObject(), $this->class_name."_".$object->getFormObject()->getName()); // decrypt Form data
								$this->array_decrypted_form[] = $this->class_name."_".$object->getFormObject()->getName();
							}
							$name = "Callback_".$this->class_name."_".$object->getFormObject()->getName()."_".$object->getName();
						}
						$form_object = $object->getFormObject();
						// check button form rights (POST or GET) before execute function
						$callback_method = "";
						$callback_params = "";
						if ($form_object == null) { // no form associate to event object
							if (isset($_POST[$name]) && $_POST[$name] != "") {
								list($callback_method, $callback_params) = $this->extractCallbackParameters(decryptRequestEncryptData($object, $name, "POST"));
							} else if (isset($_GET[$name]) && $_GET[$name] != "") {
								list($callback_method, $callback_params) = $this->extractCallbackParameters(decryptRequestEncryptData($object, $name, "GET"));
							}
						} else if ($form_object->getMethod() == "POST") { // form rights is POST
							if (isset($_POST[$name]) && $_POST[$name] != "") {
								list($callback_method, $callback_params) = $this->extractCallbackParameters(decryptRequestEncryptData($object, $name, "POST"));
							}
						} else { // form rights is GET
							if (isset($_GET[$name]) && $_GET[$name] != "") {
								list($callback_method, $callback_params) = $this->extractCallbackParameters(decryptRequestEncryptData($object, $name, "GET"));
							}
						}
						
						if ($callback_method != "") {
							//$this->addLogDebug("Page->getUserEventObject: ".$name." - ".$_REQUEST[$name]." - ".$callback_method);
							
							// ack to set button, textbox, combobox, context menu event (is_clicked, is_changed)
							$save_load_variables = $GLOBALS['__LOAD_VARIABLES__'];
							$GLOBALS['__LOAD_VARIABLES__'] = true;
							if (get_class($object) == "Object" || get_class($object) == "ContextMenuEvent" || 
								get_class($object) == "Picture" || get_class($object) == "AutoCompleteEvent" || 
								get_class($object) == "Raty" || get_class($object) == "CheckBox") {
									$object->setClick();
							} else if (get_class($object) == "DroppableEvent") {
								$object->setDrop();
							} else if (get_class($object) == "SortableEvent") {
								$object->setSort();
							} else if (get_class($object) == "UploadFile") {
								$object->setChange();
							} else {
								$object->setValue($object->getValue());
							}
							$GLOBALS['__LOAD_VARIABLES__'] = $save_load_variables;
							
							$callback_params[0] = $object;
							$this->callback_method_params = $callback_params;
							$this->callback_method = $callback_method;
							$this->callback_object = $object;
							return $object;
						}
					}
				}
			}
			// if method is call from an other page
			foreach ($_REQUEST as $key => $value) {
				if (find($key, "Callback_", 0, 0) > 0 && find($value, get_class($this)."().", 0, 0) > 0 && 
					find($value, ").public_", 0, 0) > 0) {
					list($callback_method, $callback_params) = $this->extractCallbackParameters(str_replace(get_class($this)."().", "", $value));
					
					if ($callback_method != "") {
						$callback_params[0] = $object;
						$this->callback_method_params = $callback_params;
						$this->callback_method = $callback_method;
						$this->callback_object = $object;
						return $object;
					}
				}
			}
		} else {
			return $this->callback_object;
		}
	}
	
	/**
	 * Method executeCallback
	 * Execute method link to the user action
	 * @access public
	 * @since 1.0.33
	 */
	public function executeCallback() {
		$this->getUserEventObject();
		if ($this->callback_method != "" && !$this->callback_method_called) {
			$this->callback_method_called = true;
			for ($i=0; $i < sizeof($this->callback_method_params); $i++) {
			    if ($this->callback_method_params[$i] != "" && gettype($this->callback_method_params[$i]) == "string") {
					// remove quote
					$this->callback_method_params[$i] = trim($this->callback_method_params[$i]);
					if (substr($this->callback_method_params[$i], 0, 1) == "'" || substr($this->callback_method_params[$i], 0, 2) == "\\'") {
						if (substr($this->callback_method_params[$i], 0, 2) == "\\'") {
							$this->callback_method_params[$i] = substr($this->callback_method_params[$i], 2);
						} else {
							$this->callback_method_params[$i] = substr($this->callback_method_params[$i], 1);
						}
					}
					if (substr($this->callback_method_params[$i], strlen($this->callback_method_params[$i])-1, 1) == "'" || substr($this->callback_method_params[$i], strlen($this->callback_method_params[$i])-2, 2) == "\\'") {
						if (substr($this->callback_method_params[$i], strlen($this->callback_method_params[$i])-2, 2) == "\\'") {
							$this->callback_method_params[$i] = substr($this->callback_method_params[$i], 0, strlen($this->callback_method_params[$i])-2);
						} else {
							$this->callback_method_params[$i] = substr($this->callback_method_params[$i], 0, strlen($this->callback_method_params[$i])-1);
						}
					}
					
					if ($this->callback_method_params[$i] != "") {
						// Check if it's a Form parameter (encode in json), in this case we create an array with all the object of the Form
						$is_json = false;
						$tmp_callback_param = json_decode($this->callback_method_params[$i]);
						if ($tmp_callback_param != false && is_array($tmp_callback_param) && sizeof($tmp_callback_param) >= 1) {
							if ($tmp_callback_param[0] == "WSP_Callback_JSON") {
								$tmp_array_callback_params = array();
								for ($j=1; $j < sizeof($tmp_callback_param); $j++) {
									$tmp_array_callback_params[$tmp_callback_param[$j]] = $tmp_callback_param[$j+1];
									$j++;
								}
								$this->callback_method_params[$i] = $tmp_array_callback_params;
								$is_json = true;
							}
						}
						
						// Convert special caracters
	                    $this->callback_method_params[$i] = str_replace("{#wsp_callback_amp}", "&", $this->callback_method_params[$i]);
						$this->callback_method_params[$i] = str_replace("{#wsp_callback_quote}", "'", $this->callback_method_params[$i]);
						
						if (!$is_json) {
							// Search if string is linked with object
	    					$param_object = $this->getObjectId($this->callback_method_params[$i]);
	    					if ($param_object != null) {
	    						$this->callback_method_params[$i] = $param_object;
	    					}
						}
                    }
				}
			}
			if (call_user_func_array(array($this, $this->callback_method), $this->callback_method_params) === false) {
				throw new NewException("Unable to call callback method ".$this->callback_method."!", 0, getDebugBacktrace(1));
			}
		}
	}
	
	/**
	 * Method extractCallbackParameters
	 * @access private
	 * @param string $callback_value 
	 * @return array
	 * @since 1.0.35
	 */
	private function extractCallbackParameters($callback_value) {
		if (find($callback_value, ").public_", 0, 0) > 0) {
			$callback_method = "";
			$callback_params = "";
		} else {
			$pos = find($callback_value, "(", 0, 0);
			$pos2 = strrpos($callback_value, ")");
			$callback_params = ",".substr($callback_value, $pos, $pos2-$pos);
            $callback_method = substr($callback_value, 0, $pos-1);
		}
		
		// Extract parameters
		$array_callback_params = explodeFunky(",", $callback_params);
		return array($callback_method, $array_callback_params);
	}
	
	/**
	 * Method addObject
	 * @access public
	 * @param WebSitePhpObject $object add script after the render of the page (ex: DialogBox, JavaScript, ...)
	 * @param boolean $page_begining [default value: false]
	 * @param boolean $page_ending [default value: false]
	 * @since 1.0.18
	 */
	public function addObject($object, $page_begining=false, $page_ending=false) {
		if (!is_subclass_of($object, "WebSitePhpObject")) {
			throw new NewException("You can't add this object ".get_class($this)." to the page, you must add WebSitePhpObject", 0, getDebugBacktrace(1));
		}
		if ($page_ending || (gettype($object) == "object" && get_class($object) == "DialogBox") || 
			$this->ended_added_object_loaded) {
				$this->add_to_render_ending[] = $object;
		} else if ($page_begining) {
			$this->add_to_render_begining[] = $object;
		} else {
			$this->add_to_render[] = $object;
		}
	}
	
	/**
	 * Method getAddedObjects
	 * @access public
	 * @return array
	 * @since 1.0.18
	 */
	public function getAddedObjects() {
		return array_merge($this->getBeginAddedObjects(), $this->getEndAddedObjects());
	}
		
	/**
	 * Method getBeginAddedObjects
	 * @access public
	 * @return mixed
	 * @since 1.0.95
	 */
	public function getBeginAddedObjects() {
		return $this->add_to_render_begining;
	}
		
	/**
	 * Method getEndAddedObjects
	 * @access public
	 * @return mixed
	 * @since 1.0.95
	 */
	public function getEndAddedObjects() {
		$this->ended_added_object_loaded = true;
		return array_merge($this->add_to_render, $this->add_to_render_ending);
	}
	
	/**
	 * Method getNbEndAddedObjects
	 * @access public
	 * @return mixed
	 * @since 1.0.98
	 */
	public function getNbEndAddedObjects() {
		return sizeof($this->add_to_render) + sizeof($this->add_to_render_ending);
	}
	
	/**
	 * Method addLogDebug
	 * @access public
	 * @param string $str add string to debug consol
	 * @since 1.0.3
	 */
	public function addLogDebug($str) {
		if (sizeof($this->log_debug_str) == 0 && sizeof($_SESSION['log_debug_str_session']) > 0) {
			$this->log_debug_str = $_SESSION['log_debug_str_session'];
			unset($_SESSION['log_debug_str_session']);
		}
		$this->log_debug_str[] = $str;
	}
	
	/**
	 * Method addLogDebugRegisterObjects
	 * @access public
	 * @param string $class_filter 
	 * @since 1.1.6
	 */
	public function addLogDebugRegisterObjects($class_filter='') {
		$register_objects = WebSitePhpObject::getRegisterObjects();
		$this->addLogDebug("<b>RegisterObjects:</b> ");
		for ($i=0; $i < sizeof($register_objects); $i++) {
			if ($class_filter == "" || get_class($register_objects[$i]) == $class_filter) {
				$tmp_log = get_class($register_objects[$i]);
				if (method_exists($register_objects[$i], "getId")) {
					$tmp_log .= ", id=".$register_objects[$i]->getId();
				}
				if (method_exists($register_objects[$i], "getName")) {
					$tmp_log .= ", name=".$register_objects[$i]->getName();
				}
				$this->addLogDebug($tmp_log);
			}
		}
		$this->addLogDebug();
	}
	
	/**
	 * Method getLogDebug
	 * @access public
	 * @return string
	 * @since 1.0.3
	 */
	public function getLogDebug() {
		return $this->log_debug_str;
	}
	
	/**
	 * Method render
	 * Render the page
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function render() {
		if ($this->render == null) {
			throw new NewException("Render object not set for the page ".$this->page." (Please set the variable \$this->render in class ".$this->class_name.")", 0, getDebugBacktrace(1));
		} else {
			$html = "";
			for ($i=0; $i < sizeof($this->add_to_render_begining); $i++) {
				if ($this->add_to_render_begining[$i]->isJavascriptObject()) {
					$html .= $this->add_to_render_begining[$i]->getJavascriptTagOpen();
				}
				if (gettype($this->add_to_render_begining[$i]) == "object" && method_exists($this->add_to_render_begining[$i], "render")) {
					$html .= $this->add_to_render_begining[$i]->render();
				} else {
					$html .= $this->add_to_render_begining[$i];
				}
				$html .= "\n";
				if ($this->add_to_render_begining[$i]->isJavascriptObject()) {
					$html .= $this->add_to_render_begining[$i]->getJavascriptTagClose();
				}
			}
			if (gettype($this->render) == "object" && method_exists($this->render, "render")) {
				$html .= $this->render->render();
			} else {
				$html .= $this->render;
			}
			$html .= "\n";
			$add_to_render = $this->getEndAddedObjects();
			$nb_end_added_object = sizeof($add_to_render);
			for ($i=0; $i < sizeof($add_to_render); $i++) {
				if ($add_to_render[$i]->isJavascriptObject()) {
					$html .= $add_to_render[$i]->getJavascriptTagOpen();
				}
				if (gettype($add_to_render[$i]) == "object" && method_exists($add_to_render[$i], "render")) {
					$html .= $add_to_render[$i]->render();
				} else {
					$html .= $add_to_render[$i];
				}
				$html .= "\n";
				if ($add_to_render[$i]->isJavascriptObject()) {
					$html .= $add_to_render[$i]->getJavascriptTagClose();
				}
				if ($this->getNbEndAddedObjects() > $nb_end_added_object) {
					$add_to_render = $this->getEndAddedObjects();
					$nb_end_added_object = $this->getNbEndAddedObjects();
				}
			}
			if (DEBUG) {
				$html_debug = "";
				for ($i=0; $i < sizeof($this->log_debug_str); $i++) {
					$html_debug .= $this->log_debug_str[$i]."<br/>\n";
				}
				if ($html_debug != "") {
					$html .= "<div style=\"background-color:white;color:black;padding:5px;margin:10px;border:1px solid black;margin-bottom:0px;\" id=\"wsp-log-debug-title\"><img src='wsp/img/drag_arrow_16x16.png' align='absmiddle'/> <b>DEBUG Page ".$this->getPage().".php:</b></div>";
					$html .= "<div style=\"background-color:white;color:black;padding:5px;margin:10px;border:1px solid black;margin-top:0px;\" id=\"wsp-log-debug\">".$html_debug."</div>";
					$html .= "<script type='text/javascript'>function loagDebugZoneFollowDrag() { \$('#wsp-log-debug').css('top', \$('#wsp-log-debug-title').position().top+\$('#wsp-log-debug-title').height()+20);\$('#wsp-log-debug').css('left', \$('#wsp-log-debug-title').position().left);} \$('#wsp-log-debug-title').draggable({start: function( event, ui ) {\$('#wsp-log-debug').css('position', 'absolute');\$('#wsp-log-debug-title').css('width', \$('#wsp-log-debug').css('width'))}, drag: function( event, ui ) {loagDebugZoneFollowDrag();}, stop: function( event, ui ) {loagDebugZoneFollowDrag();}});\$('#wsp-log-debug').resizable({start: function( event, ui ){\$('#wsp-log-debug').css('overflow', 'auto');}, resize: function( event, ui ) {\$('#wsp-log-debug-title').css('width', \$('#wsp-log-debug').css('width'));}});</script>";
				}
			}
			return str_replace("{#BASE_URL#}", BASE_URL, str_replace("{#QUOTE#}", "\"", str_replace("{#SIMPLE_QUOTE#}", "'", $html)));
		}
	}
	
	/**
	 * Method getRenderObject
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getRenderObject() {
		return $this->render;
	}
	
	/**
	 * Method userHaveRights
	 * @access public
	 * @return boolean
	 * @since 1.0.4
	 */
	public function userHaveRights() {
		$user_rights = $this->USER_RIGHTS;
		if (isset($user_rights) && $user_rights != "") {
			if (isset($_SESSION['USER_RIGHTS']) && $_SESSION['USER_RIGHTS'] != "") {
				if (!is_array($user_rights)) {
					$user_rights = array($user_rights);
				}
				if (!is_array($_SESSION['USER_RIGHTS'])) {
					$_SESSION['USER_RIGHTS'] = array($_SESSION['USER_RIGHTS']);
				}
				for ($i=0; $i < sizeof($_SESSION['USER_RIGHTS']); $i++) {
					if (in_array($_SESSION['USER_RIGHTS'][$i], $user_rights)) {
						return true;
					}
				}
			}
			return false;
		}
		return true;
	}
	
	/**
	 * Method setUserRights
	 * @access public
	 * @param string|array $rights 
	 * @return Page
	 * @since 1.0.4
	 */
	public function setUserRights($rights) {
		$_SESSION['USER_RIGHTS'] = $rights;
		return $this;
	}
	
	/**
	 * Method getUserRights
	 * @access public
	 * @return mixed
	 * @since 1.0.93
	 */
	public function getUserRights() {
		return (sizeof($_SESSION['USER_RIGHTS']) == 1?$_SESSION['USER_RIGHTS'][0]:$_SESSION['USER_RIGHTS']);
	}
	
	/**
	 * Method getUserNoRightsRedirect
	 * @access public
	 * @return mixed
	 * @since 1.0.67
	 */
	public function getUserNoRightsRedirect() {
		$url_to_referer = $this->getCurrentURL();
		if (find($this->getCurrentURL(), "referer=") > 0) {
			$pos = find($this->getCurrentURL(), "referer=");
			$pos2 = find($this->getCurrentURL(), "&", $pos);
			if ($pos2 == 0) {
				$pos2 = strlen($this->getCurrentURL());
			} else {
				$pos2--;
			}
			$url_to_referer = urldecode(substr($this->getCurrentURL(), $pos, $pos2-$pos));
		}
		
		if (find($this->USER_NO_RIGHTS_REDIRECT, "referer=") == 0) {
			if (find($this->USER_NO_RIGHTS_REDIRECT, "?") > 0) {
				$this->USER_NO_RIGHTS_REDIRECT .= "&";
			} else {
				$this->USER_NO_RIGHTS_REDIRECT .= "?";
			}
			$this->USER_NO_RIGHTS_REDIRECT .= "referer=".urlencode($url_to_referer);
		}
		
		return $this->USER_NO_RIGHTS_REDIRECT;
	}

	
	/**
	 * Method redirect
	 * @access public
	 * @param string $url 
	 * @since 1.0.33
	 */
	public function redirect($url) {
		// check complete URL
		if (strtoupper(substr($url, 0, 7)) != "HTTP://" && strtoupper(substr($url, 0, 8)) != "HTTPS://") {
			$url = $this->getBaseLanguageURL().$url;
		}
		if ($GLOBALS['__AJAX_PAGE__'] == true) {
			$this->addObject(new JavaScript("location.href='".$url."';"));
		} else {
			$this->cache_time = -1;
			header('HTTP/1.1 301 Moved Temporarily');  
			header('Status: 301 Moved Temporarily');
			header("Location:".$url);
			exit;
		}
	}
	
	/**
	 * Method refreshPage
	 * @access public
	 * @since 1.0.103
	 */
	public function refreshPage() {
		$this->redirect($this->getCurrentURL());
	}
	
	/**
	 * Method redirect404
	 * @access public
	 * @since 1.0.101
	 */
	public function redirect404() {
		$_GET['error'] = 404;
		include(dirname(__FILE__).'/../../../error_doc.php');
		exit;
	}
	
	/**
	 * Method setTimeout
	 * @access public
	 * @param integer $timeout [default value: 30]
	 * @since 1.0.33
	 */
	public function setTimeout($timeout=30) {
		set_time_limit($timeout);
	}
	
	/**
	 * Method getLanguage
	 * @access public
	 * @return string
	 * @since 1.0.2
	 */
	public function getLanguage() {
		return $_SESSION['lang'];
	}

	/**
	 * Method getLanguageLocale
	 * @access public
	 * @return mixed
	 * @since 1.2.7
	 */
	public function getLanguageLocale() {
		$language_locale = "en_US";
		if ($this->getLanguage() != "en") {
			$facebook_language = strtolower($this->getLanguage())."_".strtoupper($this->getLanguage());
		}
		return $language_locale;
	}
	
	/**
	 * Method getCurrentURL
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getCurrentURL() {
		if (!defined('FORCE_SERVER_NAME') || FORCE_SERVER_NAME == "") {
			if ($_SERVER['SERVER_PORT'] == 443) {
				$url = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			} else {
				$port = "";
				if ($_SERVER['SERVER_PORT'] != 80 &&  $_SERVER['SERVER_PORT'] != "") {
					$port = ":".$_SERVER['SERVER_PORT'];
				}
				$url = "http://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
			}
		} else {
			$url = "http://".FORCE_SERVER_NAME.$_SERVER['REQUEST_URI'];
		}
		return str_replace($this->getBaseLanguageURL()."ajax/", $this->getBaseLanguageURL(), $url);
	}
	
	/**
	 * Method getCurrentURLWithoutParameters
	 * @access public
	 * @return mixed
	 * @since 1.2.1
	 */
	public function getCurrentURLWithoutParameters() {
		$current_url = $this->getCurrentURL();
		$current_dir = explode("?", $current_url);
		return $current_dir[0];
	}
	
	/**
	 * Method getCurrentURLDirectory
	 * @access public
	 * @return string
	 * @since 1.0.3
	 */
	public function getCurrentURLDirectory() {
		$current_url = $this->getCurrentURL();
		$current_dir = substr($current_url, 0, strrpos($current_url, "/"))."/";
		return $current_dir;
	}
	
	/**
	 * Method getBaseURL
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function getBaseURL() {
		return BASE_URL;
	}
	
	/**
	 * Method getBaseLanguageURL
	 * @access public
	 * @return string
	 * @since 1.0.3
	 */
	public function getBaseLanguageURL() {
		return BASE_URL.$_SESSION['lang']."/";
	}
	
	/**
	 * Method isLocalhostURL
	 * @access public
	 * @return boolean
	 * @since 1.2.7
	 */
	public function isLocalhostURL() {
		if (getRemoteIp() == "127.0.0.1") {
				return true;
		}
		return false;
	}
	
	/**
	 * Method getRootWspDirectory
	 * @access public
	 * @return mixed
	 * @since 1.2.3
	 */
	public function getRootWspDirectory() {
		return SITE_DIRECTORY;
	}
	
	/**
	 * Method getSubDomainURL
	 * @access public
	 * @return string
	 * @since 1.0.22
	 */
	public function getSubDomainURL() {
		return SUBDOMAIN_URL;
	}
	
	/**
	 * Method getRefererURL
	 * @access public
	 * @return string
	 * @since 1.0.35
	 */
	public function getRefererURL() {
		return $_SERVER['HTTP_REFERER'];
	}

	/**
	 * Method getRemoteIP
	 * @access public
	 * @return mixed
	 * @since 1.0.89
	 */
	public function getRemoteIP() {
		return getRemoteIp();
	}
	
	/**
	 * Method getDocumentHeight
	 * @access public
	 * @return integer
	 * @since 1.0.35
	 */
	public function getDocumentHeight() {
		return ($_COOKIE['wsp_document_height']==""?null:$_COOKIE['wsp_document_height']);
	}
	
	/**
	 * Method getDocumentWidth
	 * @access public
	 * @return integer
	 * @since 1.0.35
	 */
	public function getDocumentWidth() {
		return ($_COOKIE['wsp_document_width']==""?null:$_COOKIE['wsp_document_width']);
	}
	
	/**
	 * Method getWindowHeight
	 * @access public
	 * @return integer
	 * @since 1.0.35
	 */
	public function getWindowHeight() {
		return ($_COOKIE['wsp_window_height']==""?null:$_COOKIE['wsp_window_height']);
	}
	
	/**
	 * Method getWindowWidth
	 * @access public
	 * @return integer
	 * @since 1.0.35
	 */
	public function getWindowWidth() {
		return ($_COOKIE['wsp_window_width']==""?null:$_COOKIE['wsp_window_width']);
	}
	
	/**
	 * Method isAjaxPage
	 * @access public
	 * @return boolean
	 * @since 1.0.35
	 */
	public function isAjaxPage() {
		if ($GLOBALS['__AJAX_LOAD_PAGE__'] == true) {
			return false;
		} else if ($GLOBALS['__AJAX_PAGE__'] == true) {
			return true;
		}
		return false;
	}
	
	/**
	 * Method isAjaxLoadPage
	 * @access public
	 * @return boolean
	 * @since 1.0.24
	 */
	public function isAjaxLoadPage() {
		if ($GLOBALS['__AJAX_LOAD_PAGE__'] == true) {
			return true;
		}
		return false;
	}
	
	/**
	 * Method getBrowserInfo
	 * @access private
	 * @return mixed
	 * @since 1.1.8
	 */
	private function getBrowserInfo() {
		if ($this->browser == null) {
			if (isset($_SESSION['browser_info'])) {
				$this->browser = $_SESSION['browser_info'];
			} else {
				$this->browser = get_browser_info(null, true);
				$_SESSION['browser_info'] = $this->browser;
			}
		}
		return $this->browser;
	}
	
	/**
	 * Method isCss3Browser
	 * @access public
	 * @return boolean
	 * @since 1.0.35
	 */
	public function isCss3Browser() {
		if ($this->browser == null) {
			$this->browser = $this->getBrowserInfo();
		}
		return ($this->browser['cssversion'] >= 3)?true:false;
	}
	
	/**
	 * Method isMobileDevice
	 * @access public
	 * @return boolean
	 * @since 1.0.35
	 */
	public function isMobileDevice() {
		if (find($this->getBrowserUserAgent(), " Mobile ") > 0) {
			return true;
		}
		if ($this->browser == null) {
			$this->browser = $this->getBrowserInfo();
		}
		if (is_bool($this->browser['ismobiledevice'])) {
			return $this->browser['ismobiledevice'];
		} else {
			return (trim($this->browser['ismobiledevice'])=="true")?true:false;
		}
	}
	
	/**
	 * Method isCrawlerBot
	 * @access public
	 * @return boolean
	 * @since 1.0.80
	 */
	public function isCrawlerBot() {
		if ($this->browser == null) {
			$this->browser = $this->getBrowserInfo();
		}
		$is_crawler = false;
		if (is_bool($this->browser['crawler'])) {
			$is_crawler = $this->browser['crawler'];
		} else {
			$is_crawler = (trim($this->browser['crawler'])=="true")?true:false;
		}
		if (!$is_crawler) {
			if (file_exists(dirname(__FILE__)."/../../config/crawlers.cnf")) {
				$custom_crawlers = file_get_contents(dirname(__FILE__)."/../../config/crawlers.cnf");
				$array_custom_crawlers = explode("\n", str_replace("\r", "", $custom_crawlers));
				for ($i=0; $i < sizeof($array_custom_crawlers); $i++) {
					if ($array_custom_crawlers[$i][0] == "#" || trim($array_custom_crawlers[$i]) == "") {
						continue;
					} else if (find($this->getBrowserUserAgent(), $array_custom_crawlers[$i]) > 0) {
						$is_crawler = true;
						break;
					}
				}
			}
		}
		return $is_crawler;
	}
	
	/**
	 * Method getBrowserName
	 * @access public
	 * @return string
	 * @since 1.0.62
	 */
	public function getBrowserName() {
		if ($this->browser == null) {
			$this->browser = $this->getBrowserInfo();
		}
		return $this->browser[browser];
	}
	
	/**
	 * Method getBrowserVersion
	 * @access public
	 * @return string
	 * @since 1.0.62
	 */
	public function getBrowserVersion() {
		if ($this->browser == null) {
			$this->browser = $this->getBrowserInfo();
		}
		return $this->browser[version];
	}
	
	/**
	 * Method getBrowserUserAgent
	 * @access public
	 * @return mixed
	 * @since 1.0.102
	 */
	public function getBrowserUserAgent() {
		return $_SERVER['HTTP_USER_AGENT'];
	}
	
	/**
	 * Method includeJsAndCssFromObjectToPage
	 * Use to add JS and CSS to the page when Object never load on init, but load dynamically (on DialogBox, Map, ...)
	 * @access public
	 * @param string $str_object 
	 * @since 1.0.33
	 */
	public function includeJsAndCssFromObjectToPage($str_object) {
		$this->create_object_to_get_css_js = true;
		if (find($str_object, "(", 0, 0) > 0) {
			eval("\$temp_obj = new ".$str_object.";");
		} else {
			$temp_obj = new $str_object();
		}
		$js_array = $temp_obj->getJavaScriptArray();
		for ($i=0; $i < sizeof($js_array); $i++) {
			JavaScriptInclude::getInstance()->add($js_array[$i]);
		}
		$css_array = $temp_obj->getCssArray();
		for ($i=0; $i < sizeof($css_array); $i++) {
			CssInclude::getInstance()->add($css_array[$i]);
		}
		$this->create_object_to_get_css_js = false;
	}
	
	/**
	 * Method displayExecutionTime
	 * @access public
	 * @param string $info 
	 * @since 1.0.92
	 */
	public function displayExecutionTime($info='') {
		$wspPageTotalTime = elog_time($_SESSION['wspPageStartTime']);
     	echo "<b>Execution Time".($info!=""?" ".$info:"").":</b> ".round($wspPageTotalTime,3)." Seconds<br/>";
	}
	
	/**
	 * Method addLogDebugExecutionTime
	 * @access public
	 * @param string $info 
	 * @since 1.0.93
	 */
	public function addLogDebugExecutionTime($info='') {
		$wspPageTotalTime = elog_time($_SESSION['wspPageStartTime']);
     	$this->addLogDebug("<b>Execution Time".($info!=""?" ".$info:"").":</b> ".round($wspPageTotalTime,3)." Seconds");
	}
	
	/**
	 * Method setMobileMetaTag
	 * @access public
	 * @param boolean $bool [default value: true]
	 * @return Page
	 * @since 1.1.4
	 */
	public function setMobileMetaTag($bool=true) {
		$this->is_mobile_meta_tag = $bool;
		return $this;
	}
	
	/**
	 * Method isMobileMetaTag
	 * @access public
	 * @return mixed
	 * @since 1.1.4
	 */
	public function isMobileMetaTag() {
		return $this->is_mobile_meta_tag;
	}
	
	/**
	 * Method setMobileWebAppMetaTag
	 * @access public
	 * @param boolean $bool [default value: true]
	 * @return Page
	 * @since 1.2.7
	 */
	public function setMobileWebAppMetaTag($bool=true) {
		$this->is_mobile_webapp_meta_tag = $bool;
		return $this;
	}
	
	/**
	 * Method isMobileWebAppMetaTag
	 * @access public
	 * @return mixed
	 * @since 1.2.7
	 */
	public function isMobileWebAppMetaTag() {
		return $this->is_mobile_webapp_meta_tag;
	}
	
	/**
	 * Method getCacheDirectory
	 * @access public
	 * @return mixed
	 * @since 1.2.7
	 */
	public function getCacheDirectory() {
		$cache_directory = SITE_DIRECTORY."/wsp/cache";
		if (defined("CACHE_DIRECTORY") && CACHE_DIRECTORY != "") {
			if (is_dir(CACHE_DIRECTORY)) {
				$cache_directory = CACHE_DIRECTORY;
			} else if (is_dir(SITE_DIRECTORY.CACHE_DIRECTORY)) {
				$cache_directory = SITE_DIRECTORY.CACHE_DIRECTORY;
			}
		}
		return $cache_directory;
	}
}
?>
