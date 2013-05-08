<?php
/* LANGUAGE */
function languages($ln=false){
	static $languages;
	if (!empty($languages)) return $languages;
	// else build from DB
	$languages = array();
	$lno = db_getLanguages();
	foreach ($lno as $lang) $languages[$lang->ln] = $lang->jezik;
	return $languages;
}

function setLn(){
	$_SESSION['ln'] = getLn();
}

function getLn(){
	global $get;
	if (THIS_IS_ADMIN===true) return DEFAULT_LANG;
	if(isset($get->lang))$_SESSION['ln']=$get->lang;
	return (isset($_SESSION['ln'])) ? $_SESSION['ln'] : DEFAULT_LANG;
}

/* HELPER */
function db_getLanguages(){
	$sql="SELECT ln,jezik FROM ".TBL."jezici WHERE 1";
	$jezici = db::query_to_objects($sql);
	return $jezici;
}