<?php
/***************************************************************************
 *                          admin_anti_bot_question_index.php
 *                          ---------------------------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *
 ***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['ABQ_MOD']['ABQ_MOD'] = $filename;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'includes/functions_abq.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq_admin.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq.' . $phpEx);

$template->set_filenames(array(
	'body' => 'admin/abq_index_body.tpl')
);

$template->assign_vars(array(
	'L_ABQ_ACP' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_Admin_Index'], 
	'L_ABQ_ACP_EXPLAIN' => $lang['ABQ_Admin_Index_Explain'], 
	'L_GENERAL' => $lang['ABQ_General'], 
	'L_AUTOQUESTS' => $lang['ABQ_Automatic_Questions'], 
	'L_INDIQUESTS' => $lang['ABQ_Individual_Questions'],

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
	'L_MENU_IIMAGES' => $lang['ABQ_AdminMenu_IndividualImages'], 
	'U_MENU_IIMAGES' => append_sid("abq_indi_images.$phpEx"), 
	'L_MENU_INDIIMAGEQUESTIONS' => sprintf($lang['ABQ_AdminMenu_IndividualQuestions'], 2), 
	'U_MENU_INDIIMAGEQUESTIONS' => append_sid("abq_indig_quests.$phpEx"), 
	'L_ABQ_VERSION' => $lang['ABQ_Version'])
);

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);
?>