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
function prepJezikToLn($jezik){
	return strtolower(substr($jezik,0,2));
}

/* HELPER */
function db_getLanguages(){
	$sql="SELECT ln,jezik,published FROM ".TBL."jezici WHERE 1";
	$jezici = db::query_to_objects($sql);
	return $jezici;
}
function db_insertLang(){
	global $post;
	$sql="INSERT INTO ".TBL."jezici(jezik,ln,published) VALUES('".db::sqli($post->jezik)."','".db::sqli(prepJezikToLn($post->jezik))."',0)";
	return db::query($sql);
}
function db_updateJezik($jezik){
	$sql="UPDATE ".TBL."jezici SET published=".$jezik->published." WHERE ln='".$jezik->ln."'";
	return db::query($sql);
}