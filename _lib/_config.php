<?php
/* INI SET */
ini_set('session.use_trans_sid', 0);
ini_set('url_rewriter.tags', '');
ini_set('memory_limit','128M');
date_default_timezone_set('Europe/Zagreb');

/* SERVER BASED CONSTANTS */
(bool)strpos($_SERVER['HTTP_HOST'],'.loc') ? 
	define("TESTSERVER",true): 
	define("TESTSERVER",false);

/* ERROR reporting */
TESTSERVER ? 
	error_reporting(E_ALL ^ E_NOTICE): 
	error_reporting(E_ERROR);
ini_set("display_errors", 0);
ini_set("error_log","3RR0R.log");
ini_set("log_errors",1);

/* DB */
define("DB_SERVER","localhost");
define("DB_NAME","racbajhr_db");
define("DB_USER","racbajhr_admin");
define("DB_PASS","bajta.941");
define("TBL","bajta13_");

require 'c.database.php';
db::getInstance();

/* OTHER definitions */
define("MAGIC_SALT",'!/;).(@%1#x?r23A4<$g$%F"x0]b:kH-B{+4[Uw&9}');
require 'definitions.php';

/* SESSION */
ini_set("session.cookie_domain",$_SERVER['HTTP_HOST']); 
session_start();

/* ESSENTIALS */
require 'f.core.php';
require 'f.user.php';

/* GLOBALS */
$protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http';
$live_site = $protocol.'://'.$_SERVER['HTTP_HOST'].'/';
$sitepath = $_SERVER['DOCUMENT_ROOT'];
forceWWW();

$get = (object)$_GET; $get->isEmpty = count(get_object_vars($get))>0 ? false : true;
$post = (object)$_POST; $post->isEmpty = count(get_object_vars($post))>0 ? false : true;
$session = (object)$_SESSION;
class object{}

/* SET HEADERS */
header('Content-Type: text/html; charset=utf-8');