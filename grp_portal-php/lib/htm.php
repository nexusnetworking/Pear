<?php
   bindtextdomain('miitoo', '../l10n/');
   bindtextdomain('community', '../l10n/');

function printHeader($is_act) {
global $pagetitle;
global $has_header_js;
if(!empty($_SESSION['pid'])) {
global $mysql;
$lookup_user = $mysql->query('SELECT * FROM people WHERE people.pid = "'.$_SESSION['pid'].'" LIMIT 1')->fetch_assoc(); }
if($is_act == true && $is_act === true) { $pagetitle = 'Pear ID'; } elseif($is_act == 'err' && empty($pagetitle)) { $pagetitle = loc('grp.portal.error'); }
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	print '<title>'.(isset($pagetitle) ? $pagetitle : 'grp.portal.page_title').' - Pear</title>
	';
	$GLOBALS['div_body_head'] = null; $GLOBALS['div_body_head_end'] = null;
} else {
	$GLOBALS['div_body_head'] = '
	<div id="body">'; $GLOBALS['div_body_head_end'] = '
	</div>
	';
	print '<!DOCTYPE html>


<html lang="en">
  <head>
    <link rel="icon" href="/favicon.ico">
    <meta charset="utf-8">
	<title>'.(isset($pagetitle) ? $pagetitle : 'grp.portal.page_title').' - Pear</title>
	';

if(strpos($_SERVER['HTTP_USER_AGENT'], 'miiverse') !== false) { $theme_css_file = '/css/portal-grp.css'; } else {
if(!empty($_COOKIE['grp_theme'])) {
if($_COOKIE['grp_theme'] == 'grape' || $_COOKIE['grp_theme'] == 'blueberry' ||  $_COOKIE['grp_theme'] == 'cherry' ||  $_COOKIE['grp_theme'] == 'orange') {
$theme_css_file = '/css/portal-grp_offdevice_'.htmlspecialchars($_COOKIE['grp_theme']).'.css'; } 
else { $theme_css_file = '/css/portal-grp_offdevice.css'; } } else { $theme_css_file = '/css/portal-grp_offdevice.css'; } }

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'miiverse') !== false) {
	$theme_js_file = '/js/portal/complete.js'; } elseif($is_act && $is_act === true) { $theme_js_file = null; } else { $theme_js_file = '/js/portal/complete-emu.js'; }
	print '
	<link rel="stylesheet" type="text/css" href="'.$theme_css_file.'">';
	if(empty($has_theme_js)) { print '
	<script src="'.$theme_js_file.'"></script>'; } print "\n";
print '</head>
<body'.($is_act == true && $is_act === true ? ' id="help"' : null).'
';
if($is_act == false) {
if(!empty($_SESSION['pid'])) {
       print 'data-hashed-pid="'.sha1($_SESSION['pid']).'"
	   ';
       print 'data-user-id="'.htmlspecialchars($lookup_user['user_id']).'"
	   ';
       print 'data-game-skill="0" data-follow-done="1" data-post-done="1" data-lang="en" data-country="us" data-post-done="1"
	   ';
       print 'data-profile-url="/users/'.htmlspecialchars($_SESSION['user_id']).'"
	   ';
	   } else {
	   print '
	   data-user-id="" 
	   data-is-first-post="1"';
} }

print '>


';    
	
}

}

function printFooter() {
global $pagetitle;
print '
    <a id="scroll-to-top" href="#" style="display:none"></a>
<div id="message-dialog-template"   class="window-page none">
  <div class="window">
    <h1 class="window-title">'.(isset($pagetitle) ? $pagetitle : 'grp.portal.page_title').'</h1>
    <div class="window-body"><div class="window-body-inner message">
      <p class="pre-line"></p>
    </div></div>
    <div class="window-bottom-buttons single-button">
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>

<div id="confirm-dialog-template"   class="window-page none">
  <div class="window">
    <h1 class="window-title">'.(isset($pagetitle) ? $pagetitle : 'grp.portal.page_title').'</h1>
    <div class="window-body"><div class="window-body-inner message">
      <p></p>
    </div></div>
    <div class="window-bottom-buttons">
      <a href="#" class="button cancel-button" data-sound="SE_WAVE_CANCEL">Cancel</a>
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>

<div id="parental-confirm-dialog-template"   class="window-page none">
  <div class="window">
    <h1 class="window-title">'.(isset($pagetitle) ? $pagetitle : 'grp.portal.page_title').'</h1>
    <div class="window-body">
      <div class="window-body-inner message">
        <p></p>
        <input type="password" controller="drc" minlength="4" maxlength="4" inputform="monospace" guidestring=" " class="parental_code textarea-line" name="parental_code" placeholder="Tap to enter the PIN." keyboard="pin">
      </div>
    </div>
    <div class="window-bottom-buttons">
      <a href="#" class="button cancel-button" data-sound="SE_WAVE_CANCEL">Back</a>
      <a href="#" class="button ok-button">OK</a>
    </div>
  </div>
</div>
<div id="capture-page"
     class="capture-page window-page none"
     data-modal-types="capture"
     data-is-template="1">
    <div class="capture-container">
        <div><img src="data:image/gif;base64,R0lGODlhEAAQAIAAAP%2F%2F%2FwAAACH5BAEAAAAALAAAAAAQABAAAAIOhI%2Bpy%2B0Po5y02ouzPgUAOw%3D%3D" class="capture"></div>
        <a href="#" class="olv-modal-close-button cancel-button accesskey-B" data-sound="SE_WAVE_CANCEL"><span>Back</span></a>
    </div>
</div>
';
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') { print '
  </body>
</html>
'; }
}

function truncate($text, $chars) {
$truncate_post_bodyp1 = mb_substr(($text), 0, $chars);
return (mb_strlen($text) >= $chars + 1 ? $truncate_post_bodyp1.'...' : $truncate_post_bodyp1);
}

function printMenu() {
if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {

	if(!empty($_SESSION['pid'])) {
global $mysql;
$lookup_user = $mysql->query('SELECT * FROM people WHERE people.pid = "'.$_SESSION['pid'].'" LIMIT 1')->fetch_assoc();
	print '<menu id="global-menu">
      <li id="global-menu-mymenu"><a href="/users/'.htmlspecialchars($lookup_user['user_id']).'" data-pjax="#body" data-sound="SE_WAVE_MENU"><span class="mii-icon"><img src="'.getMii($lookup_user, false)['output'].'" alt="'.loc('grp.portal.my_page').'"></span><span>'.loc('grp.portal.my_page').'</span></a></li>
      <li id="global-menu-feed"><a href="/" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.activity').'</a></li>
      <li id="global-menu-community"><a href="/communities" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.community').'</a></li>
      <li id="global-menu-message"><a href="/friend_messages" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.message').'<span class="badge" style="display: none;">0</span></a></li>
      <li id="global-menu-news"><a href="/news/my_news" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.news').'<span class="badge" style="display: none;">0</span></a></li>
      <li id="global-menu-exit"><a href="http://google.com" data-sound="SE_WAVE_EXIT">'.loc('grp.portal.exit').'</a></li>
      <li id="global-menu-back" class="none"><a href="#" role="button" class="accesskey-B" data-sound="SE_WAVE_BACK">'.loc('grp.portal.back').'</a></li>
    </menu>
'; } else {
	print '
    <menu id="global-menu">
      <li id="global-menu-mymenu"><a href="/guest_menu" data-pjax="#body" data-sound="SE_WAVE_MENU"><span class="mii-icon"><img src="/img/mii/img_unknown_MiiIcon.png" alt="'.loc('grp.portal.my_menu_for_guest').'"></span><span>'.loc('grp.portal.my_menu_for_guest').'</span></a></li>
      <li id="global-menu-feed"><a href="javascript:alert(\'An account is required to use this feature. Create one in Guest Menu.\');" data-pjax="#body" data-sound="SE_WAVE_MENU">Activity Feed</a></li>
      <li id="global-menu-community"><a href="/communities" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.community').'</a></li>
      <li id="global-menu-message"><a href="javascript:alert(\'An account is required to use this feature. Create one in Guest Menu.\');" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.message').'<span class="badge" style="display: none;">0</span></a></li>
      <li id="global-menu-news"><a href="javascript:alert(\'An account is required to use this feature. Create one in Guest Menu.\');" data-pjax="#body" data-sound="SE_WAVE_MENU">'.loc('grp.portal.news').'<span class="badge" style="display: none;">0</span></a></li>
      <li id="global-menu-exit"><a href="http://google.com" data-sound="SE_WAVE_EXIT">'.loc('grp.portal.exit').'</a></li>
      <li id="global-menu-back" class="none"><a href="#" role="button" class="accesskey-B" data-sound="SE_WAVE_BACK">'.loc('grp.portal.back').'</a></li>
    </menu>
';
	}
} }

function actTemplate($subheader, $location, $content) {
printHeader(true);
print '	<div id="body">
<header id="header">
  
  <h1 id="page-title">Grape::Account</h1>

</header>

<div class="help-left-button">

  <a href="'.$location.'" class="guide-exit-button exit-button index" data-sound="SE_WAVE_BACK">Cancel</a>
</div>
<h2 id="sub-header" class="guide-sub-header">'.$subheader.'</h2>
<div id="guide" class="help-content"><style>.btn_001 { 
margin:0 30px 35px 20px; float:left; 
display:block; width:355px; height:60px; line-height:60px; text-align:center; margin:auto; font-size:26px; color:#323232; text-decoration:none; 
    background:-webkit-gradient(linear, left top, left bottom, from(#ffffff), color-stop(0.5, #ffffff), color-stop(0.8, #f6f6f6), color-stop(0.96, #f5f5f5), to(#bbbbbb));
  border: 0;
  margin: 0;
    border-radius:50px; box-shadow:0 3px 10px 0 #555555; text-align:center; margin:10px; padding:auto; text-decoration:none; cursor:pointer; }
.textbox{ background:#ffffff; border:2px #747474 solid; border-radius:10px; color:#828282; box-shadow: 0 2px 6px 1px #aaaaaa inset; }</style>
'.$content.'
    </div>
	';
printFooter();
}

function nocontentWindow($message) {
print '<div class="no-content-window"><div class="window">
        <p>'.$message.'</p>
      </div></div>'; }

function generalError($code, $message) {
(empty($_SERVER['HTTP_X_REQUESTED_WITH']) ? http_response_code($code) : null);
global $pagetitle;
if(empty($pagetitle)) {
$pagetitle = loc('grp.portal.error');
}
printHeader('err');
printMenu();
print $GLOBALS['div_body_head']; print "\n".'<header id="header">
<h1 id="page-title" class="left">'.$pagetitle.'</h1>
</header>';
print '<div class="body-content track-error" data-track-error="'.$code.'">';
noContentWindow((!empty($message) ? $message : loc('grp.portal.error_general'))); print $GLOBALS['div_body_head_end']; printFooter();
}

function plainErr($code, $message) {
http_response_code(!empty($code) ? $code : 403);
header('Content-Type: text/plain');
print !empty($message) ? $message."\n" : "403 Forbidden\n";
}

function notLoggedIn() {
if(isset($_SERVER['HTTP_X_PJAX'])) {
header('Content-Type: application/json');
http_response_code(401);
exit(json_encode(array('success' => 0, 'errors' => [array('message' => 'You have been logged out.
Please log back in.', 'error_code' => 1510110)], 'code' => 401)));
}
else {
plainErr(403, '403 Forbidden');
	} 
}
