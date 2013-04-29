<?php
/* REQUIRE */
require '../_lib/_config.php';
require '../_lib/f.admin.php';
require '../_lib/f.template.php';  	// if you want Template $PARTs
require '../_lib/f.lang.php';		// if you want Languages

/* Login - Logout */
if (isset($get->logout)) userLogout();
if (!userLoggedIn()) require 'login.php';
$user = getUser();

/* HTML */
if(!ob_start("ob_gzhandler")) ob_start('compress');
$PART = new TemplateParts();

/* TAB-MODULE set LOGIC */
$module = !empty($get->m) ? $get->m : null;
$action = !empty($get->a) ? $get->a : null;
$req_tab = $tab = !empty($get->t) ? $get->t : 'stranice'; #NOTE default
$req_mod = !empty($module) ? '_'.$module : null;
$req_fpt = $req_tab.$req_mod.'.php';

/* TAB-MODULE-ACTION display LOGIC */
if ($action or !$post->isEmpty) file_exists($sitepath.'spark/logic/'.$req_fpt) ? require 'logic/'.$req_fpt : die('Pogreska logike');
file_exists($sitepath.'spark/tabs/'.$req_fpt) ? require 'tabs/'.$req_fpt : die('Pogreska sustava');

$PART->live_site = $live_site;
$PART->navigation = navigation();
$PART->actions = false; #TMP
$PART->user_name = $user->ime;
/* other HTML template chunks*/

processTemplate('admin');
ob_end_flush();