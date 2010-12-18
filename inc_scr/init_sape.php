<?php 

	global $sape;
	if (!defined('_SAPE_USER')){
		define('_SAPE_USER', '83048c28fdc02310701638f3d2ca04f8'); 
	}                                                 

	require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'); 
                         
$o['force_show_code'] = true;
//$o = array();
$sape = new SAPE_client($o);
//echo $sape->return_links();
//	print_r($sape);
//echo "<!-- ddd -->"
?>