<?php
/* TEEMPLATE */
class TemplateParts {
	/* NOTE generic template parts */
	public $error = array();
}

function processTemplate($template){
	global $sitepath,$PART;
	$PART->error = prepareErrorHTML($PART->error);
	$template = file_get_contents($sitepath.'html/'.$template.'.html');
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

/* VIEW */
function view_userName(){
	#TODO Hello, name HTML chunk
}

/* VIEW HELPERS */
