<?php
execute();

function execute(){
	global $get,$post;
	$langs = languages();
	foreach($langs as $lang){
		$prijevod = new object();
		$prijevod->id_stranice = intval($get->id);
		$prijevod->ln = $lang->ln;
		$naslov_attrName = 'naslov_'.$prijevod->ln;
		$prijevod->naslov = $post->$naslov_attrName;
		$prijevod->url = prepareURI($prijevod->naslov);
		if (empty($prijevod->naslov)) continue; // možda izbrisati prijevod ?
		$sadrzaj_attrName = 'sadrzaj_'.$prijevod->ln;
		$prijevod->sadrzaj = $post->$sadrzaj_attrName;
		postojiPrijevod($prijevod->id_stranice,$prijevod->ln) ? db_updatePrijevod($prijevod) : db_insertPrijevod($prijevod);
	}
	refresh();
}

