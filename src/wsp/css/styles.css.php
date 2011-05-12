<?php 
	include_once("../includes/utils_session.inc.php");
	session_name(formalize_to_variable(SITE_NAME));
	session_start();
	
	include_once("../config/config_css.inc.php"); 
	
	header("Content-type: text/css");
	header("Cache-control: public");
  
	$zlib_OC_is_set = preg_match('/On|(^[0-9]+$)/i', ini_get('zlib.output_compression'));
	if ($zlib_OC_is_set) { header("Content-Encoding: gzip"); }
	
	$expires = 60*60*24; // 24 hours
	header("Pragma: public");
	header("Cache-Control: maxage=".$expires);
	header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');

	if (!defined('DEFINE_STYLE_COLOR_2_HEADER_LINK')) {
		define("DEFINE_STYLE_COLOR_2_HEADER_LINK", "");
	}
	if (!defined('DEFINE_STYLE_COLOR_2_HEADER_LINK_HOVER')) {
		define("DEFINE_STYLE_COLOR_2_HEADER_LINK_HOVER", "");
	}
	
	if (!defined('DEFINE_STYLE_FONT')) {
		define("DEFINE_STYLE_FONT", "Arial");
	}
	$style_font_value = DEFINE_STYLE_FONT;
	if ($style_font_value == "") {
		$style_font_value = "\"Arial\"";
	}
	if ($style_font_value != "\"Arial\"") {
		$style_font_value .= ", \"Arial\"";
	}
	if (!defined('DEFINE_STYLE_FONT_SIZE')) {
		define("DEFINE_STYLE_FONT_SIZE", "10pt");
	}
	$style_font_size_value = DEFINE_STYLE_FONT_SIZE;
	if ($style_font_size_value == "") {
		$style_font_size_value = "10pt";
	}
	if (!defined('DEFINE_STYLE_FONT_SERIF')) {
		define("DEFINE_STYLE_FONT_SERIF", "sans serif");
	}
	$style_font_serif_value = DEFINE_STYLE_FONT_SERIF;
	if ($style_font_serif_value == "") {
		$style_font_serif_value = "sans serif";
	}
?>
/*** Global ***/
body {
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	background:<?php echo DEFINE_STYLE_BCK_BODY; ?>;
	color: <?php echo DEFINE_STYLE_COLOR_BODY; ?>;
	margin:0px;
	padding:3px;
	height:100%;
	overflow-y:auto;
}

form {
	display: block;
	margin: 0 0 0 0;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}
blockquote {
	display: block;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 20px;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}
p {
	margin-top: 2px;
	margin-bottom: 2px;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}

h1 {
	font-weight:bold;
	margin:0;
	padding:0;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	display: inline;
}

h2, h3, h4, h5, h6 {
	font-weight:normal;
	margin:0;
	padding:0;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	display: inline;
}

/*** Liens ***/
a,.link {
	color:<?php echo DEFINE_STYLE_LINK_COLOR; ?>;
	text-decoration: none;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}

a:hover,.link:hover {
	color: <?php echo DEFINE_STYLE_LINK_HOVER_COLOR; ?>;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}

<?php
for ($i=1; $i <= NB_DEFINE_STYLE_BCK; $i++) {
	if (!defined('DEFINE_STYLE_COLOR_'.$i.'_HEADER_LINK')) {
		define("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK", "");
	}
	if (!defined('DEFINE_STYLE_COLOR_'.$i.'_HEADER_LINK_HOVER')) {
		define("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK_HOVER", "");
	}
	if (!defined('DEFINE_STYLE_COLOR_'.$i.'_LINK')) {
		define("DEFINE_STYLE_COLOR_".$i."_LINK", "");
	}
	if (!defined('DEFINE_STYLE_COLOR_'.$i.'_LINK_HOVER')) {
		define("DEFINE_STYLE_COLOR_".$i."_LINK_HOVER", "");
	}
?>
/*** Tableau <?php echo $i; ?> Header ***/
.header_<?php echo $i; ?>_bckg {
	background: <?php echo constant("DEFINE_STYLE_BCK_".$i."_HEADER"); ?>;
	color: <?php echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER"); ?>;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	font-weight: bold;
	height: 21px;
	padding-left: 5px;
	vertical-align: middle;
	text-align: left;
}
.header_<?php echo $i; ?>_bckg a {
	color:<?php if (constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK") == "") { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER"); } else { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK"); } ?>;
	text-decoration: none;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}
.header_<?php echo $i; ?>_bckg a:hover {
	color: <?php if (constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK_HOVER") == "") { if (constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK") == "") { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER"); } else { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK"); } } else { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK_HOVER"); } ?>;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}

/*** Tableau <?php echo $i; ?> ***/
.table_<?php echo $i; ?>_angle {
	border-left: 1px solid <?php echo constant("DEFINE_STYLE_BORDER_TABLE_".$i); ?>;
	border-right: 1px solid <?php echo constant("DEFINE_STYLE_BORDER_TABLE_".$i); ?>;
	border-bottom: 1px solid <?php echo constant("DEFINE_STYLE_BORDER_TABLE_".$i); ?>;
	background: <?php echo constant("DEFINE_STYLE_BCK_".$i."_HEADER"); ?>;
	color: <?php echo constant("DEFINE_STYLE_COLOR_".$i); ?>;
	padding-right:-10px;
}
.table_<?php echo $i; ?> {
	background: <?php echo constant("DEFINE_STYLE_BCK_".$i); ?>;
	color: <?php echo constant("DEFINE_STYLE_COLOR_".$i); ?>;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	text-align: left;
}
.table_<?php echo $i; ?>_bckg {
	border: 0px;
	background: <?php echo constant("DEFINE_STYLE_BCK_".$i); ?>;
	color: <?php echo constant("DEFINE_STYLE_COLOR_".$i); ?>;
	padding-left: 5px;
	padding-right: 5px;
	text-align: left;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}
.table_<?php echo $i; ?>_bckg a,a.box_style_<?php echo $i; ?>:link {
	color: <?php if (constant("DEFINE_STYLE_COLOR_".$i."_LINK") != "") { echo constant("DEFINE_STYLE_COLOR_".$i."_LINK"); } else { echo DEFINE_STYLE_LINK_COLOR; } ?>;
	text-decoration: none;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}

.table_<?php echo $i; ?>_bckg a:hover,a.box_style_<?php echo $i; ?>:hover {
	color: <?php if (constant("DEFINE_STYLE_COLOR_".$i."_LINK_HOVER") != "") { echo constant("DEFINE_STYLE_COLOR_".$i."_LINK_HOVER"); } else { echo DEFINE_STYLE_LINK_HOVER_COLOR; } ?>;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}

.bckg_<?php echo $i; ?> {
	background: <?php echo constant("DEFINE_STYLE_BCK_".$i); ?>;
	color: <?php echo constant("DEFINE_STYLE_COLOR_".$i); ?>;
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	text-align: left;
}

.table_<?php echo $i; ?>_round {
	background: <?php echo constant("DEFINE_STYLE_BCK_".$i."_HEADER"); ?>;
}
<?php
}

for ($i=1; $i <= NB_DEFINE_STYLE_BCK; $i++) {
?>
/*** Box Header <?php echo $i; ?> ***/
.header_<?php echo $i; ?>_bckg_a a {
	color:<?php if (constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK") == "") { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER"); } else { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK"); } ?>;
	text-decoration: none;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}
.header_<?php echo $i; ?>_bckg_a a:hover {
	color: <?php if (constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK_HOVER") == "") { if (constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK") == "") { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER"); } else { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK"); } } else { echo constant("DEFINE_STYLE_COLOR_".$i."_HEADER_LINK_HOVER"); } ?>;
	font-size:<?php echo $style_font_size_value; ?>;
	font-family:<?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
}
<?php
}
?>

td {
	font-size: <?php echo $style_font_size_value; ?>;
	font-family: <?php echo $style_font_value; ?>, <?php echo $style_font_serif_value; ?>;
	text-align: left;
}

.draggable {
  cursor: move;
  position: absolute;
  z-index:2;
}
.droppablehover {
  border: 2px dashed #aaa; 
}

.info, .success, .warning, .error, .validation {
border: 1px solid;
margin: 10px 0px;
padding:15px 10px 15px 50px;
background-repeat: no-repeat;
background-position: 10px center;
}
.info {
color: #00529B;
background-color: #BDE5F8;
background-image: url('../wsp/img/msg/info.png');
}
.success {
color: #4F8A10;
background-color: #DFF2BF;
background-image:url('../wsp/img/msg/success.png');
}
.warning {
color: #9F6000;
background-color: #FEEFB3;
background-image: url('../wsp/img/msg/warning.png');
}
.error {
color: #D8000C;
background-color: #FFBABA;
background-image: url('../wsp/img/msg/error.png');
}
