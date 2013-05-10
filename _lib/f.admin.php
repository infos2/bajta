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
	global $get;
	$id=isset($get->id)? $get->id:1;
	$stranice = db_dohvatiStranice();
	foreach($stranice as $stranica){
		$selected= $id==$stranica->id ?'selected':false;
		$navCont.=wrap('<a href="'.navigationStranice_url($stranica->id).'">'.$stranica->naziv.'</a>','li',$selected);
	}
	return $navCont;
}

function nazivStranice($id_stranice){
	$stranica = db_dohvatiStranicu($id_stranice);
	return $stranica->naziv;
}


/* STRANICE */
function navigationStranice_url($id_stranice){
	return '?t=stranice&id='.$id_stranice;
}

function navigationOstalo(){
	$naviOstalo = '
        	<span><a href="{LIVE_SITE}" target="_blank"><img src="/images/admin/elementi/view.png" />View site</a></span>
			<span><a href="?logout=true"><img src="/images/admin/elementi/log_out.png" />Log out</a></span>';
	return wrap($naviOstalo,'li','menu-right');
}
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

function db_updatePrijevod($prijevod){
	$sql="UPDATE ".TBL."sadrzaj SET naslov='".db::sqli($prijevod->naslov)."', sadrzaj='".htmlspecialchars($prijevod->sadrzaj)."', url='".db::sqli(prepareURI($prijevod->url,$delimiter='-'))."' WHERE id_stranice=".db::sqli($prijevod->id_stranice)." AND ln='".db::sqli($prijevod->ln)."'";
	return db::query($sql);
}

function db_insertPrijevod($prijevod){
	$sql="INSERT INTO ".TBL."sadrzaj(naslov,ln,sadrzaj,url,id_stranice) VALUES('".db::sqli($prijevod->naslov)."','".db::sqli($prijevod->ln)."','".htmlspecialchars($prijevod->sadrzaj)."','".db::sqli(prepareURI($prijevod->url,$delimiter='-'))."',".db::sqli($prijevod->id_stranice).")";
	return db::query($sql);
}