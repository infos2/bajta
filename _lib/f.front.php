<?php
function stranice_HTML(){
	global $get;
	$ln=isset($get->ln)?$get->ln:'hr';
	$stranice = db_dohvatiStranice();
	foreach($stranice as $str){
		if ($str->id_stranice==4) $str->sadrzaj.= googleMapa();
		$html.=wrap('<h2>'.$str->naslov.'</h2>'.htmlspecialchars_decode($str->sadrzaj),'div','page','page'.(++$i));
	}
	return $html;
}

function googleMapa(){
	return '
		<div>
			<p id="lokacija">Pula, Croatia</p>
        	<div class="karta">
        		<!-- TODO Napravit ćemo kartu kao div ne kao iframe -->
            </div>
        </div>';
}

function languagesMenu(){
	$langs = languagesOptions();
	return wrap($langs,'ul',false,'langs');
}

function languagesOptions(){
	$langs = languages();
	foreach($langs as $ln){
		$current = getLn()==$ln->ln ? 'current' : '';
		$langCont.=wrap('<a href="?lang='.$ln->ln.'">'.$ln->ln.'</a>','li',$current);
	}
	return $langCont;
}

function navigation(){
	$navigation = navigationStranice();
	return wrap($navigation,'ul','menu');
}

function navigationStranice(){
	$stranice = db_dohvatiStranice();
	foreach($stranice as $stranica){
		$navCont.=wrap($stranica->naslov,'li');
	}
	return $navCont;
}

function db_dohvatiStranice(){
	$sql="SELECT DISTINCT id_stranice,naslov,sadrzaj  FROM ".TBL."sadrzaj WHERE ln='".db::sqli(getLn())."' ORDER BY id_stranice ASC";
	$stranice = db::query_to_objects($sql);
	return $stranice;
}
