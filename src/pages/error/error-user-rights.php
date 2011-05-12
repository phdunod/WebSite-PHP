<?php
/**
 * PHP file pages\error\error-user-rights.php
 */
/**
 * Page error-user-rights
 * URL: http://127.0.0.1/website-php/error/error-user-rights.html
 *
 * WebSite-PHP : PHP Framework 100% object (http://www.website-php.com)
 * Copyright (c) 2009-2011 WebSite-PHP.com
 * PHP versions >= 5.2
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @author      Emilien MOREL <admin@website-php.com>
 * @link        http://www.website-php.com
 * @copyright   WebSite-PHP.com 03/10/2010
 * @version     1.0.77
 * @access      public
 * @since       1.0.18
 */

require_once(dirname(__FILE__)."/error-template.php");

class ErrorUserRights extends Page {
	function __construct() {}
	
	public function Load() {
		parent::$PAGE_TITLE = __(ERROR_USER_RIGHTS)." - ".SITE_NAME;
		parent::$PAGE_META_ROBOTS = "noindex, nofollow";
		
		$obj_error_msg = new Object(new Picture("wsp/img/warning.png", 48, 48, 0, "absmidlle"), "<br/>", new Label(__(ERROR_USER_RIGHTS_MSG)));
		$obj_error_msg->add("<br/><br/>", __(MAIN_PAGE_GO_BACK), new Link(BASE_URL, Link::TARGET_NONE, SITE_NAME));
		
		$this->render = new ErrorTemplate($this, $obj_error_msg, __(ERROR_USER_RIGHTS));
	}
}
?>
