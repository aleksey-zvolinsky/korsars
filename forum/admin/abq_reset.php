<?php
/***************************************************************************
 *                          abq_reset.php
 *                          -------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *
 ***************************************************************************/

define('IN_PHPBB', true);

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'includes/functions_abq.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq_admin.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq.' . $phpEx);

if (isset($HTTP_POST_VARS['valuereset']))
{
	$DatenPost = array();
	$ABQ_Error = '';

	if ((!isset($HTTP_POST_VARS['valueresetcheck'])) || ($HTTP_POST_VARS['valueresetcheck'] != 'OK'))
	{
		$ABQ_Error .= $lang['ABQ_Error_Valuereset_Not_Confirmed'] . '<br />';
	}

	$DatenPost[] = 'lib_gd';
	$DatenPost[] = 'lib_ft';
	$DatenPost[] = 'Color_BG_R1';
	$DatenPost[] = 'Color_BG_R2';
	$DatenPost[] = 'Color_BG_G1';
	$DatenPost[] = 'Color_BG_G2';
	$DatenPost[] = 'Color_BG_B1';
	$DatenPost[] = 'Color_BG_B2';
	$DatenPost[] = 'Color_Text_Question1_R';
	$DatenPost[] = 'Color_Text_Question1_G';
	$DatenPost[] = 'Color_Text_Question1_B';
	$DatenPost[] = 'Color_Text_Question2_R';
	$DatenPost[] = 'Color_Text_Question2_G';
	$DatenPost[] = 'Color_Text_Question2_B';
	$DatenPost[] = 'Color_Grid1_R1';
	$DatenPost[] = 'Color_Grid1_R2';
	$DatenPost[] = 'Color_Grid1_G1';
	$DatenPost[] = 'Color_Grid1_G2';
	$DatenPost[] = 'Color_Grid1_B1';
	$DatenPost[] = 'Color_Grid1_B2';
	$DatenPost[] = 'Color_Grid2_R1';
	$DatenPost[] = 'Color_Grid2_R2';
	$DatenPost[] = 'Color_Grid2_G1';
	$DatenPost[] = 'Color_Grid2_G2';
	$DatenPost[] = 'Color_Grid2_B1';
	$DatenPost[] = 'Color_Grid2_B2';
	$DatenPost[] = 'Color_Grid3_R1';
	$DatenPost[] = 'Color_Grid3_R2';
	$DatenPost[] = 'Color_Grid3_G1';
	$DatenPost[] = 'Color_Grid3_G2';
	$DatenPost[] = 'Color_Grid3_B1';
	$DatenPost[] = 'Color_Grid3_B2';
	$DatenPost[] = 'Color_Grid4_R1';
	$DatenPost[] = 'Color_Grid4_R2';
	$DatenPost[] = 'Color_Grid4_G1';
	$DatenPost[] = 'Color_Grid4_G2';
	$DatenPost[] = 'Color_Grid4_B1';
	$DatenPost[] = 'Color_Grid4_B2';
	$DatenPost[] = 'Color_FilledGrid_R1';
	$DatenPost[] = 'Color_FilledGrid_R2';
	$DatenPost[] = 'Color_FilledGrid_G1';
	$DatenPost[] = 'Color_FilledGrid_G2';
	$DatenPost[] = 'Color_FilledGrid_B1';
	$DatenPost[] = 'Color_FilledGrid_B2';
	$DatenPost[] = 'Color_Ellipses_R1';
	$DatenPost[] = 'Color_Ellipses_R2';
	$DatenPost[] = 'Color_Ellipses_G1';
	$DatenPost[] = 'Color_Ellipses_G2';
	$DatenPost[] = 'Color_Ellipses_B1';
	$DatenPost[] = 'Color_Ellipses_B2';
	$DatenPost[] = 'Color_PartialEllipses_R1';
	$DatenPost[] = 'Color_PartialEllipses_R2';
	$DatenPost[] = 'Color_PartialEllipses_G1';
	$DatenPost[] = 'Color_PartialEllipses_G2';
	$DatenPost[] = 'Color_PartialEllipses_B1';
	$DatenPost[] = 'Color_PartialEllipses_B2';
	$DatenPost[] = 'Color_Lines_R1';
	$DatenPost[] = 'Color_Lines_R2';
	$DatenPost[] = 'Color_Lines_G1';
	$DatenPost[] = 'Color_Lines_G2';
	$DatenPost[] = 'Color_Lines_B1';
	$DatenPost[] = 'Color_Lines_B2';
	$DatenPost[] = 'Color_Arcs_R1';
	$DatenPost[] = 'Color_Arcs_R2';
	$DatenPost[] = 'Color_Arcs_G1';
	$DatenPost[] = 'Color_Arcs_G2';
	$DatenPost[] = 'Color_Arcs_B1';
	$DatenPost[] = 'Color_Arcs_B2';
	$DatenPost[] = 'Color_BGText_R1';
	$DatenPost[] = 'Color_BGText_R2';
	$DatenPost[] = 'Color_BGText_G1';
	$DatenPost[] = 'Color_BGText_G2';
	$DatenPost[] = 'Color_BGText_B1';
	$DatenPost[] = 'Color_BGText_B2';
	$DatenPost[] = 'Color_Text_R1';
	$DatenPost[] = 'Color_Text_R2';
	$DatenPost[] = 'Color_Text_G1';
	$DatenPost[] = 'Color_Text_G2';
	$DatenPost[] = 'Color_Text_B1';
	$DatenPost[] = 'Color_Text_B2';
	$DatenPost[] = 'Color_SeparatingLines_R1';
	$DatenPost[] = 'Color_SeparatingLines_R2';
	$DatenPost[] = 'Color_SeparatingLines_G1';
	$DatenPost[] = 'Color_SeparatingLines_G2';
	$DatenPost[] = 'Color_SeparatingLines_B1';
	$DatenPost[] = 'Color_SeparatingLines_B2';

	$new_lib_gd = 3;
	$new_lib_ft = 2;
	$new_Color_BG_R1 = 210;
	$new_Color_BG_R2 = 230;
	$new_Color_BG_G1 = 210;
	$new_Color_BG_G2 = 230;
	$new_Color_BG_B1 = 210;
	$new_Color_BG_B2 = 230;
	$new_Color_Text_Question1_R = 255;
	$new_Color_Text_Question1_G = 50;
	$new_Color_Text_Question1_B = 50;
	$new_Color_Text_Question2_R = 0;
	$new_Color_Text_Question2_G = 255;
	$new_Color_Text_Question2_B = 0;
	$new_Color_Grid1_R1 = 225;
	$new_Color_Grid1_R2 = 255;
	$new_Color_Grid1_G1 = 90;
	$new_Color_Grid1_G2 = 110;
	$new_Color_Grid1_B1 = 90;
	$new_Color_Grid1_B2 = 110;
	$new_Color_Grid2_R1 = 90;
	$new_Color_Grid2_R2 = 110;
	$new_Color_Grid2_G1 = 225;
	$new_Color_Grid2_G2 = 255;
	$new_Color_Grid2_B1 = 90;
	$new_Color_Grid2_B2 = 110;
	$new_Color_Grid3_R1 = 90;
	$new_Color_Grid3_R2 = 110;
	$new_Color_Grid3_G1 = 90;
	$new_Color_Grid3_G2 = 110;
	$new_Color_Grid3_B1 = 225;
	$new_Color_Grid3_B2 = 255;
	$new_Color_Grid4_R1 = 130;
	$new_Color_Grid4_R2 = 170;
	$new_Color_Grid4_G1 = 130;
	$new_Color_Grid4_G2 = 170;
	$new_Color_Grid4_B1 = 130;
	$new_Color_Grid4_B2 = 170;
	$new_Color_FilledGrid_R1 = 200;
	$new_Color_FilledGrid_R2 = 255;
	$new_Color_FilledGrid_G1 = 200;
	$new_Color_FilledGrid_G2 = 255;
	$new_Color_FilledGrid_B1 = 200;
	$new_Color_FilledGrid_B2 = 255;
	$new_Color_Ellipses_R1 = 120;
	$new_Color_Ellipses_R2 = 255;
	$new_Color_Ellipses_G1 = 120;
	$new_Color_Ellipses_G2 = 255;
	$new_Color_Ellipses_B1 = 120;
	$new_Color_Ellipses_B2 = 255;
	$new_Color_PartialEllipses_R1 = 120;
	$new_Color_PartialEllipses_R2 = 255;
	$new_Color_PartialEllipses_G1 = 120;
	$new_Color_PartialEllipses_G2 = 255;
	$new_Color_PartialEllipses_B1 = 120;
	$new_Color_PartialEllipses_B2 = 255;
	$new_Color_Lines_R1 = 120;
	$new_Color_Lines_R2 = 255;
	$new_Color_Lines_G1 = 120;
	$new_Color_Lines_G2 = 255;
	$new_Color_Lines_B1 = 120;
	$new_Color_Lines_B2 = 255;
	$new_Color_Arcs_R1 = 120;
	$new_Color_Arcs_R2 = 255;
	$new_Color_Arcs_G1 = 120;
	$new_Color_Arcs_G2 = 255;
	$new_Color_Arcs_B1 = 120;
	$new_Color_Arcs_B2 = 255;
	$new_Color_BGText_R1 = 180;
	$new_Color_BGText_R2 = 220;
	$new_Color_BGText_G1 = 180;
	$new_Color_BGText_G2 = 220;
	$new_Color_BGText_B1 = 180;
	$new_Color_BGText_B2 = 220;
	$new_Color_Text_R1 = 0;
	$new_Color_Text_R2 = 100;
	$new_Color_Text_G1 = 0;
	$new_Color_Text_G2 = 100;
	$new_Color_Text_B1 = 0;
	$new_Color_Text_B2 = 255;
	$new_Color_SeparatingLines_R1 = 0;
	$new_Color_SeparatingLines_R2 = 50;
	$new_Color_SeparatingLines_G1 = 0;
	$new_Color_SeparatingLines_G2 = 50;
	$new_Color_SeparatingLines_B1 = 0;
	$new_Color_SeparatingLines_B2 = 50;

	if (trim($ABQ_Error) != '')
	{
		message_die(GENERAL_ERROR, $lang['ABQ_Error_not_updated'] . '<br /><br />' . $ABQ_Error);
	}

	unset($i);
	unset($j);
	$j = count($DatenPost);
	for ($i=0; $i<$j; $i++)
	{
		$sql = 'UPDATE ' . ANTI_BOT_QUEST_CONFIG_TABLE . ' SET 
			config_value = \'' . str_replace("\'", "''", ${'new_'.$DatenPost[$i]}) . '\' 
			WHERE config_name = \'' . $DatenPost[$i] . '\'';
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Failed to update anti bot question mod configuration for $config_name", "", __LINE__, __FILE__, $sql);
		}
	}

	$message = $lang['ABQ_Reset_reseted_values'] . "<br /><br />" . sprintf($lang['ABQ_Click_return_reset'], "<a href=\"" . append_sid("abq_reset.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}
elseif (isset($HTTP_POST_VARS['multiimagereset']))
{
	$DatenPost = array();
	$ABQ_Error = '';

	if ((!isset($HTTP_POST_VARS['multiimageresetcheck'])) || ($HTTP_POST_VARS['multiimageresetcheck'] != 'OK'))
	{
		$ABQ_Error .= $lang['ABQ_Error_Deletion_Not_Confirmed'] . '<br />';
		message_die(GENERAL_ERROR, $lang['ABQ_Error_not_updated'] . '<br /><br />' . $ABQ_Error);
	}

	unset($CacheFiles);
	$CacheFiles = array();
	if ($CacheFolder = @opendir($phpbb_root_path.'images/abq_mod/cache/'))
	{
		while (true == ($Dateien = @readdir($CacheFolder)))
		{
			if ((substr(strtolower($Dateien), -4) == '.jpg') || (substr(strtolower($Dateien), -4) == '.png'))
			{
				$CacheFiles[] = $Dateien;
			}
		}
		closedir($CacheFolder);
	}
	$CacheFilesAmount = count($CacheFiles);
	if ($CacheFilesAmount > 0)
	{
		unset($i);
		unset($j);
		$Error_Del = 0;
		for ($i=0; $i<$CacheFilesAmount; $i++)
		{
			if (! @unlink($phpbb_root_path . 'images/abq_mod/cache/' . $CacheFiles[$i]))
			{
				$Error_Del = 1;
			}
		}
		if ($Error_Del == 1)
		{
			$ABQ_Error .= $lang['ABQ_Error_Multiimages_not_deleted'] . '<br />';
			message_die(GENERAL_ERROR, $lang['ABQ_Error_not_updated'] . '<br /><br />' . $ABQ_Error);
		}
	}

	$message = $lang['ABQ_Reset_reseted_multiimages'] . "<br /><br />" . sprintf($lang['ABQ_Click_return_reset'], "<a href=\"" . append_sid("abq_reset.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}

unset($CacheFilesAmount);
$CacheFilesAmount = 0;
$CacheFilesSize = 0;
if ($CacheFolder = @opendir($phpbb_root_path.'images/abq_mod/cache/'))
{
	while (true == ($Dateien = @readdir($CacheFolder)))
	{
		if ((substr(strtolower($Dateien), -4) == '.jpg') || (substr(strtolower($Dateien), -4) == '.png'))
		{
			$CacheFilesAmount++;
			$CacheFilesSize += filesize($phpbb_root_path.'images/abq_mod/cache/'.$Dateien);
		}
	}
	closedir($CacheFolder);
}

if ($CacheFilesSize > 1000)
{
	if ($CacheFilesSize > 1000000000)
	{
		$CacheFilesSize = ereg_replace('\.',',',sprintf('%.1f', (ceil($CacheFilesSize / 100000000) / 10)));
		$CacheFilesSize .= ' GB';
	}
	elseif ($CacheFilesSize > 1000000)
	{
		$CacheFilesSize = ereg_replace('\.',',',sprintf('%.1f', (ceil($CacheFilesSize / 100000) / 10)));
		$CacheFilesSize .= ' MB';
	}
	else
	{
		$CacheFilesSize = ereg_replace('\.',',',sprintf('%.1f', (ceil($CacheFilesSize / 100) / 10)));
		$CacheFilesSize .= ' kB';
	}
}
else
{
	$CacheFilesSize .= ' B';
}

$MultiimageReset_Explain = $lang['ABQ_MultiimageReset_Explain'] . '<br />' . (($CacheFilesAmount > 0) ? sprintf($lang['ABQ_MultiimageReset_Explain2'], $CacheFilesAmount, $CacheFilesSize) : $lang['ABQ_MultiimageReset_Explain3']);
$MultiimageReset_Check = (($CacheFilesAmount > 0) ? '' : ' disabled="DISABLED"');
$MultiimageReset_Button = (($CacheFilesAmount > 0) ? '' : ' disabled="DISABLED"');

$template->set_filenames(array(
	'body' => 'admin/abq_reset_body.tpl')
);

$template->assign_vars(array(
	'U_RESET_ACTION' => append_sid("abq_reset.$phpEx"), 
	'L_RESET_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_Reset_Titel'], 

	'L_VALUERESET' => $lang['ABQ_ValueReset'], 
	'L_VALUERESET_EXPLAIN' => $lang['ABQ_ValueReset_Explain'], 

	'L_MULTIIMAGERESET' => $lang['ABQ_MultiimageReset'], 
	'L_MULTIIMAGERESET_EXPLAIN' => $MultiimageReset_Explain, 
	'S_MULTIIMAGERESET' => $MultiimageReset_Check,
	'S_MULTIIMAGERESET_BUTTON' => $MultiimageReset_Button,

	'L_MENU_CONFIG' => $lang['ABQ_AdminMenu_Config'], 
	'U_MENU_CONFIG' => append_sid("abq_config.$phpEx"), 
	'L_MENU_AUTOQUESTIONS' => $lang['ABQ_AdminMenu_AutomaticQuestions'], 
	'U_MENU_AUTOQUESTIONS' => append_sid("abq_auto_quests.$phpEx"), 
	'L_MENU_FONTS' => $lang['ABQ_AdminMenu_Fonts'], 
	'U_MENU_FONTS' => append_sid("abq_fonts.$phpEx"), 
	'L_MENU_CONFIG2' => $lang['ABQ_AdminMenu_Config2'], 
	'U_MENU_CONFIG2' => append_sid("abq_config2.$phpEx"), 
	'L_MENU_RESET' => $lang['ABQ_AdminMenu_Reset'], 
	'U_MENU_RESET' => append_sid("abq_reset.$phpEx"), 
	'L_MENU_INDIQUESTIONS' => sprintf($lang['ABQ_AdminMenu_IndividualQuestions'], 1), 
	'U_MENU_INDIQUESTIONS' => append_sid("abq_indi_quests.$phpEx"), 
	'L_MENU_INDIIMAGEQUESTIONS' => sprintf($lang['ABQ_AdminMenu_IndividualQuestions'], 2), 
	'U_MENU_INDIIMAGEQUESTIONS' => append_sid("abq_indig_quests.$phpEx"), 
	'L_MENU_IIMAGES' => $lang['ABQ_AdminMenu_IndividualImages'], 
	'U_MENU_IIMAGES' => append_sid("abq_indi_images.$phpEx"), 
	'L_ABQ_VERSION' => $lang['ABQ_Version'])
);

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);
?>