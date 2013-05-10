<?php
/* REQUIRE */
require '_lib/_config.php';
require '_lib/f.front.php';
require '_lib/f.template.php';  // if you want Template $PARTs
require '_lib/f.lang.php';		// if you want Languages

/* LANG LOGIC */
setLn();

/* HTML */
if(!ob_start("ob_gzhandler")) ob_start('compress');
$PART = new TemplateParts();

/* other HTML template chunks */
$PART->languages_menu = languagesMenu();
$PART->navigation = navigation();
$PART->pages = stranice_HTML();
$PART->live_site = $live_site;

processTemplate('front');
ob_end_flush();