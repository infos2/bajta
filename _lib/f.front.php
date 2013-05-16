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
function setCopyright(){
	if (date('Y')>2013)return '2013 - '.date('Y');
	else return '2013';
}
function googleMapa(){
	return '
		<div class="divs">
			<p id="lokacija">Pula, Croatia</p>
        	<div class="karta" id="map-canvas">
            </div>
        </div>';
}

function languagesMenu(){
	$langs = languagesOptions();
	return wrap($langs,'ul',false,'langs');
}

function languagesOptions(){
	global $live_site;
	$langs = languages();
	foreach($langs as $ln){
		if ($ln->published==0) continue;
		$current = getLn()==$ln->ln ? 'current' : '';
		$langCont.= wrap('<a href="'.$live_site.$ln->ln.'/">'.$ln->ln.'</a>','li',$current);
	}
	return $langCont;
}

function navigation(){
	$navigation = navigationStranice();
	return wrap($navigation,'ul','menu','menu');
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

/* URL PARSING */
function parseURL($url){#ok
	if (strrpos($url,"/")==(strlen($url)-1)) $url = substr($url,0,-1);
	return explode("/",$url);
}

function configureUrl($urlArray){#ok
	global $get;
	$xurl = new object;
	if ($urlArray[0]!=NULL) $xurl->p1 = $urlArray[0];
	return $xurl;
}