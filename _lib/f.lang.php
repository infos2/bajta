<?php
/* LANGUAGE */
function languages(){
	static $languages;
	if (!empty($languages)) return $languages;
	// else build from DB
	$languages = db_getLanguages();
	return $languages;
}

function lns(){
	$languages = languages();
	foreach ($languages as $language) $lns[] = $language->ln;
	return $lns;
}

function setLn(){
	global $get;
	if (!empty($get->ln) and is_valid_ln($get->ln)) $_SESSION['ln'] = $get->ln;
	elseif(empty($_SESSION['ln'])) $_SESSION['ln'] = DEFAULT_LANG;
}

function getLn(){
	return $_SESSION['ln'];
}

function is_valid_ln($ln){
	$lns = lns();
	return in_array($ln,$lns);
}

/* HELPER */
function db_getLanguages(){
	$sql="SELECT ln,jezik FROM ".TBL."jezici WHERE 1";
	$jezici = db::query_to_objects($sql);
	return $jezici;
}