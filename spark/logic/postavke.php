<?php
if(isset($post->njezik))db_insertLang();
else execute();

function execute(){
	global $post;
	$langs = languages();
	foreach($langs as $lang){
		if($lang->ln=='hr')continue;
		$jezik = new object();
		$naslov_attrName = 'chk_'.$lang->ln;
		
		$jezik->ln=$lang->ln;
		$jezik->published = $post->$naslov_attrName=='1' ? 1:0;
		db_updateJezik($jezik);
	}
}
