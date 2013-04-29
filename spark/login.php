<?php
if(!ob_start("ob_gzhandler")) ob_start('compress');
$PART = new TemplateParts();

$PART->title = ucfirst(D_PROJECT_NAME).' :: Login';
$PART->project_name = ucfirst(D_PROJECT_NAME);

if (!empty($post->email) and !empty($post->pass)) {
	if (userLogin($post->email,$post->pass)) refresh();
	else logError('prijava neuspjela'); // this is also template part
}

$PART->live_site = $live_site;
processTemplate('login');
ob_end_flush();