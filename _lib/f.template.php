<?php
/* TEEMPLATE */
class TemplateParts {
	/* NOTE generic template parts */
	public $error = array();
}

function processTemplate($template){
	global $sitepath,$PART;
	$PART->error = prepareErrorHTML($PART->error);
	$filepath = $sitepath.'html/'.$template.'.html';
	if (!file_exists($filepath)) die("Can't load teplate file");
	$template = file_get_contents($filepath);
	foreach ((array)$PART as $attribute=>$html) {
		$placeholder = '{'.strtoupper($attribute).'}';
		$template = str_replace($placeholder,$html,$template);
	}
	echo $template;
	die();
}

function compress($buffer) {
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$buffer); /* remove comments */
	return str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),'',$buffer); /* remove tabs, extra spaces, newlines, etc. */
} 

function wrap($html,$tag,$class=false,$id=false){#ok
	if ($class) $classHTML=' class="'.$class.'"';
	if ($id) $idHTML=' id="'.$id.'"';
	return '<'.$tag.$classHTML.$idHTML.'>'.$html.'</'.$tag.'>';
}

/* Error logging */
function logError($msg){
	global $PART;
	$PART->error[] = empty($PART->error) ? ucfirst($msg) : $msg; 
}

function prepareErrorHTML($errors){
	if (empty($errors)) return false;
	return '<p class="error">'.implode(', ',$errors).'</p>';
}

/* VIEW HELPERS */
function view_setTitle($title){
	global $PART;
	$PART->title = $title.' :: '.ucfirst(D_PROJECT_NAME).' admin';
}

function view_setH2($string){
	global $PART;
	$PART->h2 = wrap($string,'h2');
}