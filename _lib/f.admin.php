<?php
#NOTE tu idu CRUD funkcije za bazu koje ne smiju biti dostupne nigdje drugdje nego u adminu

function navigation(){
	// $stranice dohvatiti iz TBL stranice i onda foreach napraviti navigaciju ?t=stranice&id=*id_stranice*
	$stranice=db_dohvatiStranice();
	foreach($stranice as $stranica){
		$navCont.=wrap('<a href="?t=stranice&id='.$stranica->id.'">'.$stranica->naziv.'</a>','li');
	}
	$navCont.=wrap('<div class="menu-right" style="padding:4px 10px;">
            <span style="float:right;padding:5px 10px;">
                <a href="{LIVE_SITE}" style="margin-right:10px;" target="_blank"><img src="/images/admin/elementi/view.png" />View site</a>
                <a href="?logout=1"><img src="/images/admin/elementi/log_out.png" />Log out</a>
            </span>
        </div>', 'li');
	return wrap($navCont,'ul','menu');
}

/* STRANICE */
function db_dohvatiStranice(){
	$sql="SELECT * FROM ".TBL."stranice";
	$stranice=db::query_to_objects($sql);
	return $stranice;
}
function db_dohvatiStranicu(){
	global $get;
	// TMP
	$stranica = new object();
	$stranica->id = intval($get->id);
	return $stranica;
	// OTHERWISE
	$sql="SELECT * FROM ".TBL."stranice WHERE id=".db::sqli($get->id);
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

