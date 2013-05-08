<?php
function stranice_HTML(){
	
}
function navigation(){
	$navigation = navigationStranice();
	return wrap($navigation,'ul','menu');
}

function navigationStranice(){
	global $get;
	$stranice = db_dohvatiStranice();
	foreach($stranice as $stranica){
		$navCont.=wrap($stranica->naziv,'li');
	}
	return $navCont;
}
