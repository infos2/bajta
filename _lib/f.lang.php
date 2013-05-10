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
	global $xurl;
	if (!empty($xurl->p1)){
		if (getLn()==$xurl->p1) return;
		else $_SESSION['ln'] = $xurl->p1;
	}
	else {
		if (empty($_SESSION['ln'])) $_SESSION['ln'] = DEFAULT_LANG;
		phpRedirect(getLn().'/');
	}
}

function getLn(){
	return $_SESSION['ln'];
}

function is_valid_ln($ln){
	$lns = lns();
	return in_array($ln,$lns);
}
function prepJezikToLn($jezik){
	return strtolower(substr($jezik,0,2));
}

/* HELPER */
function db_getLanguages(){
	$sql="SELECT ln,jezik,published FROM ".TBL."jezici WHERE 1";
	$jezici = db::query_to_objects($sql);
	return $jezici;
}
