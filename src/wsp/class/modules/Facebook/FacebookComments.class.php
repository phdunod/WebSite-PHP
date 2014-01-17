<?php 
/**
 * PHP file wsp\class\modules\Facebook\FacebookComments.class.php
 * @package modules
 * @subpackage Facebook
 */
/**
 * Class FacebookComments
 *
 * WebSite-PHP : PHP Framework 100% object (http://www.website-php.com)
 * Copyright (c) 2009-2014 WebSite-PHP.com
 * PHP versions >= 5.2
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @package modules
 * @subpackage Facebook
 * @author      Emilien MOREL <admin@website-php.com>
 * @link        http://www.website-php.com
 * @copyright   WebSite-PHP.com 17/01/2014
 * @version     1.2.7
 * @access      public
 * @since       1.0.86
 */

class FacebookComments extends WebSitePhpObject {
	/**#@+
	* FacebookComments style
	* @access public
	* @var string
	*/
	const STYLE_LIGHT = "light";
	const STYLE_DARK = "dark";
	/**#@-*/
	
	/**#@+
	* @access private
	*/
	private $url_to_comment = "";
	private $number_post = 2;
	private $width = 500;
	private $style = FacebookComments::STYLE_LIGHT;
	/**#@-*/
	
	/**
	 * Constructor FacebookComments
	 * @param string $url_to_comment 
	 * @param double $number_post [default value: 2]
	 * @param double $width [default value: 500]
	 * @param string $style [default value: light]
	 */
	function __construct($url_to_comment='', $number_post=2, $width=500, $style='light') {
		parent::__construct();
		
		if ($url_to_comment == "") {
			$this->url_to_comment = $this->getPage()->getCurrentURLWithoutParameters();
		} else {
			$this->url_to_comment = $url_to_comment;
		}
		$this->number_post = $number_post;
		$this->width = $width;
		$this->style = $style;
	}

	/**
	 * Method setNumberPost
	 * @access public
	 * @param mixed $number_post 
	 * @return FacebookComments
	 * @since 1.0.86
	 */
	public function setNumberPost($number_post) {
		$this->number_post = $number_post;
		return $this;
	}
	
	/**
	 * Method setStyle
	 * @access public
	 * @param mixed $style 
	 * @return FacebookComments
	 * @since 1.0.86
	 */
	public function setStyle($style) {
		$this->style = $style;
		return $this;
	}
	
	/**
	 * Method setWidth
	 * @access public
	 * @param integer $width 
	 * @return FacebookComments
	 * @since 1.0.86
	 */
	public function setWidth($width) {
		$this->width = $width;
		return $this;
	}
	
	/**
	 * Method render
	 * @access public
	 * @param boolean $ajax_render [default value: false]
	 * @return string html code of object FacebookComments
	 * @since 1.0.86
	 */
	public function render($ajax_render=false) {
		$facebook_language = $this->getPage()->getLanguageLocale();
		$html = "<div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/".$facebook_language."/all.js#xfbml=1\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class=\"fb-comments\" data-href=\"".$this->url_to_comment."\" data-numposts=\"".$this->number_post."\" data-width=\"".$this->width."\" data-colorscheme=\"".$this->style."\" style=\"border:none; overflow:hidden;background-color:".($this->style=="dark"?"black":"white")."; width:".$this->width."px;\"></div>";
		
		return $html;
	}
}
?>
