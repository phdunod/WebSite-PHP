<?php
define("SITE_NAME", "Your Website");
define("SITE_DESC", "Your description");
define("SITE_KEYS", "key1,key2,...");
define("SITE_RATING", "general"); // general, mature, restricted, 14years
define("SITE_AUTHOR", "Your name");
define("SITE_DEFAULT_LANG", "en"); // en, fr, ...

define("GOOGLE_CODE_TRACKER", "");
define("GOOGLE_MAP_KEY", "");

define("SITE_META_ROBOTS", "index, follow");
define("SITE_META_GOOGLEBOTS", "archive");
define("SITE_META_REVISIT_AFTER", 1);

define("CACHING_ALL_PAGES", false); // If use user rights, warning, you may have rights problems
define("CACHE_TIME", 0); // 12 heures = 60*60*12

define("DEFINE_JQUERY_LOAD_LOCAL", true); // if false load jquery from google else load from local 
define("JS_COMPRESSION_TYPE", "NONE"); // type of Javascript compression (GOOGLE_WS, LOCAL, NONE) 

define("DEBUG", false); // autorize use of method addLogDebug
define("FORCE_SERVER_NAME", ""); // Force site base url (problem with redirect), whithout http:// (ex: www.website-php.com)
?>