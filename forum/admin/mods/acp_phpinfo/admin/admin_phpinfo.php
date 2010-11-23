<?php
/***************************************************************************
 *                            mod_phpinfo.php
 *                            -------------------
 *   begin                  : Tuesday, Jan 04, 2005
 *   copyright              : (C) 2005 John B. Abela
 *   support                : http://www.johnabela.com/mods/
 *
 ***************************************************************************
 *
 *  THIS IS A THIRD-PARTY "MOD" CREATED BY:
 *
 *     John B. Abela (aka: AbelaJohnB)
 *     http://www.johnabela.com/mods/
 *
 ***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
//
define('IN_PHPBB', 1);
//
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['PHP Server Settings'] = append_sid($filename);

	return;
}
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
//
$template->set_filenames(array(
	"body" => "admin/admin_phpinfo.tpl")
);
//
ob_start();
phpinfo();
$phpinfo .= ob_get_contents();
ob_end_clean();
//
// IF YOU DON'T KNOW... DON'T TOUCH!
//
$phpinfo = substr( $phpinfo, 1313 );
$phpinfo = str_replace("' '", " \<br>", $phpinfo);
$phpinfo = str_replace("'", "", $phpinfo);
$phpinfo = str_replace(' width="600"', ' width="80%"', $phpinfo);
$phpinfo = str_replace('class="e"', 'valign="top" class="nav"', $phpinfo);
$phpinfo = str_replace('class="h"', 'class="gen"', $phpinfo);
$phpinfo = str_replace('class="v"', 'class="gen"', $phpinfo);
//
$template->assign_vars(array(
    "TITLE" => 'PHP Server Settings - phpinfo()',
    "PHPINFO" => $phpinfo,
    "MOD_AUTHOR" => '&nbsp;&nbsp;MOD By: <a href="http://www.johnabela.com/mods/" target="_Blank">John B. Abela</A>.&nbsp;&nbsp;&nbsp;&nbsp;For the latest version and support please visit <a href="http://www.johnabela.com/mods/" target="_Blank">www.johnabela.com</A>.')
);
//
$template->pparse("body");
//
include('./page_footer_admin.'.$phpEx);
//
?>