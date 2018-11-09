<style>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * CometChat 
 * Copyright (c) 2014 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-weight: inherit;
	font-style: inherit;
	font-size: 100%;
	font-family: inherit;
	vertical-align: baseline;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
}

.container {
	width: 100%;
	margin-top: 5px;
}

.container_title {
	background-color: <?php echo $themeSettings['tab_title_background'];?> !important;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $themeSettings['tab_title_gradient_start'];?>', endColorstr='<?php echo $themeSettings['tab_title_gradient_end'];?>');
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $themeSettings['tab_title_gradient_start'];?>), to(<?php echo $themeSettings['tab_title_gradient_end'];?>));
	background: -moz-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	background: -ms-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	background: -o-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	border-left: 1px solid <?php echo $themeSettings['tab_title_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_title_border'];?>;
	border-top: 1px solid <?php echo $themeSettings['tab_title_border'];?>;
	color: <?php echo $themeSettings['tab_title_color'];?>;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_title_font_size_large'];?>;
	padding: 5px;
	font-weight: bold;
	padding-left: 10px;
	padding-bottom: 6px;
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
}

.container_body {
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	background-color: <?php echo $themeSettings['tab_background'];?>;
	color: <?php echo $themeSettings['tab_color'];?>;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	padding: 10px 10px;
	height: 130px;
	overflow-x: hidden;
	overflow-y: scroll;
}

.container_body.embed {
	border: 0px;
	padding: 10px;
}

.container_title.embed {
	display: none;
}

.invite_1 {
	cursor: pointer;
	position: relative;
	height: 30px;
	float: left;
	width: 159px;
	border: 1px dotted <?php echo $themeSettings['tab_border_light'];?>;
	padding: 3px;
	margin: 4px;
}

.invite_2 {
	float: left;
}

.invite_3 {
	float: left;
	padding-<?php echo $left;?>: 10px;
        max-width: 100px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
}

.invite_4 {
	position: absolute;
	right: 4px;
	top: 4px;
}

.invite_5 {
	color: <?php echo $themeSettings['tab_sub_color'];?>;
}

.invite_name{
	text-overflow: ellipsis;
	overflow: hidden;
	width: 100px;
	float: left;
	white-space:nowrap;
}

.invitebutton {
	background-color: <?php echo $themeSettings['tab_title_background'];?> !important;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $themeSettings['tab_title_gradient_start'];?>', endColorstr='<?php echo $themeSettings['tab_title_gradient_end'];?>');
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $themeSettings['tab_title_gradient_start'];?>), to(<?php echo $themeSettings['tab_title_gradient_end'];?>));
	background: -moz-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	background: -ms-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	background: -o-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	border: 1px solid <?php echo $themeSettings['tab_title_border'];?>;
	color: <?php echo $themeSettings['tab_title_color'];?>;
	cursor: pointer;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	font-weight: bold;
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
	padding: 3px;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;	
	-moz-border-radius-bottomleft: 3px;
	-moz-border-radius-bottomright: 3px;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
	-webkit-border-bottom-left-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
}

.container_sub {
	background-color: <?php echo $themeSettings['tab_sub_background'];?>;
	color: <?php echo $themeSettings['tab_sub_color'];?>;
	padding: 5px;
}

.cometchat_closebox {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 4px -973px;
	float: right;
	height: 12px;
	
	width: 21px;
	cursor: pointer;

	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}

.cometchat_closebox:hover {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

.cometchat_closebox_bottom {
	background: url(themes<?php echo $theme;?>images/cometchat.png) no-repeat top left;
	background-position: 1px -1010px;
	float: right;
	height: 12px;	
	width: 16px;
}

.cometchat_closebox_bottom_click {
	background-position: 0px -1010px !important;
	
}

.cometchat_closebox_bottomhover {
	background-position: 1px -1047px !important;
	
}

</style>