<?php
$PART->content = HTML();

function HTML(){
	return '
	<form action="" method="post">
		<input type="text" placeholder="Novi jezik" name="jezik" class="njezik">
		<input type="submit" value="Dodaj jezik" name="njezik" class="btn btn-primary">
	</form>
	<form action="" method="post">
	<div>
	<p id="heading-jezici"><span class="jezici">Jezik</span>Published</>
	'.getLanguages().'
	</div>
	<p>
	<button class="btn btn-primary" type="submit" onclick="edited=0;">Spremi</button>
	<button class="btn" type="button">Odustani</button>
	</p>
	</form>';
}

function getLanguages(){
	view_setTitle('Uređivanje postavki stranica');
	view_setH2('Postavke');
	
	$langs = languages();
	foreach($langs as $lang){
		$span=wrap($lang->jezik,'span','jezici');
		
		$disabled=$lang->ln=='hr' ? 'disabled=disabled':false;
		$checked=$lang->published==true ? 'checked':false;
		
		$chk='<input type="checkbox" value="1" name="chk_'.$lang->ln.'" '.$disabled.' '.$checked.'>';
		$html.=wrap($span.$chk,'p');
	}
	return $html;
}
