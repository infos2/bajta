<?php
$PART->content = HTML();

function HTML(){
	$stranica = db_dohvatiStranicu();
	$langs=db_getLanguages();
	foreach($langs as $lang){
		$stranicaLn = db_dohvatiPrijevod($stranica->id,$lang->ln);
		$tabsNavi.=wrap('<a href="#tabs-'.++$i.'">'.$lang->jezik.'</a>','li');
		$tabsCont.='
		<div id="tabs-'.$i.'">
            <p>
                <label for="editor'.$i.'">
                Naslov:
                </label>
                <input type="text" placeholder="Naslov" size="40" name="naslov_'.$lang->ln.'" value="'.$stranicaLn->naslov.'">
            </p>
            <p>
                <label for="editor'.$i.'">
                Editor:
                </label>
                <textarea class="ckeditor" cols="80" id="editor'.$i.'" name="sadrzaj_'.$lang->ln.'" rows="10">'.$stranicaLn->sadrzaj.'</textarea>
            </p>
        </div>';
	}
	$tabsNavi=wrap($tabsNavi,'ul');
	return '
	<form action="" method="post">
    <div id="tabs">
		'.$tabsNavi.'
		'.$tabsCont.'
    </div>            
        <p>
            <button class="btn btn-primary" type="submit">Spremi</button>
            <button class="btn" type="button">Odustani</button>
        </p>
	</form>';
}