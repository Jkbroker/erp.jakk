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

html {
	overflow-y: -moz-scrollbars-vertical;
}

body {
	padding-bottom: 30px;
}

#cometchat * {
    box-sizing: content-box !important;
    -moz-box-sizing: content-box !important;
    -o-box-sizing: content-box !important;
}

#cometchat_hidden * {
    box-sizing: content-box !important;
    -moz-box-sizing: content-box !important;
    -o-box-sizing: content-box !important;
}

#cometchat *:after, #cometchat *:before {
    content: none !important;
}

#cometchat {
	font-size: normal;
	font-size-adjust: none;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	line-height: normal;
	z-index: 100000;	
	direction: <?php echo $dir;?>;
}

#cometchat_base, #cometchat_base *, .cometchat_chatboxmessage {
	overflow: visible;
}

#cometchat_base {
        margin-left: 1px;
        background-color: <?php echo $themeSettings['bar_background'];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $themeSettings['bar_gradient_start'];?>', endColorstr='<?php echo $themeSettings['bar_gradient_end'];?>');
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $themeSettings['bar_gradient_start'];?>), to(<?php echo $themeSettings['bar_gradient_end'];?>));
	background: -moz-linear-gradient(top, <?php echo $themeSettings['bar_gradient_start'];?>, <?php echo $themeSettings['bar_gradient_end'];?>);
	background: -ms-linear-gradient(top, <?php echo $themeSettings['bar_gradient_start'];?>, <?php echo $themeSettings['bar_gradient_end'];?>);
	background: -o-linear-gradient(top, <?php echo $themeSettings['bar_gradient_start'];?>, <?php echo $themeSettings['bar_gradient_end'];?>);
	bottom: 0px;        
	display: block;
	font-family: <?php echo $themeSettings['bar_font_family'];?>;
	font-size: <?php echo $themeSettings['bar_font_size'];?>;
	height: 25px;
	left: 15px;
	position: fixed;
	z-index: 100000;
	-moz-border-radius-topleft: 3px;
	-webkit-border-top-left-radius: 3px;
	-moz-border-radius-topright: 3px;
	-webkit-border-top-right-radius: 3px;
}

#cometchat_chatboxes {
	float: right;
	height: 25px;
	overflow: hidden;
}

#cometchat_chatboxes_wide {
	height: 25px;
	width: 0px;
	overflow: hidden;
}

#cometchat_chatbox_left {
	border-top: 1px solid <?php echo $themeSettings['bar_border'];?>;
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 3px -350px;
	border-left: 1px solid <?php echo $themeSettings['bar_border'];?>;
	color: <?php echo $themeSettings['bar_color'];?>;
	cursor: pointer;
	float: right;
	height: 18px;
	margin-top: 1px;
	padding-left: 11px;
	padding-top: 6px;
	width: 10px;
}

#cometchat_chatbox_right {
	border-top: 1px solid <?php echo $themeSettings['bar_border'];?>;
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 11px -572px;
	border-left: 1px solid <?php echo $themeSettings['bar_border'];?>;
	color: <?php echo $themeSettings['bar_color'];?>;
	cursor: pointer;
	float: right;
	height: 18px;
	margin-top: 1px;
	padding-left: 3px;
	padding-top: 6px;
	width: 17px;
}

.cometchat_chatbox_right_last {
	background-position: 11px -611px !important;
	color: <?php echo $themeSettings['bar_color_disabled'];?> !important;
	cursor: default !important;
}

.cometchat_chatbox_left_last {
	background-position: 3px -389px !important;
	color: <?php echo $themeSettings['bar_color_disabled'];?> !important;
	cursor: default !important;
}

.cometchat_chatbox_lr {
	display: none !important;
}

.cometchat_chatbox_lr_mouseover {
	background-color: <?php echo $themeSettings['tab_background'];?> !important;
}

/* Add display:none for below to hide options and whos online tab */

#cometchat_optionsbutton {
	border-right: 1px solid <?php echo $themeSettings['bar_border'];?>;
	width: 25px;
}

#cometchat_userstab {
	padding-left: 9px;
        width: 176px;
	border-right: 1px solid <?php echo $themeSettings['bar_border'];?>;
}

.cometchat_userstabclick {
	background-position: 5px 3px !important;
	padding-left: 8px !important;
        width: 177px !important;
}

.cometchat_closebox {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 4px -973px;
	float: <?php echo $right;?>;
	height: 12px;
	width: 21px;
	cursor: pointer;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
        text-indent: -999999px;
}

.cometchat_closebox:hover {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

.cometchat_maxwindow {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 1px  -1175px;
	float: <?php echo $right;?>;
	height: 15px;
	width: 15px;
	cursor: pointer;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}

.cometchat_popwindow {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 1px -1112px;
	float: <?php echo $right;?>;	
	cursor: pointer;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
        height: 12px;	
	width: 16px;
}

.cometchat_closebox:hover, .cometchat_maxwindow:hover , .cometchat_popwindow:hover{
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

.cometchat_closebox_bottom {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
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

.cometchat_chatboxmouseoverclose {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

.cometchat_name {
	cursor: default;
	color: <?php echo $themeSettings['tab_title_color'];?>;
	float: <?php echo $left;?>;
	font-family: inherit;
	font-size: inherit;
}

#cometchat_chatbox_buttons {
	float: right;
}

.cometchat_tabmouseover {
	color: <?php echo $themeSettings['tab_color'];?> !important;
	background-color: <?php echo $themeSettings['tab_background'];?> !important;
}

.cometchat_tabmouseovertext {
	text-decoration: underline;
}

.cometchat_statusinputs {
	border-top: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	margin-top: 10px;
	padding-left: 5px;
	padding-top: 4px;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
}

.cometchat_tab {
	background-color: <?php echo $themeSettings['bar_background'];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $themeSettings['bar_gradient_start'];?>', endColorstr='<?php echo $themeSettings['bar_gradient_end'];?>');
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $themeSettings['bar_gradient_start'];?>), to(<?php echo $themeSettings['bar_gradient_end'];?>));
	background: -moz-linear-gradient(top, <?php echo $themeSettings['bar_gradient_start'];?>, <?php echo $themeSettings['bar_gradient_end'];?>);
	background: -ms-linear-gradient(top, <?php echo $themeSettings['bar_gradient_start'];?>, <?php echo $themeSettings['bar_gradient_end'];?>);
	background: -o-linear-gradient(top, <?php echo $themeSettings['bar_gradient_start'];?>, <?php echo $themeSettings['bar_gradient_end'];?>);
	border-top: 1px solid <?php echo $themeSettings['bar_border'];?>;
	border-left: 1px solid <?php echo $themeSettings['bar_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['bar_border_light'];?>;
	color: <?php echo $themeSettings['bar_color'];?>;
	cursor: pointer;
	float: right;
	font-weight: bold;
	height: 20px;
	line-height: 1.2em;
	padding-left: 10px;
	padding-top: 5px;	
	font-family: <?php echo $themeSettings['bar_font_family'];?>;
	font-size: <?php echo $themeSettings['bar_font_size'];?>;
	text-shadow: 1px 1px 0px <?php echo $themeSettings['bar_text_background'];?>;
	width: 140px;
}

.cometchat_tabclick {
	background: <?php echo $themeSettings['tab_background'];?> !important;
	border-top: 0px !important;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border'];?> !important;
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?> !important;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?> !important;
	color: <?php echo $themeSettings['tab_color'];?> !important;
	padding-bottom: 1px;
	padding-top: 4px !important;	
	text-decoration: underline;
	-moz-border-radius-bottomleft: 3px;
	-moz-border-radius-bottomright: 3px;
	-webkit-border-bottom-left-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
}

.cometchat_usertabclick {
	padding-left: 9px !important;	
	width: 141px !important;
}

.cometchat_tabpopup {
	background-color: <?php echo $themeSettings['tab_background'];?>;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	position: fixed;	
	width: <?php echo $chatboxWidth.'px';?>;
	z-index: 100001;
	bottom: 25px;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
}

#cometchat_userstab_popup {
	width: 224px;
}

#cometchat_optionsbutton_popup {
	width: 224px;
}

.cometchat_tabopen {
	display: block !important;
}

.cometchat_tabtitle {
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
	cursor: pointer;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_title_font_size'];?>;
	font-weight: bold;
	padding: 5px;
	padding-<?php echo $right;?>: 0px;	
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;	
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
}

.cometchat_userstabtitle {
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
	cursor: pointer;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_title_font_size'];?>;
	font-weight: bold;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;
	padding: 5px;	
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
}

.cometchat_userstabtitle div {
	color: <?php echo $themeSettings['tab_title_color'];?>;
}

.cometchat_userstabtitletext {
	float: <?php echo $left;?>;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
}

.cometchat_tabsubtitle {
	background-color: <?php echo $themeSettings['tab_sub_background'];?>;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	color: <?php echo $themeSettings['tab_sub_color'];?>;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size_small'];?>;
	line-height: 1.3em !important;
	padding: 5px;	
}

.cometchat_plugins {
	padding-<?php echo $right;?>: 5px;
	padding-top: 2px;
}

.cometchat_pluginsicon {
        background: url(themes/<?php echo $theme;?>/images/cometchat_plugin_icon.png) no-repeat top left;
	cursor: pointer;
	margin-<?php echo $right;?>: 5px;	
	margin-top: 4px;
        float: <?php echo $left;?>;
}

.cometchat_pluginsicon:hover {
	-moz-opacity: 0.6;
	opacity: 0.6;
}

.cometchat_pluginsicon_divider {
	margin-<?php echo $right;?>: 5px;	
}

.cometchat_tabcontent {
	background-color: <?php echo $themeSettings['tab_background'];?>;
        background-image: url("themes/standard/images/tabbottom.gif");
	background-position: left bottom;
	background-repeat: no-repeat;
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	color: <?php echo $themeSettings['tab_color'];?>;
	overflow: hidden;
	padding-bottom: 1px;
	font-family: inherit;
	font-size: inherit;
}

.cometchat_tabcontenttext {
	white-space: pre-wrap;
	white-space: -moz-pre-wrap !important;
	white-space: -pre-wrap;
	white-space: -o-pre-wrap;
	word-wrap: break-word;
	white-space: pre;
	white-space: -hp-pre-wrap;
	white-space: pre-line;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	height: <?php echo $chatboxHeight.'px';?>;
	overflow-x: hidden;
	overflow-y: auto;
	padding: 5px;
        padding-<?php echo $right;?>: 8px;
	color: inherit;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	text-align: <?php echo $left;?>;
	width: <?php echo ($chatboxWidth-15).'px';?> !important;
}

#cometchat_userscontent {
	height: 200px;
	line-height: 100% !important;
	overflow-x: hidden;
	overflow-y: auto;	
}

.cometchat_tabcontentinput {
	border: 0px;
	border-top: 1px solid <?php echo $themeSettings['tab_border_lighter'];?>;
	outline: none;
	padding: 4px 5px 0px 4px;	
}

.cometchat_tabcontentsubmit {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
        <?php if($rtl) :?>
        transform: rotateY(180deg);
        <?php endif;?>
	background-position: 0px -29px;
	float: <?php echo $right;?>;
	height: 16px;
	width: 16px;
	cursor: pointer;
}

.cometchat_textarea {
	background: <?php echo $themeSettings['tab_background'];?> !important;
	border: none !important;
        box-shadow: none !important;
	color: <?php echo $themeSettings['tab_color_self'];?> !important;
	float: <?php echo $left;?>;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	height: 18px;
	outline: none;
	overflow: hidden;
	padding: 0px;
	resize: none;	
	width: <?php echo($chatboxWidth-31).'px';?>;
	line-height: normal !important;
}

.cometchat_textarea:focus {
	border: none !important;
}

.cometchat_userlist_hover {
	background-color: <?php echo $themeSettings['tab_title_backgroud_light'];?> !important;
	color: <?php echo $themeSettings['tab_color'];?>;	
}

.cometchat_tooltip_content {
	background-color: <?php echo $themeSettings['tooltip_background'];?>;
	color: <?php echo $themeSettings['tooltip_color'];?>;
	font-family: <?php echo $themeSettings['tooltip_font_family'];?>;
	font-size: <?php echo $themeSettings['tooltip_font_size'];?>;
	padding: 5px;	
	white-space: nowrap;
	word-wrap: break-word;
}

.cometchat_userlist {
	cursor: pointer;
	height: 20px;
	line-height: 100%;	
	padding-top: 1px;
	padding-bottom: 1px;
}

.cometchat_userscontentname {
	float: <?php echo $left;?>;
	padding-bottom: 3px;
	padding-<?php echo $left;?>: 5px;
	padding-top: 4px;	
}

.cometchat_userscontentdot {
	background-position: 0px 2px;
	background-repeat: no-repeat;
	float: <?php echo $right;?>;
	height: 16px;
	margin-top: 2px;	
	width: 20px;
}

.cometchat_available {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -129px !important;	
}

.cometchat_mobile { 
        border-color: #666666;
        border-radius: 2px;
        border-style: solid;
        border-width: 2px 1px 4px;
        height: 8px !important;
        margin-left: 7px;
        margin-right: 8px;
        width: 6px !important;
        position: relative;
}

.cometchat_usertabclick .cometchat_mobile {
    margin-top: 2px !important;
}

.cometchat_dot {
	border: 1px solid #FFFFFF;
	border-radius: 2px;
	height: 0;
	left: 2px;
	position: absolute;
	top: 9px;
}

.cometchat_away {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -175px !important;	
}

.cometchat_busy {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -221px !important;	
}

.cometchat_offline {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -1088px !important;	
}

#cometchat_tooltip {
	background-image: url(themes/<?php echo $theme;?>/images/pointer.png);
	background-position: right bottom;
	background-repeat: no-repeat;
	bottom: 29px;
	display: none;
	padding-bottom: 4px;
	position: fixed;	
	z-index: 900001;
}

.cometchat_tooltip_left {
	background-position: left bottom !important;	
}

.cometchat_closebox_bottom_status {
	background-position: 0 -1px;
	background-repeat: no-repeat;
	float: <?php echo $left;?>;
	height: 16px;	
	width: 16px;
}

.cometchat_tabalert {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -532px;
	background-repeat: no-repeat;
	background-size: auto auto;
	color: #ffffff;
	font-size: 8px;
	font-weight: bold;
	height: 18px;
	padding-top: 4px;
	position: absolute;
	text-align: center;
	width: 16px;
	text-shadow: none;
	top: -8px !important;
}


.cometchat_tabalertlr {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -537px;
	color: #ffffff;
	font-size: 8px;
	height: 16px;
	padding-top: 1px;
	position: absolute;
	text-align: center;
	width: 16px;
}

.cometchat_chatboxmessage {
	margin-left: 1em;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	word-break: break-word;
        <?php if ($rtl):?>
	float: right;
        width: 100%;
	<?php endif;?>
}

.cometchat_chatboxmessagefrom {
	font-weight: bold;
	<?php if (!$rtl):?>
	margin-left: -1em;
	<?php else: ?>
	float: right;
	<?php endif;?>
	color: inherit;
	font-family: inherit;
	font-size: inherit;
}

.cometchat_statustextarea {
	border: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	color: <?php echo $themeSettings['tab_color'];?>;
	background: <?php echo $themeSettings['tab_background'];?>;
	font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
	font-size: 11px;
	height: 42px;
	margin-bottom: 3px;
	margin-top: 3px;
	outline: none;
	overflow-x: hidden;
	overflow-y: auto;
	padding: 4px;
	resize: none;	
	width: 200px;
}

.cometchat_search {
	border: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	color: <?php echo $themeSettings['tab_color'];?>;
	background: <?php echo $themeSettings['tab_background'];?>;
	font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
	font-size: 11px;
	outline: none;
	overflow-x: hidden;
	overflow-y: auto;
	padding: 4px;
	width: 200px;
}

.cometchat_search_light {
	color: <?php echo $themeSettings['tab_color_self'];?> !important;
}

.cometchat_optionsstatus {
	cursor: pointer;
	float: <?php echo $left;?>;
	padding-<?php echo $left;?>: 6px;
	padding-top: 1px;
	width: 76px;
}

.cometchat_optionsstatus2 {
	float: <?php echo $left;?>;
	padding-left: 10px;
}

.cometchat_tabsubtitle a {
	color: <?php echo $themeSettings['tab_sub_color'];?> !important;
}

.cometchat_tabcontent a {
	color: <?php echo $themeSettings['tab_link_color'];?> !important;
}

.cometchat_user_invisible {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 10px -890px !important;
	height: 16px;	
	width: 16px;
}

.cometchat_user_available {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -752px !important;
	height: 16px;	
	width: 16px;
	float: <?php echo $left;?>;
}

#cometchat_userstab_icon {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -753px;
	float: <?php echo $left;?>;
	height: 16px;
	padding-right: 5px;	
	width: 16px;
}

.cometchat_user_invisible2 {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -891px !important;
}

.cometchat_user_available2 {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -753px !important;
}

.cometchat_user_busy2 {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -799px !important;
}

.cometchat_user_away2 {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -845px !important;	
}

.cometchat_optionsimages {
	display: block;
	height: 16px;
	width: 16px;
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -314px !important;	
	float: left;
}

.cometchat_optionsimages_click {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 10px -310px !important;	
}

.cometchat_optionsimages_exclamation {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 10px -263px !important;	
}

.cometchat_smiley {	
	vertical-align: -3px;
	display: inline-block;
}

.cometchat_traypopup {
	background-color: <?php echo $themeSettings['tab_background'];?>;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	position: fixed;	
	z-index: 100001;
	bottom: 25px;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
}

.cometchat_traytitle {
	background-color: <?php echo $themeSettings['tab_title_background'];?> !important;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $themeSettings['tab_title_gradient_start'];?>', endColorstr='<?php echo $themeSettings['tab_title_gradient_end'];?>');
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $themeSettings['tab_title_gradient_start'];?>), to(<?php echo $themeSettings['tab_title_gradient_end'];?>));
	background: -moz-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	background: -ms-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	background: -o-linear-gradient(top, <?php echo $themeSettings['tab_title_gradient_start'];?>, <?php echo $themeSettings['tab_title_gradient_end'];?>);
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-top: 1px solid <?php echo $themeSettings['tab_border'];?>;
	color: <?php echo $themeSettings['tab_title_color'];?>;
	font-family: <?php echo $themeSettings['tab_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	font-weight: bold;
	padding: 5px;
	padding-<?php echo $right;?>: 0px;	
	text-shadow: 1px 1px 0px <?php echo $themeSettings['tab_title_text_background'];?>;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
}

.cometchat_traycontent {
	background-color: <?php $themeSettings['tab_background'];?>;
	background-image: url(themes/<?php echo $theme;?>/images/tabbottom_tray.gif);
	background-position: left bottom;
	background-repeat: no-repeat;
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	color: <?php echo $themeSettings['tab_color'];?>;
	overflow-x: hidden;
	overflow-y: auto;
	padding-bottom: 1px;	
}

.cometchat_traycontenttext {
	overflow-x: hidden;
	overflow-y: hidden;
	padding: 0px;
	position: relative;
}

.cometchat_trayclick {
	background-color: <?php echo $themeSettings['tab_background'];?> !important;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border'];?> !important;
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?> !important;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?> !important;
	color: <?php echo $themeSettings['tab_color'];?> !important;
	margin-left: 0px;
	padding-bottom: 1px;
	padding-top: 4px !important;	
	text-decoration: underline;
	-moz-border-radius-bottomleft: 3px;
	-moz-border-radius-bottomright: 3px;
	-webkit-border-bottom-left-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
}

.cometchat_traytitle .cometchat_minimizebox {
	margin-right: 6px;
}

.cometchat_userstabtitle .cometchat_minimizebox {
	margin-right: 2px;
}

.cometchat_minimizebox {
	cursor: pointer;
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 10px -462px;
	float: <?php echo $right;?>;
	height: 12px;	
	width: 21px;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}

.cometchat_popout {
	cursor: pointer;
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 1px -1112px;
	float: <?php echo $right;?>;
	height: 16px;
	width: 16px;
	cursor: pointer;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}

.cometchat_minimizebox:hover, .cometchat_popout:hover {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

.cometchat_chatboxtraytitlemouseover {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

.cometchat_star {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 4px -1068px;
	height: 16px;	
	width: 16px;
}

.cometchat_star_empty {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -1150px;
	height: 16px;	
	width: 16px;
}

.cometchat_star_half {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0 -1196px;
	height: 16px;	
	width: 16px;
}

.cometchat_name a, .cometchat_name a:link, .cometchat_name a:visited {
	color: <?php echo $themeSettings['tab_title_color'];?>;
	float: <?php echo $left;?>;
	color: <?php echo $themeSettings['tab_title_color'];?>;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_title_font_size'];?>;
	text-decoration: underline;
}

.cometchat_name a:hover {
	color: <?php echo $themeSettings['tab_title_color'];?>;	
	text-decoration: none;
}

.cometchat_avatar {
	border: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	height: 28px;	
}

.cometchat_avatarbox {
	float: <?php echo $left;?>;
	padding-<?php echo $right;?>: 5px;	
}

.cometchat_ts {
	color: <?php echo $themeSettings['tab_border_light'];?>;
	cursor: default;
	display: none;
	font-size: 10px;
	padding-left: 5px;
	padding-top: 2px;
        <?php if ($rtl):?>
        float: left;
        <?php endif;?>
}

.cometchat_ts:hover {
	color: <?php echo $themeSettings['tab_color_self'];?>;
	cursor: default;
	font-size: 10px;
	padding-left: 5px;
	padding-top: 2px;	
}

.cometchat_ts_date {
	display: none;	
}

.cometchat_optionstyle {
	background-image: url(themes/<?php echo $theme;?>/images/tabbottomoptions.gif);
	padding: 5px;
	padding-bottom: 10px;	
}

.cometchat_tabstyle {
	background-image: url(themes/<?php echo $theme;?>/images/tabbottomwhosonline.gif);
	height: 200px;
	padding-bottom: 5px;
	padding-top: 5px;	
}

.cometchat_self {
	color: <?php echo $themeSettings['tab_color_self'];?> !important;	
}

.cometchat_typing {
	background-image: url(themes/<?php echo $theme;?>/images/pencil.png);
	display: none;
	float: <?php echo $left;?>;
	height: 13px;
	width: 16px;
}

.cometchat_userscontentavatar {
	display: block;
	float: <?php echo $left;?>;
	padding-bottom: 1px;
	padding-<?php echo $left;?>: 5px;
	padding-top: 1px;	
}

.cometchat_userscontentavatarimage {
	height: 18px;
	width: 18px;
}

.cometchat_notification_avatar_image {
	height: 25px;
	width: 25px;
}

.cometchat_notification {
	border-top: 1px dotted <?php echo $themeSettings['tooltip_break'];?>;
	cursor: pointer;
	margin-top: 6px;
	padding-top: 4px;
	width: 176px;
}

.cometchat_notification:first-child {
	border-top: 0px !important;
	margin-top: 0px !important;
	padding-top: 0px !important;
	width: 176px;
}

.cometchat_notification_avatar {
	float: <?php echo $left;?>;
	padding-right: 6px;
	padding-top: 2px;
	width: 25px;
}

.cometchat_notification_message {
	float: <?php echo $left;?>;
	white-space: normal;
	width: 144px;
}

.cometchat_notification_status {
	color: <?php echo $themeSettings['tooltip_color_light'];?>;
	display: none;
	font-size: 10px;
}

.cometchat_statusbutton {
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
	font-size: <?php echo $themeSettings['tab_font_size_small'];?>;
	font-weight: bold;
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;	
	-moz-border-radius-bottomleft: 3px;
	-moz-border-radius-bottomright: 3px;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
	-webkit-border-bottom-left-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
	width: 85px;
	height: 18px;
    text-align: center;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    line-height: 18px;
}

.cometchat_guestnamebutton {
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
	font-size: <?php echo $themeSettings['tab_font_size_small'];?>;
	font-weight: bold;
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
	margin-left: 4px;
	padding: 3px;
        text-align:center;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;	
	-moz-border-radius-bottomleft: 3px;
	-moz-border-radius-bottomright: 3px;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
	-webkit-border-bottom-left-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
	width: 77px;
	display: inline-block;
        position: fixed;
        margin-top: 3px;
        height: 17px;
}

.cometchat_guestnametextbox {
	border: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	color: <?php echo $themeSettings['tab_color'];?>;
	background: <?php echo $themeSettings['tab_background'];?>;
	font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
	font-size: 11px;
	margin-bottom: 3px;
	margin-top: 3px;
	outline: none;
	overflow-x: hidden;
	overflow-y: auto;
	padding: 4px;
	resize: none;	
	width: 115px;
}

.cometchat_user_busy {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 0px -798px !important;
	height: 16px;
	padding-left: 0px !important;	
	width: 16px;
}

.cometchat_announcement {
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	white-space: normal;
	width: 176px;
        text-align: <?php echo $left;?>;
}

.cometchat_tooltip_content a {
	border-bottom: 1px dotted <?php echo $themeSettings['tab_link_color'];?>;
	color: <?php echo $themeSettings['tab_link_color'];?>;
	text-decoration: none;
}

.cometchat_user_shortname {
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	float: <?php echo $left;?>;
}

#cometchat_hidden {
	background-image: url(themes/<?php echo $theme;?>/images/bgrepeat.png);
	bottom: 0px;
	cursor: pointer;
	display: none;
	position: fixed;
	right: 20px;
	z-index: 100000;
}

#guestsname {
	display: none;
	border-bottom: 1px solid #CCCCCC;   
	padding-bottom: 5px;
	margin-bottom: 5px;
}

#cometchat_hidden_content {
	background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 7px -24px;
	border-left: 1px solid <?php echo $themeSettings['bar_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['bar_border'];?>;
	height: 25px;
	padding-left: 7px;
	padding-right: 7px;
	width: 16px;
}

.cometchat_xtc {
	background: transparent url(themes/<?php echo $theme;?>/images/xgtc.png) repeat scroll 0 0;
	height: 10px;
}

.cometchat_xcl {
	background: transparent url(themes/<?php echo $theme;?>/images/xgcr.png) repeat scroll 0 0;
	width: 16px;
}

.cometchat_xcr {
	background: transparent url(themes/<?php echo $theme;?>/images/xgcl.png) repeat scroll 0 0;
	width: 10px;
}

.cometchat_xcc {
	background: transparent url(themes/<?php echo $theme;?>/images/xgcc.png) repeat scroll 0 0;
	font-size: 10px;
}

.cometchat_xbc {
	background: transparent url(themes/<?php echo $theme;?>/images/xgbc.png) repeat scroll 0 0;
	height: 8px;
}

.cometchat_tc {
	background: transparent url(themes/<?php echo $theme;?>/images/gtc.png) repeat-x scroll 0 0;
	height: 10px;
}

.cometchat_cl {
	background: transparent url(themes/<?php echo $theme;?>/images/gcl.png) repeat scroll 0 0;
	width: 10px;
}

.cometchat_cr {
	background: transparent url(themes/<?php echo $theme;?>/images/gcr.png) repeat scroll 0 0;
	width: 16px;
}

.cometchat_cc {
	background: transparent url(themes/<?php echo $theme;?>/images/gcc.png) repeat scroll 0 0;
	font-size: 10px;
}

.cometchat_bc {
	background: transparent url(themes/<?php echo $theme;?>/images/gbc.png) repeat-x scroll 0 0;
	height: 8px;
}

.cometchat_iphone .cometchat_chatboxmessage {
	margin-left: 0px;
}

.cometchat_iphone .cometchat_chatboxmessagefrom {
	display: none;
}

.cometchat_iphone {
	margin-bottom: 4px;
}

.cometchat_bl {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -59px;
	height: 9px;
	width: 10px;
}

.cometchat_br {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -118px;
	height: 9px;
	width: 16px;
}

.cometchat_tl {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -393px;
	height: 10px;
	width: 10px;
}

.cometchat_tr {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -453px;
	height: 10px;
	width: 16px;
}

.cometchat_xbr {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -572px;
	height: 9px;
	width: 10px;
}

.cometchat_xbl {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -631px;
	height: 9px;
	width: 16px;
}

.cometchat_xtr {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -906px;
	height: 10px;
	width: 10px;
}

.cometchat_xtl {
	background: url(themes/<?php echo $theme;?>/images/iphone.png) no-repeat top left;
	background-position: 0 -966px;
	height: 10px;
	width: 16px;
}

#cometchat_hide {
	background: url(themes/<?php echo $theme;?>/images/hide.png) no-repeat top left;
	background-position: 8px;
	border-right: 1px solid <?php echo $themeSettings['bar_border'];?>;
	cursor: pointer;
	float: right;
	height: 18px;
	margin-left: 1px;
	margin-top: 1px;
	padding-left: 7px;
	padding-right: 7px;
	padding-top: 6px;	
	width: 16px;
}

#cometchat_flashcontent {
	position: absolute;
	top: -1000px;
}

#cometchat_userstab_text {
	float: <?php echo $left;?>;
        <?php if ($rtl):?>
	padding-<?php echo $left;?>: 5px;
	<?php endif;?>
      
}

#cometchat_searchbar {
	display: none;
	background: <?php echo $themeSettings['tab_background'];?>;
}

.untranslatedtext {
	color: <?php echo $themeSettings['tab_color_self'];?>;;
}

.cometchat_trayicontext {
	float: <?php echo $left;?>;
	color: <?php echo $themeSettings['bar_color'];?>;
	font-family: <?php echo $themeSettings['bar_font_family'];?>;
	font-size: <?php echo $themeSettings['bar_font_size'];?>;
	width: auto;
	padding-top: 1px;
	padding-<?php echo $left;?>: 5px;
	text-shadow: 1px 1px 0px <?php echo $themeSettings['bar_text_background'];?>;
}

.cometchat_trayiconimage {
        cursor: pointer;
        margin-<?php echo $right;?>: 5px;        
}

.cometchat_trayiconimage:hover {
	-moz-opacity: 0.6;
	opacity: 0.6;
}

#cometchat_userstab_popup .cometchat_tabsubtitle {
    padding-bottom: 1px;
    padding-left: 7px;
}

.cometchat_subsubtitle {
	color: <?php echo $themeSettings['tab_sub_color'];?>;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_title_font_size'];?>;
	line-height: 1.3em;
	padding: 5px 0;
	cursor: default;
	margin-top: 5px;
	margin-bottom: 5px;
	overflow: hidden;
	white-space: nowrap;
}

.cometchat_subsubtitle_top {
	margin-top: 0px;
	padding-top: 0px;
}

.cometchat_subsubtitle .hrleft {
	display: inline-block;
	width: 5px;
	border: 0;
	background-color: <?php echo $themeSettings['tab_border_light'];?>;
	height: 1px;
	margin-right: 5px;
	margin-bottom: 3px;
}

.cometchat_subsubtitle .hrright {
	display: inline-block;
	width: 200px;
	border: 0;
	background-color: <?php echo $themeSettings['tab_border_light'];?>;
	height: 1px;
	margin-left: 5px;
	margin-bottom: 3px;
}

.cometchat_nofriends {
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_title_font_size'];?>;
	line-height: 1.3em;
	padding: 0px 10px;	
	color: <?php echo $themeSettings['tab_sub_color'];?>;
}

.cometchat_ad {
	background: <?php echo $themeSettings['tab_background'];?>;
}

.cometchat_message {
	overflow: hidden;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
}

.cometchat_container {
	z-index: 100001;
	position: absolute;
}

.cometchat_container_title {
	cursor: default;
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
	line-height: 14px;
	padding: 5px;
	font-weight:bold;
	padding-left:10px;
	padding-bottom: 6px;
	<?php if($rtl) :?>
        padding-right: 5px;
        <?php else :?>
	padding-right: 0px;
        <?php endif;?>
	text-shadow: 1px 1px 0 <?php echo $themeSettings['tab_title_text_background'];?>;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;	
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
}

.cometchat_container_title span {
    float: <?php echo $left;?>;
}

.cometchat_container_body {
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	background-color: <?php echo $themeSettings['tab_background'];?>;
	position: relative;
        overflow:hidden;
}

.cometchat_iframe {
	position: absolute;
	top: 0px;
	left: 0px;
}

.cometchat_loading {
	position: absolute;
	background: url(themes/<?php echo $theme;?>/images/loader.gif);
	right: 10px;
	top: 10px;
	background-repeat: no-repeat;
	width: 20px;
	height: 20px;
}

.cometchat_overlay {
	position: absolute;
	top: 0px;
	left: 0px;
	display: none;
}

.cometchat_options_disable {
	border-top: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	border-bottom: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	margin-top: 10px;
	margin-bottom: 4px;
	padding-top: 4px;
	padding-bottom: 4px;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
}

#cometchat_userstab_popup_available, #cometchat_userstab_popup_busy, #cometchat_userstab_popup_invisible, #cometchat_userstab_popup_offline {
	cursor: pointer;
}

.cometchat_tabsubtitle2 {
	cursor: pointer;
	background-color: <?php echo $themeSettings['tab_sub_background'];?>;
	<?php if($lang == 'en'):?>
	background: url(extensions/jabber/jabber_dark.png) no-repeat 2px 5px;
	<?php endif;?>	
	border-bottom: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
	border-left: 1px solid <?php echo $themeSettings['tab_border'];?>;
	border-right: 1px solid <?php echo $themeSettings['tab_border'];?>;
	font-family: <?php echo $themeSettings['tab_title_font_family'];?>;
	font-size: <?php echo $themeSettings['tab_font_size'];?>;
	<?php if($lang == 'en'):?>
	padding: 10px 4px 10px 46px;
	<?php else:?>
	padding: 10px 8px;
	<?php endif;?>
	line-height: 1.3em !important;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=80);
	-moz-opacity: 0.8;
	-khtml-opacity: 0.8;
	opacity: 0.8;
	color: <?php echo $themeSettings['tab_sub_color'];?> !important;
	font-weight: bold;
	text-decoration: none;
}

.cometchat_tabsubtitle2:hover {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
	text-decoration: underline;
	background-color: <?php echo $themeSettings['tab_background'];?>;
}

.cometchat_unblock {
	float: right; 
	cursor: pointer;
	background: url('plugins/block/unblock.png') no-repeat scroll 0px 0px transparent;
	height: 16px; 
	width: 16px; 
	margin-top: -1.5px;
}
.cometchat_userlist .cometchat_userscontentname {
	text-overflow: ellipsis;
	max-width: 160px;
	white-space: nowrap;
	overflow: hidden !important;
}

.cometchat_tab .cometchat_user_shortname {
	text-overflow: ellipsis;
	max-width: 105px;
	white-space: nowrap;
	overflow: hidden !important;
        <?php if($rtl) :?>
        margin-right: 4px;
        <?php endif;?>
}

.cometchat_usertabclick .cometchat_user_shortname {
	margin-top: 2px !important;
}

.cometchat_tabtitle .cometchat_name a {
	text-overflow: ellipsis;
	max-width: 160px;
	white-space: nowrap;
	overflow: hidden !important;
}

.cometchat_tabtitle .cometchat_name  {
	text-overflow: ellipsis;
	max-width: 160px;
	white-space: nowrap;
	overflow: hidden !important;
}

.invite_name{
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
	width: 100px;
	float: <?php echo $left;?>;
}

#statusupdate_div,#guestnameupdate_div {
    font-size: <?php echo $themeSettings['tab_font_size_small'];?>;
    padding: 2px;
}

.cometchat_statusbutton > img , .cometchat_guestnamebutton > img {
    margin: 1px 35%;
    opacity: 0.5;
}

.cometchat_extra_width {
    width: 214px !important;
}

.cometchat_border_bottom {
    border-bottom: 1px solid <?php echo $themeSettings['tab_border_light'];?>;
    background-image: none;
}

.ui-icon,.ui-widget-content .ui-icon {
    background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
    background-position: 1px  -1141px;
}

.ui-icon-gripsmall-diagonal-se { background-position: 0px -74px; }

.ui-icon {
	width: 16px;
	height: 16px;
}

.ui-resizable-se {
	cursor: se-resize;
	right: 1px;
	bottom: 1px;
}
.ui-resizable-handle {
        background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 1px  -1141px;
	position: absolute;
	font-size: 0.1px;
	display: block;
}
.ui-icon {
	text-indent: -99999px;
	overflow: hidden;
	background-repeat: no-repeat;
}

.file_image {
	max-width:125px;
	max-height:170px;
	padding-left: 6%;
}

.file_video {
	max-width:125px;
	max-height:170px;
	min-height:120px;
}

.imagemessage {
	display: inline-block;
	margin-bottom: 3px;
	margin-top: 3px;
}

.cometchat_avchat{ background-position: 0 0; width: 16px; height: 16px; } 
.cometchat_block{ background-position: 0 -66px; width: 16px; height: 16px; } 
.cometchat_broadcast{ background-position: 0 -132px; width: 16px; height: 16px; } 
.cometchat_chathistory{ background-position: 0 -198px; width: 16px; height: 16px; } 
.cometchat_chattime{ background-position: 0 -264px; width: 16px; height: 16px; } 
.cometchat_clearconversation{ background-position: 0 -330px; width: 16px; height: 16px; } 
.cometchat_style{ background-position: 0 -396px; width: 16px; height: 16px; } 
.cometchat_filetransfer{ background-position: 0 -462px; width: 16px; height: 16px; } 
.cometchat_games{ background-position: 0 -528px; width: 16px; height: 16px; } 
.cometchat_handwrite{ background-position: 0 -594px; width: 16px; height: 16px; } 
.cometchat_report{ background-position: 0 -660px; width: 16px; height: 16px; } 
.cometchat_save{ background-position: 0 -726px; width: 16px; height: 16px; } 
.cometchat_screenshare{ background-position: 0 -792px; width: 16px; height: 16px; } 
.cometchat_smilies{ background-position: 0 -858px; width: 16px; height: 16px; } 
.cometchat_transliterate{ background-position: 0 -924px; width: 16px; height: 16px; } 
.cometchat_whiteboard{ background-position: 0 -990px; width: 16px; height: 16px; } 
.cometchat_writeboard{ background-position: 0 -1056px; width: 16px; height: 16px; }

.ui-icon,.ui-widget-content .ui-icon {
    background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
    background-position: 1px  -1141px;
}

.ui-icon-gripsmall-diagonal-se { background-position: 0px -74px; }

.ui-icon {
	width: 16px;
	height: 16px;
}

.ui-resizable-se {
	cursor: se-resize;
	right: 1px;
	bottom: 1px;
}
.ui-resizable-handle {
        background: url(themes/<?php echo $theme;?>/images/cometchat.png) no-repeat top left;
	background-position: 1px  -1141px;
	position: absolute;
	font-size: 0.1px;
	display: block;
}
.ui-icon {
	text-indent: -99999px;
	overflow: hidden;
	background-repeat: no-repeat;
}

.file_image {
	max-width:125px;
	padding-left: 6%;
	height: 170px;
}

.file_video {
	max-width:125px;
	height:120px;
}

.imagemessage {
	display: inline-block;
	margin-bottom: 3px;
	margin-top: 3px;
}

</style>