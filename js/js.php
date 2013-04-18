<?php
/* REQUIRE */
require '../_lib/_config.php';

header('Content-type: text/javascript');
if(!ob_start("ob_gzhandler")) ob_start('compress');

// Expire yesterday
header("Expires: ".date('D, d M Y H:i:s',strtotime("-1 day"))." GMT");

/* Prepare */


/* CORE JS */
$js = file_get_contents($sitepath.'js/front.js');

echo $js;
ob_end_flush();

/* HELPER */

?>