<?php
$PART->content = HTML();

function HTML(){
	return '
	<form action="" method="post">
    <div id="tabs">
		'.createStranicaTabs().'
    </div>
        <p>
            <button class="btn btn-primary" type="submit" onclick="edited=0;">Spremi</button>
            <button class="btn" type="button">Odustani</button>
        </p>
	</form>';
}

function createStranicaTabs(){
	global $get;
	$id_stranice = isset($get->id) ? intval($get->id) : 1;
	$stranica = db_dohvatiStranicu($id_stranice);
	
	view_setTitle($stranica->naziv.' - Uredi stranicu');
	view_setH2($stranica->naziv);
	
	$langs = languages();
	foreach($langs as $lang){
		$prijevod = db_dohvatiPrijevod($stranica->id,$lang->ln);
		$tabsNavi.= wrap('<a href="#tabs-'.++$i.'">'.$lang->jezik.'</a>','li');
		$tabsCont.='
		<div id="tabs-'.$i.'">
            <p>
                <label for="editor'.$i.'">Naslov:</label>
                <input type="text" placeholder="Naslov" size="40" name="naslov_'.$lang->ln.'" value="'.$prijevod->naslov.'">
            </p>
            <p>
                <label for="editor'.$i.'">Sadržaj:</label>
                <textarea class="ckeditor" cols="80" id="editor'.$i.'" name="sadrzaj_'.$lang->ln.'" rows="10">'.$prijevod->sadrzaj.'</textarea>
            </p>
        </div>';
	}
	if (empty($tabsNavi)) return false;
	$tabsNaviUl = wrap($tabsNavi,'ul');
	return $tabsNaviUl.$tabsCont;	
}

/* HELPER */
