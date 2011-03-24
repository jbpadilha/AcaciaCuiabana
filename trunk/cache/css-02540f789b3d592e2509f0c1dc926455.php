<?php 
ob_start ("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " . 
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
                ?>

/*** xmenu.css ***/

.xmenu{display:block;font-size:80%;margin-top:-15px;color:#999}.xmenu_position{border:1px
solid red}

/*** colorpicker.css ***/

.colorpicker{width:356px;height:176px;overflow:hidden;position:absolute;background:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_background.png);font-family:Arial,Helvetica,sans-serif;display:none;z-index:20000}.colorpicker_color{width:150px;height:150px;left:14px;top:13px;position:absolute;background:#f00;overflow:hidden;cursor:crosshair}.colorpicker_color
div{position:absolute;top:0;left:0;width:150px;height:150px;background:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_overlay.png)}.colorpicker_color div
div{position:absolute;top:0;left:0;width:11px;height:11px;overflow:hidden;background:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_select.gif);margin: -5px 0 0 -5px}.colorpicker_hue{position:absolute;top:13px;left:171px;width:35px;height:150px;cursor:n-resize}.colorpicker_hue
div{position:absolute;width:35px;height:9px;overflow:hidden;background:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_indic.gif) left top;margin: -4px 0 0 0;left:0px}.colorpicker_new_color{position:absolute;width:60px;height:30px;left:213px;top:13px;background:#f00}.colorpicker_current_color{position:absolute;width:60px;height:30px;left:283px;top:13px;background:#f00}.colorpicker
input{background-color:transparent;border:1px
solid transparent;position:absolute;font-size:10px;font-family:Arial,Helvetica,sans-serif;color:#898989;top:4px;right:11px;text-align:right;margin:0;padding:0;height:11px}.colorpicker_hex{position:absolute;width:72px;height:22px;background:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_hex.png) top;left:212px;top:142px}.colorpicker_hex
input{right:6px}.colorpicker_field{height:22px;width:62px;background-position:top;position:absolute}.colorpicker_field
span{position:absolute;width:12px;height:22px;overflow:hidden;top:0;right:0;cursor:n-resize}.colorpicker_rgb_r{background-image:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_rgb_r.png);top:52px;left:212px}.colorpicker_rgb_g{background-image:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_rgb_g.png);top:82px;left:212px}.colorpicker_rgb_b{background-image:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_rgb_b.png);top:112px;left:212px}.colorpicker_hsb_h{background-image:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_hsb_h.png);top:52px;left:282px}.colorpicker_hsb_s{background-image:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_hsb_s.png);top:82px;left:282px}.colorpicker_hsb_b{background-image:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_hsb_b.png);top:112px;left:282px}.colorpicker_submit{position:absolute;width:22px;height:22px;background:url(/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/colorpicker_submit.png) top;left:322px;top:142px;overflow:hidden}.colorpicker_focus{background-position:center}.colorpicker_hex.colorpicker_focus{background-position:bottom}.colorpicker_submit.colorpicker_focus{background-position:bottom}.colorpicker_slider{background-position:bottom}.colorSelector{background:url("/ligante3/templates/kraftwerks/thememagic/media/js/colorpicker/images/select.png") repeat scroll 0 0 transparent;float:left;height:27px;position:relative;width:27px}

/*** css-8e4477e3d49b002b8000e3ed95bed7e7.css ***/

html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{margin:0;padding:0;border:0px
none;outline:0;font-size:100%}blockquote:before,blockquote:after,q:before,q:after{content:''}table{border-collapse:collapse}li{list-style-image:url();list-style-type:none;margin:0}hr{border:0
#ccc solid;border-top-width:1px;clear:both}#login_popup form#form-login{font-weight:normal;margin-left:8px;width:320px;float:left;background:#e5f0f3;padding:20px}#login_popup
#logintopper{background:#777;padding-left:12px;color:fff;font-size:14px}#login_popup
#login_side{float:right;padding:20px;width:300px}#login_popup #user_pass,#login_popup  #user_login,#login_popup
#user_email{background:none repeat scroll 0 0 #FBFBFB;border:1px
solid #E5E5E5;font-size:24px;margin-bottom:16px;margin-right:6px;margin-top:2px;padding:3px;width:97%}#login_popup form#form-login
label{color:#777;font-size:13px}#login_popup form
.forgetmenot{float:left;font-weight:normal;margin-bottom:0}#login_popup form#form-login .forgetmenot
label{font-size:12px}#login_popup textarea,#login_popup  input[type="text"],#login_popup  input[type="password"],#login_popup  input[type="file"],#login_popup  input[type="button"],#login_popup  input[type="submit"],#login_popup  input[type="reset"],#login_popup
select{background-color:#FFF;border-color:#DFDFDF}#login_popup form#form-login
.submit{float:right}#login_popup input.button-primary,#login_popup  button.button-primary,#login_popup  a.button-primary{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/button-grad.png) repeat-x scroll left top #21759B;border-color:#298CBA;color:#FFF !important;font-weight:bold;text-shadow:0 -1px 0 rgba(0, 0, 0, 0.3);-moz-border-radius:11px 11px 11px 11px;border:1px
solid;cursor:pointer}#login_popup input.button-primary:active, #login_popup  button.button-primary:active, #login_popup  a.button-primary:active{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/button-grad-active.png) repeat-x scroll left top #21759B;color:#EAF2FA !important}#login_popup input.button-primary:hover, #login_popup  button.button-primary:hover, #login_popup  a.button-primary:hover, #login_popup  a.button-primary:focus, #login_popup  a.button-primary:active{border-color:#13455B;color:#EAF2FA !important}#login_popup form#form-login
input{color:#555}#admin-link-wrap{margin:0px
auto;width:80px}a.register_joomla{color:#555;position:relative;top:48px}#login_wrapper{position:fixed;width:983px}.login_open_wrap{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/log-tab.png) no-repeat;float:right;height:41px;margin-top:78px;position:relative;width:133px;text-align:center;z-index:800;right: -12px}.login_open_wrap:hover{cursor:pointer}a#login_open{color:#999;display:block;float:right;font-size:12px;left:120px;position:relative;top:89px;z-index:900}a#login_open:hover{cursor:pointer}a#login_open.logout{margin-top:0px}#login_popup{background:#fff;border:1px
solid #ccc;height:432px;width:800px}#form-logout
input{font-size:48px;margin-top:42px !important;padding:0px
!important}#form-logout input:hover{color:#68B5D5;cursor:pointer}.logintopper{background:#EEE;color:#545C65;padding:20px
0 20px 22px}.logintopper
h4{font-size:24px}#login_left{float:left}#loginside{float:right;margin-top: -5px}.vm_search
form{background:#fff url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/searchicon.png) no-repeat scroll left;height:24px;padding-left:20px}.vm_search
.inputbox{border:1px
solid #f4f4f4;border-bottom:none;border-left:none;font-size:10px;height:15px;margin-top:1px;padding:4.5px 10px 0;width:128px}#navigation{float:right;height:66px;margin:0
auto;width:auto}#navigation li a:hover{cursor:pointer}#navigation ul.menu>li{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/nav-sep.png) repeat-y top right;height:47px;padding-top:18px !important}#navigation ul.menu>li>a{height:41px}#navigation ul.menu>li.back{background:none}#navigation ul.menu>li.last{background:none}#navigation ul.menu,#navigation  ul.menu
ul{line-height:1;list-style-image:url();list-style-position:outside;list-style-type:none;position:relative}#navigation ul.menu li.back,#navigation ul.menu  li.back:hover, #navigation  ul.menu ul li.back, #navigation  ul.menu ul  li.back:hover{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bg-nav-lamp.png) repeat-x scroll left bottom;float:none;height:48px;padding:0;margin-left: -1px;position:absolute;width:5px;z-index:8 !important}#navigation ul.menu li.back .left,#navigation ul.menu  li.back:hover .left, #navigation  ul.menu ul li.back .left, #navigation  ul.menu ul  li.back:hover
.left{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bg-nav-lamp-tab.png) no-repeat scroll top right;height:12px;width:12px;margin:40px
auto 0px auto}#navigation ul.menu li,#navigation  ul.menu ul
li{float:left;padding:2px
5px;width:auto}#navigation ul.menu li a,#navigation  ul.menu ul li
a{position:relative;z-index:100;color:#A3D2E5;display:block;font-size:12px;line-height:28px;padding:0px
10px 7px 10px;margin-bottom:0px;text-decoration:none;font-weight:bold}#navigation ul.menu li ul,#navigation  ul.menu ul li
ul{left:auto;position:absolute;display:none;width:172px;background:#FFF 0 0;border:1px
solid #EFEFEF}#navigation ul.menu li ul li,#navigation  ul.menu ul li ul
li{padding:5px
0px 0px 0px}#navigation ul.menu li ul li:hover, #navigation  ul.menu ul li ul li:hover{background:#FAFAFA}#navigation ul.menu li ul li a,#navigation  ul.menu ul li ul li
a{color:#000;font-size:12px;line-height:30px;padding-left:15px;width:145px}#navigation ul.menu li ul li ul,#navigation  ul.menu ul li ul li
ul{margin: -25px 0px 0px 170px}#navigation ul.menu li ul li ul li,#navigation  ul.menu ul li ul li ul
li{padding:5px
0px 0px 0px}#navigation ul.menu li ul li ul li:hover, #navigation  ul.menu ul li ul li ul li:hover{background:#FAFAFA}#navigation ul.menu li ul li ul li a,#navigation  ul.menu ul li ul li ul li
a{color:#000;font-size:12px;line-height:30px;padding-left:15px;width:145px}div.joomla .float-left{float:left;overflow:hidden}div.joomla .float-right{float:right;overflow:hidden}div.joomla
.width25{width:24.999%}div.joomla
.width33{width:33.333%}div.joomla
.width50{width:49.999%}div.joomla
.width100{width:100%}.component
h1{display:inline-block;font-size:4.25em;color:#999;line-height:42px}.component
h2{font-size:2em;color:#999;line-height:32px}.component
h3{font-size:1.55em;color:#999;line-height:24px}.component
h4{font-size:1.15em;line-height:1.25;font-weight:bold;color:#999;line-height:18px}.component
h5{font-size:1em;font-weight:bold;color:#999;line-height:16px}.component
h6{font-size:1em;color:#999;line-height:16px}.dropcap{float:left;padding:4px
8px 0 0;display:block;color:#999;font:50px/40px Times,serif}quotes{padding:1em
40px 1em 15px;font:16px Arial;color:#777}quotes
span.open{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/openquote.gif) no-repeat left top;padding:2px
0 2px 25px}quotes
span.close{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/closequote.gif) no-repeat top right;padding:2px
25px 2px 0}quoteslg{padding:1em
70px 1em 15px;font:28px Arial;line-height:28px;color:#777}quoteslg
span.open{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/oquote_lg.png) no-repeat left top;padding:12px
25px 2px 25px}quoteslg
span.close{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/equote_lg.png) no-repeat top right;padding:2px
25px 25px 25px}.code{background:#F4F4F4;font:1em/1.5 "Tahoma", monospace;margin:5px
0 15px;padding:10px
15px;color:#333}p.error{padding-left:25px;color:#f10033;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/error.gif) no-repeat top left}p.message{color:#069;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/info.gif) no-repeat top left;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:5px}p.ideas{padding-left:25px;color:#EE9600;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/lightbulb.gif) no-repeat top left}.highlight{padding:12px;background:#FFC;color:#333}p.download{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/download.gif) no-repeat 5px center;padding-left:35px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.astrix{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/icon-asterisk_sm.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:5px}p.com{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/ext_com.png) no-repeat 5px center;padding-left:35px;padding-right:0px;padding-top:0px;padding-bottom:5px}p.mod{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/ext_mod.png) no-repeat 5px center;padding-left:35px;padding-right:0px;padding-top:0px;padding-bottom:5px}p.plug{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/ext_plugin.png) no-repeat 5px center;padding-left:35px;padding-right:0px;padding-top:0px;padding-bottom:5px}p.lang{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/ext_lang.png) no-repeat 5px center;padding-left:35px;padding-right:0px;padding-top:0px;padding-bottom:5px}p.photolink{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/ww_image.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.heart{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/heart.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.stargrey{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-grey.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.starred{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-red.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.starblue{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-blue.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.stargreen{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-green.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.starorange{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-orange.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.starbrick{background:url() no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.starorange{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-orange.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photogrey{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-grey.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photoblack{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-black.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photored{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-red.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photoblue{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-blue.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photopink{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-pink.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photogreen{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-green.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photobrick{background:url() no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.photoorange{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-orange.png) no-repeat 5px center;padding-left:40px;padding-right:0px;padding-top:0px;padding-bottom:0px}p.x{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/x-red.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:5px;padding-bottom:5px}p.xblack{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/x-black.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:5px;padding-bottom:5px}p.rss{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/rss.png) no-repeat 5px center;padding-left:25px;padding-right:0px;padding-top:0px;padding-bottom:0px}ul.checklist{list-style:none}ul.checklist
li{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/check-grey.png) no-repeat 0 3px;margin-left:15px;padding:0
0 5px 30px}ul.articlelist{list-style:none}ul.articlelist
li{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/article-grey.png) no-repeat 0 3px;margin-left:15px;padding:0
0 5px 30px}ul.starlist{list-style:none}ul.starlist
li{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/star-grey.png) no-repeat 0 3px;margin-left:15px;padding:0
0 5px 30px}ul.arrowlist{list-style:none}ul.arrowlist
li{background:url() no-repeat 0 3px;margin-left:15px;padding:0
0 5px 30px}ul.xlist{list-style:none}ul.xlist
li{margin-left:15px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/x-red.png) no-repeat 0 3px;padding:0
0 5px 30px}ul.astlist{list-style:none}ul.astlist
li{margin-left:15px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/icon-asterisk_sm.png) no-repeat 0 3px;padding:0
0 5px 30px}ul.movielist{list-style:none}ul.movielist
li{margin-left:15px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/movie-grey.png) no-repeat 0 3px;padding:0
0 5px 30px}ul.bloglist{list-style:none}ul.bloglist
li{margin-left:15px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/blog-green.png) no-repeat 0 3px;padding:0px
0px 5px 30px}ul.photolist{list-style:none}ul.photolist
li{margin-left:15px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/camera-grey.png) no-repeat 0 3px;padding:0
0 0px 30px}ul.datelist{list-style:none}ul.datelist
li{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/calendar-grey.png) no-repeat 0 3px;margin-left:15px;padding:0
0 5px 30px}.pinkbubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/pinkblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.bluebubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/blueblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.redbubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/redblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.greenbubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/greenblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.yellowbubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/yellowblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.brickbubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/pinkblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.orangebubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/orangeblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.greybubble{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/greyblog_bottom.gif) no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.blackbubble{background:url() no-repeat left bottom;font-size:2em;color:#FFF !important;padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:50px}.note{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/note.gif) no-repeat right bottom;font-size:1em;color:#000 !important;padding-left:20px;padding-right:20px;padding-top:40px;padding-bottom:40px}.grayhover1{padding:12px}body{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bg-body.png) repeat-x;font-family:Arial;font-size:12px;line-height:17px}body{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bodybgs/bg-body.png) repeat-x}#main_container
a{font-family:Arial,Helvetica,sans-serif;color:#828282}p{font-size:12px;line-height:17px;color:#777}.button{background:#e4e4e4;color:#999;padding:2px;border:none;font-size:11px}.clearBoth{clear:both}.hideTxt{text-indent: -9999px}.column,.columnSeparator{float:left}.columnSeparator{min-height:50px}.module-column{float:left;padding-right:13px}.last-module-column{padding-right:0px}.module-set{float:left}.wrapper{width:983px;margin:0px
auto}#bg_wrap{float:left;width:100%}#header_container{float:left;margin-bottom:20px;min-height:90px;width:100%}#bg_wrap{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/backgrounds/cubesplat.png) no-repeat top center}#main_wrap{overflow:auto}#cart_push{float:left;margin-bottom:140px;width:100%}#bottom_bg{background:transparent url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bottombgs/vmbottomfade.png) repeat-x scroll center bottom;float:left;height:340px;margin-top:24px;width:100%}.noNewsflash
#main_container{margin-top:15px}.noHeader
#main_container{margin-top:140px}#nav_container{height:78px;width:100%;position:fixed;top:0;z-index:1000;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bg-topnav.png) repeat-x scroll 0 0}#nav_container
#logo{z-index:9000;float:left;height:40px;width:170px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/logos/logo-wide1.png) no-repeat;margin-top:15px}#nav_container
.wrapper{position:relative}.firefox #nav_container,.firefox
#nav_shadow{overflow-y:hidden}#nav_shadow{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bg-nav-shadow.png) repeat-x;z-index:900;height:21px;width:100%;top:78px;position:fixed}#top{position:relative;top:90px}.menu.box .box_content_left,.menu.flip
.box_content_left{padding:0px}.menu.box ul li,.menu.flip ul
li{height:47px}.menu.box ul li a,.menu.flip ul li
a{height:47px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bg-vnav.png) repeat-x;display:block;width:100%;color:#A3D2E5}.menu.box ul li a span,.menu.flip ul li a
span{display:block;width:auto;padding-left:20px;padding-right:0;padding-top:12px}.menu.box ul li a img,.menu.flip ul li a
img{display:block;padding:12px
0 0 20px;width:auto}.vertmenu.box .box_content_left,.menu.flip
.box_content_left{padding:0px}.vertmenu.box ul li,.vertmenu.box ul  li:hover, .menu.flip ul li, .menu.flip ul  li:hover{height:47px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/vmenu-li-bg.png) 0px 0px repeat-x}.vertmenu.box ul li a,.vertmenu.box ul li  a:hover, .vertmenu.box ul  li:hover a, .vertmenu.box ul  li:hover  a:hover, .menu.flip ul li a, .menu.flip ul li  a:hover, .menu.flip ul  li:hover a, .menu.flip ul  li:hover  a:hover{height:47px;display:block;width:100%;color:#A3D2E5}.vertmenu.box ul li a span,.vertmenu.box ul li  a:hover span, .vertmenu.box ul  li:hover a span, .vertmenu.box ul  li:hover  a:hover span, .menu.flip ul li a span, .menu.flip ul li  a:hover span, .menu.flip ul  li:hover a span, .menu.flip ul  li:hover  a:hover
span{display:block;padding:11px
0px 0px 20px;width:auto}.vertmenu.box .box_content_left,.menu.flip
.box_content_left{padding:0px}.vertmenu.box ul li div.vMenuBg,.menu.flip ul li
div.vMenuBg{height:47px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/vnav-over.png) repeat-x;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/vmenu-hover.png) no-repeat}#newsflash_wrap{margin-top:120px;float:left;width:100%}.box{margin-bottom:13px}.box
.box_left_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-header.png) no-repeat scroll 0 0;margin-right:14px;height:46px}.box .box_left_title
.box_right_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-header-right.png) no-repeat scroll right 0;height:46px;margin-right: -14px}.box .box_left_title .box_right_title h3.modtitle,.box .box_left_title .box_right_title
.pagetitle{padding:15px
0px 0px 15px}.box .box_left_title .box_right_title
h3.modtitle{color:#C2C2C2}.box .box_left_title .box_right_title h3.modtitle
.first_word{color:#B0C04C}.box .box_left_title .box_right_title .pagetitle
.first_word{color:#B0C04C}.box .box_left_title .box_right_title
.pagetitle{color:#C2C2C2}.box
.box_footer_left{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-footer.png);height:47px;margin-right:14px}.box .box_footer_left
.box_footer_right{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-footer-right.png) no-repeat scroll right top;height:47px;margin-right: -14px}.box
.box_content_left{border:1px
solid #ececec;padding:15px;background:#fff url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-shadow.png) no-repeat 0 0}.small
.box_footer_left{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-footer-sm.png);height:24px;margin-right:7px}.small .box_footer_left
.box_footer_right{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-footer-sm-right.png) no-repeat scroll right top;height:24px;margin-right: -7px}.tab
.box_footer_left{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-footer-tab.png);height:47px;margin-right:42px}.tab .box_footer_left
.box_footer_right{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-footer-tab-right.png) no-repeat scroll right top;height:47px;margin-right: -42px}.flip
.box_left_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-flip-header.png);height:46px;padding-left:5px}.flip .box_left_title
.box_right_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-flip-header.png) scroll right top;height:46px}.flip
.box_content_left{background-image:none;background:#f6f6f6;border-top:none}.flip
.box_content_right{margin-top: -46px}.flip
.box_footer_left{background:url() no-repeat 0 0;margin-right:14px;height:46px}.flip .box_footer_left
.box_footer_right{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-flip-footer-right.png) no-repeat scroll right 0;height:46px;margin-right: -14px}.flip .box_footer_left h3.modtitle,.flip .box_footer_left
.pagetitle{padding:15px
0px 0px 15px}.flip .box_footer_left
h3.modtitle{color:#C2C2C2}.flip .box_footer_left h3.modtitle
.first_word{color:#B0C04C}.flip .box_footer_left .pagetitle
.first_word{color:#B0C04C}.flip .box_footer_left
.pagetitle{color:#C2C2C2}.module.advert
.box_left_title{background:none;height:auto;padding-left:0px}.module.advert .box_left_title
.box_right_title{background:none;height:auto}.module.advert .box_left_title .box_right_title h3.modtitle
.first_word{color:#b0c04c}.module.advert
.box_footer_left{background:none;height:auto;padding-left:0px}.module.advert .box_footer_left
.box_footer_right{background:none;height:auto}.module.advert
.box_content_left{border:none;padding:0px;background:none}.nopad
.box_content_left{padding:0px}.simple h3.modtitle
.first_word{color:#b0c04c}.simple
h3.modtitle{color:#c2c2c2;background:#fff;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;padding-left:12px;padding-right:0px;padding-top:5px}.simple
.module_content{padding:5px
0px 0px 12px}#userMods20-23 .simple
h3.modtitle{background:none}.module.floral h3.modtitle,.module.rss h3.modtitle,.module.search h3.modtitle,.module.video h3.modtitle,.module.photo h3.modtitle,.module.blog h3.modtitle,.module.user h3.modtitle,.module.sale h3.modtitle,.module.sun h3.modtitle,.module.diamond h3.modtitle,.module.home h3.modtitle,.module.tools h3.modtitle,.module.coffee h3.modtitle,.module.mail h3.modtitle,.module.lightning h3.modtitle,.module.percent h3.modtitle,.module.clock h3.modtitle,.module.arrow
h3.modtitle{float:left;height:24px;margin:3px
0 0 10px;padding:11px
0 0 24px !important}.module.floral
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/floral-icon.png) no-repeat scroll 0% 15px}.module.rss
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/rss_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.search
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/search_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.video
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/video_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.photo
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/photo_h3.png) no-repeat scroll 6px 13px;padding-left:40px!important}.module.blog
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/blog_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.user
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/user_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.sale
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/sale_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.sun
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/sun_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.diamond
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/diamond_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.home
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/home_h3.png) no-repeat scroll 5px 13px;padding-left:28px!important}.module.tools
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/tools_h3.png) no-repeat scroll 6px 13px;padding-left:35px!important}.module.coffee
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/coffee_h3.png) no-repeat scroll 6px 13px;padding-left:33px!important}.module.percent
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/percent_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.mail
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/mail_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.arrow
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/arrow_h3.png) no-repeat scroll 2px 13px;padding-left:28px!important}.module.clock
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/clock_h3.png) no-repeat scroll 6px 13px;padding-left:30px!important}.module.lightning
h3.modtitle{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/lightning_h3.png) no-repeat scroll 8px 15px}ul.underline li,.module.underline ul
li{border-bottom:1px dotted #d1d1d1;padding:5px
0px 5px 0px}ul.underline li a,.module.underline ul li
a{color:#afafaf !important}#cart{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/bottombar-bkg.png) 0px 40px repeat-x;bottom:0;height:195px;position:fixed;width:100%;z-index:1000}#cart
.wrapper{margin-top:120px}#cart #kraftwerks-wrap-l{float:left;margin-top: -24px;width:360px;height:79px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/rctFake.png) top left no-repeat}#cart #kraftwerks-wrap-r{float:right}#kraftwerks-bottom-panel-toggler{display:block;position:relative;top: -30px;width:19px;height:13px;margin-left:0px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/btm-cart-close.png) no-repeat;cursor:pointer}#userMods15-19{background:#efefef;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;padding:13px;width:957px}.userModColumnWrap{margin:0
auto;width:983px;overflow:auto}#userColumns{margin:0
auto;width:983px}#userMods20-23{overflow:hidden}#legalMods{overflow:hidden;margin:24px
auto 160px auto}.componentheading{font-family:TrebuchetMS,Arial,Helvetica,sans-serif;font-size:30px;margin-bottom:18px;line-height:1em;color:#999}.contentheading{font-family:TrebuchetMS,Arial,Helvetica,sans-serif;font-size:23px;line-height:1em;color:#999;display:block;float:left}a{text-decoration:none}#main_container .vertmenu.box ul li
a{font-family:Arial,TrebuchetMS,Helvetica,sans-serif}.module
h3.modtitle{font-size:13px}#component-com_content .article,#component-com_content
.item{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/vmbottomfade.png) repeat-x bottom;padding-bottom:15px}#component-com_content
.article{overflow-y:auto}#component-com_content
.article_text{padding:19px
19px 8px 16px}#component-com_content
.headline{height:30px;border-bottom:1px solid #e7e7e7;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/box-shadow-new.png) repeat-x;padding:19px
0px 8px 16px}#component-com_content
.icons{float:right;margin-right:25px}#component-com_content .pagination,#component-com_content
.morearticles{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/vmbottomfade.png) repeat-x bottom;padding:19px
0px 12px 16px}#component-com_content .morearticles
h3{float:left;margin-top:19px;width:700px}#component-com_content .article_text
img{padding-right:6px}#component-com_content
.article_info_container{height:30px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/datebar-fade.png) repeat-x;padding:6px
0px 8px 16px}.article_info_container
p{font-weight:600;font-size:10px}.box.com_content
.box_content_left{padding:0px;overflow-y:auto}.box.component
.box_left_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/component_head.png) no-repeat scroll 0 0;margin-right:14px;height:46px}.box.component .box_left_title
.box_right_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/component_head-right.png) no-repeat scroll right 0;height:46px;margin-right: -14px}.box.component .box_left_title .box_right_title
.pagetitle{font-size:16px;padding:0px
0 0 15px}#eventlist .box_left_title,#community-wrap .box_left_title,#main_wrap .componenthead
.box_left_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/component_head-round.png) no-repeat scroll 0 0;margin-right:14px;height:55px}#eventlist .box_left_title .box_right_title,#community-wrap .box_left_title .box_right_title,#main_wrap .componenthead .box_left_title
.box_right_title{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/component_head-round-right.png) no-repeat scroll right 0;height:55px;margin-right: -14px}#eventlist .box_left_title .box_right_title .pagetitle,#community-wrap .box_left_title .box_right_title .pagetitle,#main_wrap .componenthead .box_left_title .box_right_title
.pagetitle{font-size:20px;padding:8px
0 0 15px}.user_flash{display:none}.box.com_virtuemart
.box_content_left{overflow:hidden}.filter{height:30px;background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/images/datebar-fade.png) repeat-x;padding:4px
0px 12px 16px;color:#777}.showgrid{background:url(/ligante3/templates/kraftwerks/media/css/cache/C:/wamp/www/ligante3/templates/kraftwerks/media/css/cache/Layout/13px_61_13px_13px_grid.png)}

/*** 9.css ***/

body
#bg_wrap{background:url('/ligante3/templates/kraftwerks/media/images/backgrounds/paintsplash2.jpg') no-repeat top}body #bg_wrap
#header_container{height:220px}#navigation ul.menu li
a{color:#c2d25d}body .box .box_left_title .box_right_title h3.modtitle
.first_word{color:#b0c04c}body .box .box_left_title .box_right_title h3.modtitle
.rest{color:#CCC}.vmshowc{color:#b0c04c!important}.productPrice{color:#b0c04c!important}.price{color:#b0c04c!important}#community-wrap .app-box-title{color:#b0c04c!important}.app-box-header{color:#b0c04c!important}.app-box-title, .app-box-title
a{color:#b0c04c!important}.app-box-info
h3{color:#b0c04c!important}#Kunena
.fbl{color:#b0c04c}#Kunena a.fb_title, #Kunena
.fb_title{color:#b0c04c}#aboutthisvideotitle{color:#b0c04c}.videotitleinmainarea{color:#b0c04c}#commentstitle{color:#b0c04c}.listnavigationtitle{color:#b0c04c}h2.app-box-title
a{color:#b0c04c}.listing-summary
h3{color:#b0c04c;}.category
.subcat{color:#b0c04c;!important}.category .subcat
a{color:#b0c04c;!important}

/*** dualfish.css ***/

#navigation ul.menu li.dir ul, #navigation ul.menu li.sfHover
ul{width:387px;margin:1px
0px 0px -110px;padding:0px
0px 25px 0px;border:0px;background:none}#navigation ul.menu li.dir ul
li{width:175px;height:38px;margin:0px;padding:0px
0px 0px 18px}#navigation ul.menu li.dir ul
li.lft{padding:0px
0px 0px 15px;background:url('/ligante3/templates/kraftwerks/media/images/dual-mid.png') top left}#navigation ul.menu li.dir ul
li.rgt{padding:0px
19px 0px 0px;background:url('/ligante3/templates/kraftwerks/media/images/dual-mid.png') top right}#navigation ul.menu li.dir ul li:hover{}#navigation ul.menu li.dir ul li
a{width:171px;font-size:11px;color:#838383;border-bottom:0px solid #CCC;background:url('/ligante3/templates/kraftwerks/media/images/dividerline.png') repeat-x left bottom;padding:5px
0px 4px 8px}#navigation ul.menu li.dir ul li a:hover{padding:5px
0px 4px 8px;background:#F9F9F9 url('/ligante3/templates/kraftwerks/media/images/dividerline.png') repeat-x left bottom}#navigation ul.menu li.dir ul li a
span{font-family:Arial;font-size:11px;font-weight:normal;color:#838383;background:url('/ligante3/templates/kraftwerks/media/images/menuicon.png') no-repeat -10px -11px;;padding-left:15px;padding-right:0px;padding-top:0px;padding-bottom:0px}#navigation ul.menu li.dir ul li.first
a{padding-top:5px}#navigation ul.menu li.dir ul li.postfirst
a{padding-top:5px}#navigation ul.menu li.dir ul
li.last{margin:0px;padding-bottom:0px;border-bottom:0px none}#navigation ul.menu li.dir ul li.last
a{display:block;padding-bottom:4px}#navigation ul.menu li.dir ul
li.last.lft{width:360px;padding:0px
0px 22px 18px;background:url('/ligante3/templates/kraftwerks/media/images/dual-bottom.png') left bottom no-repeat}#navigation ul.menu li.dir ul
li.last.rgt{padding:0px
19px 22px 0px;background:url('/ligante3/templates/kraftwerks/media/images/dual-bottom.png') right bottom no-repeat}#navigation ul.menu li.dir ul
li.prelast.lft{padding:0px
0px 22px 15px;background:url('/ligante3/templates/kraftwerks/media/images/dual-bottom.png') left bottom no-repeat}#navigation ul.menu li.dir ul li.rgt
ul{left:360px;margin:0px
0px 0px 0px;padding:0px
14px 0px 14px;width:387px;z-index:999}#navigation ul.menu li.dir ul li.lft
ul{left:180px;margin:0px
0px 0px 0px;padding:0px
14px 0px 14px;width:387px;z-index:999}#navigation ul.menu li.dir ul li ul
li.first.lft{padding-top:16px;background:url('/ligante3/templates/kraftwerks/media/images/dual-top.png') left top no-repeat}#navigation ul.menu li.dir ul li ul
li.postfirst.rgt{padding-top:16px;background:url('/ligante3/templates/kraftwerks/media/images/dual-top.png') right top no-repeat}#navigation ul.menu li.dir ul li ul li.first
a{padding-top:4px}#navigation ul.menu li.dir ul li ul li.postfirst.rgt
a{padding-top:4px}#navigation ul.menu li.dir ul li ul
li.last{}#navigation ul.menu li.dir ul li ul
li.first.last{padding-top:16px;background:url('/ligante3/templates/kraftwerks/media/images/dualsingle.png') left top no-repeat}#navigation ul.menu li.dir ul li ul li.first.last
a{padding-bottom:0px}#navigation ul.menu li.dir ul li ul
li.first.prelast{padding-top:16px;background:url('/ligante3/templates/kraftwerks/media/images/dualsingle.png') left top no-repeat}#navigation ul.menu li.dir ul li ul
li.last.postfirst{padding-top:16px;background:url('/ligante3/templates/kraftwerks/media/images/dualsingle.png') right top no-repeat}#navigation ul.menu li.dir ul li ul li.first.prelast:hover{background:url('/ligante3/templates/kraftwerks/media/images/dualsingle-over.png') left top no-repeat}#navigation ul.menu li.dir ul li ul li.last.postfirst:hover{background:url('/ligante3/templates/kraftwerks/media/images/dualsingle-over.png') right top no-repeat}#navigation ul.menu li.dir ul li ul li.first.prelast a, #navigation ul.menu li.dir ul li ul li.last.postfirst
a{background:none}#navigation ul.menu li.dir ul li ul li.first.last
a{}

/*** IE7.css ***/

#cart_wrap{float:left}.latest_blog_item{padding-top:4px;margin-bottom:4px}#login_wrapper{z-index:200}.newspro_items_hot{height:580px !important;margin-bottom:-320px !important}.wall_nav{position:relative;top:46px}#community-wrap .page-action{margin-top:-14px;float:right;position:relative;top:-32px}body #community-wrap div.profile-box{padding:18px}body #community-wrap div.profile-info{position:relative;top:-20px;padding-left:12px}.mini-profile-details .icon-write, .mini-profile-details .icon-add-friend{overflow:hidden;padding:3px
3px 0px 20px}#fb_topmenu,#fb_searchbox{position:relative;top:-28px;left:-20px}#cToolbarNav
.current{top:30px;position:relative}#cToolbarNav dl.tabs dt span, #cToolbarNav dl.tabs
dt{height:27px !important;padding-bottom:10px;position:relative}#component-com_mtree .app-box-info{position:relative;float:left;width:90%}#component-com_mtree .app-box-content, #component-com_eventlist .app-box-content{overflow-y:auto}#component-com_eventlist .app-box-info{float:left}div.tabs-wrap{position:relative;width:720px !important}#user10{overflow:hidden}#nav_container,#nav_shadow{overflow:visible !important}#navigation ul.menu li.back
.left{margin:58px
auto 0px auto}#login_wrapper{z-index:900}#login_wrapper
.login_open_wrap{z-index:900 !important}a.register_joomla{top:68px}.shadetabs li.tab-1, .shadetabs li.tab-2{width:340px}.shadetabs li.tab-1 a, .shadetabs li.tab-2
a{background:none}.shadetabs li.tab-bg-2{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/tab_right.gif') no-repeat}.vm_search
.inputbox{margin-top:0px}

/*** theme.css ***/

#content
p{font-family:Arial,Helvetica,sans-serif;font-size:11px;margin-top:0pt;margin-right:0pt;margin-left:0pt;line-height:130%}#content
p.right{text-align:right}#content
p.last{margin-bottom:0}#content ul, #content
ol{margin:0;list-style-type:none}#content
a{font:Arial, Helvetica, sans-serif;color:#777;text-decoration:none;outline:none;font-weight:none}#content a:hover{text-decoration:none}#content
blockquote{margin:1.5em 0 1.5em 1.5em;font-style:italic}#content
strong{font-weight:bold}#content
ol{list-style-type:decimal}#content
dl{margin:1.5em 0}#content dl
dt{font-weight:none}#content
table{margin-bottom:1.4em;margin:0
auto;width:100%}#fptab content
a{font:Arial,Helvetica,sans-serif;color:#777;text-decoration:none;outline:none;font-weight:none}.addtocart_button,.notify_button{text-align:center;background-position:bottom left;width:160px;height:34px;cursor:pointer;border:none;vertical-align:middle;margin:12px
0 8px 0}.addtocart_button{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/add-to-cart.png') no-repeat  center transparent}.notify_button{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/notify_blue.gif') no-repeat  center transparent}.addtocart_button_module{text-align:center;background-position:bottom left;width:160px;height:30px;cursor:pointer;color:#000;border:none;font-weight:bold;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/transparent.gif') no-repeat  center transparent;vertical-align:middle;overflow:hidden}input.addtocart_button_module:hover{color:#333}.addtocart_form{width:100%;display:inline;white-space:nowrap}.quantity_box{vertical-align:middle}.quantity_box_button{width:10px;vertical-align:middle;height:10px;background-repeat:no-repeat;background-position:center}.quantity_box_button_down{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/down_small.gif)}.quantity_box_button_up{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/up_small.gif)}.continue_link,.checkout_link{margin:2px;padding:2px
0px 2px 40px;vertical-align:middle;font-weight:bold;font-size:1.4em;width:40%}.checkout_link{margin-left:40px;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/forward.png') no-repeat left}.continue_link{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/back.png') no-repeat left}.next_page{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/next_16x16.png') no-repeat right;padding-right:30px;line-height:20px;float:right;width:auto;margin-top: -50px;margin-bottom:40px}.previous_page{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/previous_16x16.png') no-repeat left;padding-right:80px;line-height:20px;float:right;width:auto;margin-top: -50px;margin-bottom:40px}.legalinfo{background:#d3d3d3;border:2px
solid gray;margin:10px;padding:0px
0px 10px 10px}div.pathway{margin-bottom:1em}div.pathway
img{padding:0
2px}div.buttons_heading{margin:10px;width:100%;float:left}.buttons{float:left;padding:3px
3px 0 3px}.productPrice{margin:12px
0 12px 0;white-space:nowrap}.price{margin-top:12px;font-size:18px}.product-Old-Price{text-decoration:line-through}.browseProductContainer{width:100%;padding-top:24px;vertical-align:top;float:left}.browseProductPopUpContainer{width:74%;padding:3px
3px 3px 3px;vertical-align:top}.productSeperator{width:100%;float:left}.browseProductTitle{text-align:center;font-size:14px;font-weight:bold;margin-top:3px;color:#777;line-height:12px}.browsePriceContainer{text-align:center;font-size:18px !important;padding-bottom:12px}.browseRatingContainer{padding:17px
15px 16px 15px;;white-space:nowrap}.browseProductImageContainer{align:center;width:120px;height:120px}.browseProductDetailsContainer{float:left;color:#ff0;background-color:#F00;width:100%}.browseProductDescription{margin-top:17px;margin-bottom:10px;width:93%}.browseProductPopUpDescription{margin-top:17px;margin-bottom:10px;width:50%}.browseAddToCartContainer{width:30%;text-align:center}.browsebottom{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/app-box-filerlink.png') no-repeat 0 0;padding-top:16px;margin-left: -14px;margin-right: -54px;margin-bottom:16px;width:100%;color:#777}.browsedesc{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/app-box-filerlink.png') no-repeat 0 0;padding:16px;font-size:14px;font-weight:bold;color:#777;line-height:12px;margin-top: -13px;margin-left: -15px;margin-right: -54px;margin: -13px -15px 0 -15px;border-bottom:1px solid #e7e7e7}.browsedesc2{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/app-box-filerlink.png') no-repeat 0 0;padding:16px;margin:0
-15px 0 -15px}.browsedesc3{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/app-box-filerlink.png') no-repeat 0 0;margin:14px
-15px 0 -15px }.thumbnailListContainer{text-align:center;width:200px;height:200px;overflow:auto}.formLabel{float:left;width:30%;text-align:right;font-weight:bold;margin:2px;white-space:nowrap;clear:left;vertical-align:middle;margin-top:8px}#agreed_div{white-space:normal}.formField{float:left;width:60%;margin:2px;vertical-align:middle;margin-top:8px}.missing{color:red;font-weight:bold}.adminListHeader{float:left;height:48px;background-repeat:no-repeat;text-align:left;font-size:18px;font-weight:bold;padding-left:80px}.labelcell{margin-left:auto;font-weight:bold;vertical-align:top;width:30%}table.adminform
td.labelcell{text-align:right}.iconcell{vertical-align:top;width:5%}.shop_error,.shop_warning,.shop_info,.shop_debug,.shop_critical,.shop_tip{background-color:#FAFAD2;background-position:left 5px;background-repeat:no-repeat;border-color:#ACA;border-style:dotted none;border-width:1px 0pt;font-weight:900;margin:1pt 1pt 1em 1em;padding:0.5em 1em 1.5em 48px}.shop_error{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/error.gif)}.shop_warning{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/warning.png)}.shop_info,.shop_tip{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/info.png)}.shop_debug{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/log_debug.png)}.shop_critical{font-weight:bold;background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/log_critical.png)}.vmCartContainer{width:202px}.cartwrap{background-image:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/cartpack.png);width:202px;height:252px}.cartinner{padding-left:20px}.qtyboxtop{width:202px;height:48px}.qty{padding:12px
0 0 12px}.cartpad{padding-top:4px}.cartpad2{padding-top:30px}.cartpad3{padding-top:8px}.vmCartChildHeading{font-size:14px;font-weight:bold;padding-bottom:3px;text-align:left}.vmCartChild{width:100%;vertical-align:middle;padding-left:2px;padding-right:2px;margin-bottom:2px;float:left;background:none}.vmChildDetail{vertical-align:middle;margin-top:6px;background:none}.vmCartChildElement{width:100%;vertical-align:middle;height:25px;text-align:left}.vmCartAttributes{margin-top:8px;width:100%;background-color:transparent}.vmAttribChildDetail{}.vmMultiple{height:35px}.vmChildType{width:100%}.vmClearDetail{clear:both}.vmClearAttribs{clear:both}.vmRowOne{background:#d3d3d3}.vmRowTwo{background:white}.vmChildDetail a, .vmChildDetail a:link{font-size:11px;color:#777;text-decoration:none;font-weight:bold}.vmChildDetail a:hover{font-size:11px;color:#333;text-decoration:none;font-weight:bold}.inputboxquantity{margin-top:3px;vertical-align:middle}.availabilityHeader{text-decoration:underline;font-weight:bold}.inputboxattrib{float:left;margin-top:0px;vertical-align:middle;margin-bottom:2px}.quantitycheckbox{margin-top:6px;vertical-align:middle}.vmCartContainer_2up{width:100%;float:left;background:#ADD8E6;border:1px
solid #000;padding:3px}.vmCartChildHeading_2up{font-size:14px;font-weight:bold;padding-bottom:3px;text-align:left}.vmCartChild_2up{vertical-align:middle;border:1px
solid #000;padding-left:2px;padding-right:2px;margin-bottom:2px;float:left}.vmChildDetail_2up{vertical-align:middle;margin-top:6px}.vmCartChildElement_2up{width:100%;vertical-align:middle;height:25px;text-align:left}.vmCartAttributes_2up{float:left;padding:0px
5px 5px 5px;margin:0px
5px 5px 5px;width:50%}.vmAttribChildDetail_2up{}.vmMultiple{height:35px}.vmChildType_2up{background:#ADD8E6;padding:0px
5px 5px 5px;margin:0px
5px 5px 5px;float:left;width:40%;border:1px
solid #000}.vmClearDetail_2up{}.vmClearAttribs_2up{clear:both}.vmRowOne_2up{background:#d3d3d3}.vmRowTwo_2up{background:white}.vmChildDetail_2up a, .vmChildDetail_2up a:link{font-size:11px;color:#777;text-decoration:none;font-weight:bold}.vmChildDetail_2up a:hover{font-size:11px;color:#333;text-decoration:none;font-weight:bold}.vmCartModuleList{cursor:pointer;font-size:11px;color:#777;text-decoration:none;font-weight:bold}.vmCartModuleList:hover{font-size:11px;color:#333;text-decoration:none;font-weight:bold}.vmquote{margin:4px;border:1px
solid #ccc;background-color:#E9ECEF;padding:10px;font-size:12px;color:#254D78}.editable{background:#ff3;cursor:pointer}div.pagination-left{float:left;width:5px;height:20px;background:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/nav-bg-lft.gif)}div.pagination-right{float:left;width:5px;height:20px;background:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/nav-bg-rgt.gif) top right}ul.pagination{overflow:auto;float:left;background:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/nav-bg.gif)}ul.pagination
li{display:block;float:left;margin:0px
10px 0px 0px;padding:1px
0px 2px 0px}.clr{clear:both;overflow:hidden}.vote
it{float:left}.sliderwrapper{position:relative;overflow:hidden;width:300px;height:250px}//David Fuentes CSS Code for Tabs Slider
.sliderwrapper{position:relative;overflow:auto}.contentdiv{width:100%;position:absolute;visibility:hidden;border:0px
solid}.orderby{float:right}.shadetabs{}.shadetabs
ul{padding:3px
0;margin-left:0;margin-top:1px;margin-bottom:0;font:bold 12px Arial, Helvetica, sans-serif;list-style-type:none;text-align:left}.shadetabs
li{display:inline;margin:0}.shadetabs li
a{text-decoration:none;padding:3px
7px;margin-right:3px;color:#2d2b2b;//background: white url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/media/shade.gif) top left repeat-x}.shadetabs li a:visited{color:#2d2b2b}.shadetabs li a:hover{text-decoration:underline;color:#2d2b2b}.shadetabs li a:focus{text-decoration:underline;background:#eee;color:#2d2b2b}.shadetabs
li.selected{position:relative;top:1px}.shadetabs li.selected
a{background:#999;border-bottom-color:white}.shadetabs li.selected a:hover{text-decoration:none}.pd_wrapper{padding:5px;margin-top:0px;margin-left:5px;margin-bottom:10px}.pd_link{width:100px;height:100px;padding:0px}.pd_name{color:#ffea76;color:#930058;font-family:Tahoma,sans-serif;font-weight:bold;font-size:12px;text-transform:uppercase}.pd_ttwrapper{border:1px
solid #ccc;padding:12px;font-family:Tahoma,sans-serif;width:300px;height:100px;padding:12px;font-size:9px;line-height:133% !important;color:#ebebeb !important;background:#fefefe}.pd_ttlink{color:#ffea76;font-weight:bold;font-size:9px;text-transform:uppercase}.pd_ttimgdiv ={height:100px;float:left}.pd_ttimg{width:100px;height:100px;padding:0;margin:0;float:left}table.product-thumbs{margin:10px
0px 0px 0px}table.product-thumbs div.thumb-wrap{width:60px;height:60px;margin:5px;padding:3px;border:1px
solid #CCC}.reviews{padding:12px
0 12px 0;margin-bottom:14px;border-bottom:1px solid #CCC}div.tabs-wrap{width:730px;height:28px;margin-left: -14px;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/tab_back.gif')}li.tab-1{width:350px;height:48px;float:left;margin-top: -10px;padding:16px
0 0 12px}li.tab-bg-1{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/tab_left.gif') top right no-repeat}li.tab-2{width:350px;height:48px;float:right;margin-top: -10px;padding:16px
0 0 12px}li.tab-bg-2{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/tab_right.gif')top left no-repeat}.specs{padding:12px
0 12px 0;border-bottom:1px solid #CCC;color:#777}.cat_diva{width:123px;height:190px;background:#fff url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/vmboxshadow.png) top repeat-x}.cat_divb{width:123px;height:190px;background:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/vmbottomfade.png) bottom repeat-x}.cat_divc{width:123px;height:190px;background:url(/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/rightvborder.png) right repeat-y;border-bottom:1px solid #fff;font-size:11px !important;text-align:center}.cat_name{padding:20px
0 20px 0;font-weight:bold}.cat_img
img{margin:10px
0 10px 0;width:100px;height:100px}.rctBox{margin:-5px 0px 0px -12px;padding:0px;border:none}.rctSlideBtn{float:left}.rctSlideBtn
img{width:15px;height:79px;border:none;margin:0px;padding:0px}.rctSliderWrap{float:left;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/rctSlideBkg.png') top left no-repeat;width:313px;height:79px;margin:0px;padding:0px
5px 0 5px}.rctImg{width:42px;height:42px;margin:10px
3px 25px 3px;border:2px
solid #e7e7e7}.rctTip{width:150px;height:50px;margin:-13px 0px 0px 0px;padding:12px;font-size:9px;line-height:133% !important;color:#ebebeb !important;background:#666}.rctTip
a{color:#ffea76;font-weight:bold;font-size:9px;text-transform:uppercase}.cartBox{margin:-29px 0px 0px 0px;width:610px;height:79px
padding:0px;border:none}.cartSlideBtn{float:left}.cartSlideBtn
img{width:15px;height:79px;border:none;margin:0px;padding:0px}.cartSliderWrap{float:left;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/cartSlideBkg.png') top left no-repeat;width:313px;height:79px;margin:0px;padding:0px
5px 0 5px}.cartImg{width:42px;height:42px;margin:10px
3px 25px 3px;border:2px
solid #e7e7e7}.cartTip{width:150px;height:50px;margin:-13px 0px 0px 0px;padding:12px;font-size:9px;line-height:133% !important;color:#ebebeb !important;background:#666}.cartRightFiller1{margin-left:20px;float:left;width:8px;height:41px;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/cartRightBkg1.png') top left no-repeat}.cartRight{float:left;background:#fff url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/cartRightBkg2.png') top left repeat-x;padding:0px;height:41px;width:220px}.cartRightFiller2{float:left;width:8px;height:41px;background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/cartRightBkg3.png') top left no-repeat}.cartTxt{float:left;padding:12px
10px 0px 0px;margin:0px;color:#767676;font-family:Arial,sans-serif;font-size:11px}.cartBtn{float:right;margin:0px}.cartBtnImg{padding:0px;margin:7px
0 0 0;border:none}.jxtcViewOn{text-decoration:underline;font-weight:bold}.jxtcViewOff{text-decoration:none;font-weight:normal}.gridView,listView{float:none;margin:0px
-15px 0px 0px;border:none;padding:0px;overflow:hidden}.gridView
.box_wrap{float:left}.gridView .box_diva, .gridView .box_divb, .gridView
.box_divc{width:147px;height:255px}.gridView
.box_img{float:none;background-color:#fff}.gridView .box_img
img{width:120px;height:120px;border:none;margin:16px
0 0 0}.gridView
.box_name{float:none;padding:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#666;margin-top:0px;margin-top:4px;margin-bottom:7px}.gridView
.box_desc{display:none;text-align:center;width:300px;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#666;margin-top:0px;margin-top:4px;margin-bottom:7px}.gridView
.box_price{float:none;width:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px !important;font-weight:bold;color:#f00;margin-top:6px;margin-bottom:0px}.gridView
.box_info{float:none;margin:0px}.listView
.box_wrap{float:none;clear:both}.listView .box_diva, .listView .box_divb, .listView
.box_divc{width:735px;height:150px}.listView
.box_img{float:left}.listView .box_img
img{margin:10px
0 0 8px;padding:5px;background-color:#fff;border:1px
solid #e7e7e7;width:120px;height:120px}.listView
.box_name{float:left;text-align:left;padding:15px
20px 0 20px;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#666;margin-top:0px;margin-top:4px;margin-bottom:7px}.listView
.box_desc{display:block;text-align:left;padding-right:20px;width:330px;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#666;margin-top:4px;margin-bottom:7px}.listView
.box_price{float:left;font-family:Arial,Helvetica,sans-serif;font-size:18px !important;font-weight:bold;color:#f00;margin:60px
0 0 0;width:100px}.listView
.box_info{float:left;margin:50px
0 0 0}.cartout{background:url('/ligante3/components/com_virtuemart/themes/jxtc_kraftwerks/images/cartout.png') top left no-repeat;width:200px;height:200px}