<?php
/** 
 * @access satisfy all
 * tu idu funkcije koje su dostupne samo na frontu
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