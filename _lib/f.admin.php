<?php
/** 
 * @access only authorized administrators
 * tu idu CRUD funkcije za bazu koje ne smiju biti dostupne nigdje drugdje nego u adminu
 */

function navigation(){
	$navigation = navigationStranice().navigationOstalo();
	return wrap($navigation,'ul','menu');
}

function navigationStranice(){
	$stranice = db_dohvatiStranice();
	foreach($stranice as $stranica){
		$navCont.=wrap('<a href="'.navigationStranice_url($stranica->id).'">'.$stranica->naziv.'</a>','li');
	}
	return $navCont;
}
function naslovStranice(){
	global $get;
	$stranica=db_dohvatiStranicu($get->id);
	return wrap($stranica->naziv,'h2');
}
function navigationStranice_url($id_stranice){
	return '?t=stranice&id='.$id_stranice;
}

function navigationOstalo(){
	$naviOstalo = '
        	<span><a href="{LIVE_SITE}" target="_blank"><img src="/images/admin/elementi/view.png" />View site</a></span>
			<span><a href="?logout=true"><img src="/images/admin/elementi/log_out.png" />Log out</a></span>';
	return wrap($naviOstalo,'li','menu-right');
}

/* STRANICE */
function db_dohvatiStranice(){
	$sql="SELECT id,naziv FROM ".TBL."stranice";
	$stranice=db::query_to_objects($sql);
	return $stranice;
}
function db_dohvatiStranicu($id_stranice){
	$sql="SELECT id,naziv FROM ".TBL."stranice WHERE id=".db::sqli($id_stranice);
	$stranica = db::query_to_object($sql);
	return $stranica;
}

function db_dohvatiPrijevod($id_stranice,$ln){
	$sql="SELECT naslov,sadrzaj FROM ".TBL."sadrzaj WHERE id_stranice=".db::sqli($id_stranice)." AND ln='".db::sqli($ln)."'";
	$prijevod=db::query_to_object($sql);
	return $prijevod;
}

function postojiPrijevod($id_stranice,$ln){
	$stranica = db_dohvatiPrijevod($id_stranice,$ln);
	return $stranica!==false;
}

function db_insertPrijevod($prijevod){
	$sql="
		INSERT INTO ".TBL."sadrzaj(id_stranice,ln,naslov,sadrzaj,url) 
		VALUES('".db::sqli($prijevod->id_stranice)."','".db::sqli($prijevod->ln)."','".db::sqli($prijevod->naslov)."','".db::sqli($prijevod->sadrzaj)."','".db::sqli($prijevod->url)."')";
	db::query($sql);
}

function db_updatePrijevod($prijevod){
	$sql="
		UPDATE ".TBL."sadrzaj 
		SET naslov='".db::sqli($prijevod->naslov)."', sadrzaj='".db::sqli($prijevod->sadrzaj)."', url='".db::sqli($prijevod->url)."' 
		WHERE id_stranice=".db::sqli($prijevod->id_stranice)." AND ln='".db::sqli($prijevod->ln)."'";
	db::query($sql);
}

