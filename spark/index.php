<?php
/* REQUIRE */
require '../_lib/_config.php';
require '../_lib/f.admin.php';
require '../_lib/f.template.php';  	// if you want Template $PARTs

/* Login - Logout */
if (isset($get->logout)) userLogout();
if (!userLoggedIn()) require 'login.php';
$user = getUser();

if(!ob_start("ob_gzhandler")) ob_start('compress');
$PART = new TemplateParts();

$PART->live_site = $live_site;
$PART->user_name = $user->ime;
/* other HTML template chunks*/

processTemplate('admin');
ob_end_flush();