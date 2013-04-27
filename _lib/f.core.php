<?php
/* HASHING */
function md1_minihash($input){ // Fast, more secure
	return md5(MAGIC_SALT.$input);
}

/* SERVER */
function phpRedirect($location=''){
	global $live_site;
	header('Location: '.$live_site.$location); die();
}

function refresh(){
	global $subdir;
	$req = $_SERVER['REQUEST_URI'];
	$cpage = (strpos($req,'/')===0) ? substr($req,1) : $req;
	$cpage = str_replace($subdir,'',$cpage);
	phpRedirect($cpage);
}

function switchSSL($ssl_on){
	global $live_site;
	$ssl_now = empty($_SERVER['HTTPS']) ? false : true;
	if ($ssl_on==$ssl_now or TESTSERVER) return true;
	$live_site = $ssl_on ? str_replace('http:','https:',$live_site) : str_replace('https:','http:',$live_site);
	refresh();
}

function forceWWW(){
	global $live_site,$protocol;
	if (TESTSERVER) return false;
	if (strpos($live_site,'://www.')) return false;
	$www_livesite = str_replace($protocol.'://',$protocol.'://www.',$live_site);
	// 301 Redirect
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: '.$www_livesite.substr($_SERVER["REQUEST_URI"],1));
	die();
}

/* VAR type aware HTML printers sorters handlers */
function var_dumpf($vars){
	$vars = func_get_args();
	foreach ($vars as $var) echo print_variable($var);
}

function print_variable($var,$lvl=0){
	if (is_object($var)) return 'stdClass Object['.count(get_object_vars($var)).']<br/>'.print_object($var,$lvl+1);
	elseif (is_array($var)) return 'Array['.count($var).']{<br/>'.print_array($var,$lvl+1).str_repeat('&nbsp;',$lvl*5).'}<br/>';
	else {
		if (is_string($var)) return 'string('.strlen($var).')"'.$var.'"<br/>';
		elseif(is_bool($var)) return gettype($var).'('.($var==1 ? 'true' : ' false').')<br/>';
		elseif(is_scalar($var)) return gettype($var).'('.$var.')<br/>';
		else return gettype($var).'<br/>';
	}
}

function print_array($array,$lvl){
	foreach ($array as $key => $value) {
		$print.= str_repeat('&nbsp;',$lvl*5).'['.$key.']=>'.print_variable($value,$lvl);
	}
	return $print;
}

function print_object($object,$lvl){
	$vars = get_object_vars($object);
	foreach ($vars as $key => $value){
		$print.= str_repeat('&nbsp;',$lvl*5).'['.$key.']=>'.print_variable($value,$lvl);
	}
	return $print;
}

function echof($string){
	echo $string.'<br/>';
}