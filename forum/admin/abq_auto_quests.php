<?php
/***************************************************************************
 *                          abq_auto_quests.php
 *                          -------------------
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

$ABQ_PHP_Version = array();
$ABQ_FTLib_Version = 0;
$ABQ_GDLib_Version = 0;
ABQ_gdVersion();

if( isset($HTTP_POST_VARS['submit']) )
{
	$ABQ_Error = '';

	unset($i);
	for ($i=1; $i<35; $i++)
	{
		unset($j);
		$j = $i;
		if ($i < 10)
		{
			$j = '0' . $j;
		}
		if (($ABQ_GDLib_Version < 1) && (($i == 1) || ($i == 2) || ($i == 3) || ($i == 4) || ($i == 9) || ($i == 10) || ($i == 11) || ($i == 12) || ($i == 17) || ($i == 18) || ($i == 19) || ($i == 20) || ($i == 25) || ($i == 26) || ($i == 27) || ($i == 31) || ($i == 32) || ($i == 34)))
		{
			${'new_AutoQuestion_'.$j} = '0';
		}
		elseif (($HTTP_POST_VARS['AutoQuestion_'.$j] == '1') || ($HTTP_POST_VARS['AutoQuestion_'.$j] == '0'))
		{
			${'new_AutoQuestion_'.$j} = $HTTP_POST_VARS['AutoQuestion_'.$j];
		}
		else
		{
			${'new_AutoQuestion_'.$j} = '0';
		}

		$sql = 'UPDATE ' . ANTI_BOT_QUEST_CONFIG_TABLE . ' SET 
			config_value = \'' . ${'new_AutoQuestion_'.$j} . '\' 
			WHERE config_name = \'AutoQuestion_' . $j . '\'';
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Failed to update anti bot question mod configuration for $config_name", "", __LINE__, __FILE__, $sql);
		}
	}

	$message = $lang['ABQ_Config_updated'] . "<br /><br />" . sprintf($lang['ABQ_Click_return_config'], "<a href=\"" . append_sid("abq_auto_quests.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}

$sql = 'SELECT * 
	FROM ' . ANTI_BOT_QUEST_CONFIG_TABLE . '
	WHERE config_name LIKE \'AutoQuestion_%\'';
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in abq_auto_quests", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = $config_value;
		
		$new[$config_name] = $default_config[$config_name];
	}
}

unset($i);
for ($i=1; $i<35; $i++)
{
	$j = $i;
	if ($i < 10)
	{
		$j = '0' . $i;
	}
	if (($ABQ_GDLib_Version < 1) && (($i == 1) || ($i == 2) || ($i == 3) || ($i == 4) || ($i == 9) || ($i == 10) || ($i == 11) || ($i == 12) || ($i == 17) || ($i == 18) || ($i == 19) || ($i == 20) || ($i == 25) || ($i == 26) || ($i == 27) || ($i == 31) || ($i == 32) || ($i == 34)))
	{
		${'abq_AutoQuestion_'.$j.'_yes'} = '';
		${'abq_AutoQuestion_'.$j.'_no'} = 'checked="checked"';
	}
	else
	{
		${'abq_AutoQuestion_'.$j.'_yes'} = ($new['AutoQuestion_'.$j]) ? 'checked="checked"' : '';
		${'abq_AutoQuestion_'.$j.'_no'} = (!$new['AutoQuestion_'.$j]) ? 'checked="checked"' : '';
	}
}

$template->set_filenames(array(
	'body' => 'admin/abq_auto_quests_body.tpl')
);

if ($ABQ_GDLib_Version < 1)
{
	$template->assign_block_vars('switch_readonly1', array());
}

$template->assign_vars(array(
	'U_CONFIG_ACTION' => append_sid("abq_auto_quests.$phpEx"), 
	'L_YES' => $lang['Yes'], 
	'L_NO' => $lang['No'], 
	'L_SUBMIT' => $lang['Submit'], 
	'L_RESET' => $lang['Reset'], 
	'L_READONLY1' => (($ABQ_GDLib_Version < 1) ? ' *' : ''), 
	'L_READONLY1_EXPLAIN' => '* - ' . $lang['ABQ_ReadOnly1_Explain'], 
	'L_AUTO_QUESTS_CONFIGURATION_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_AutoQuestAdmin'], 
	'L_AUTO_QUESTS_CONFIGURATION_EXPLAIN' => sprintf($lang['ABQ_AutoQuestAdmin_Explain'], (($ABQ_GDLib_Version > 0) ? $lang['ABQ_installed'] : '<b>' . $lang['ABQ_not_installed'] . '</b>')), 
	'L_AUTO_QUESTS_TEXTQUESTIONS_TITLE' => $lang['ABQ_TextQuests'], 
	'L_AUTO_QUESTS_IMAGEQUESTIONS_TITLE' => $lang['ABQ_ImageQuests'], 
	'L_TYPE1' => $lang['ABQ_Type'] . ' 1', 
	'L_TYPE2' => $lang['ABQ_Type'] . ' 2', 
	'L_TYPE3' => $lang['ABQ_Type'] . ' 3', 
	'L_TYPE4' => $lang['ABQ_Type'] . ' 4', 
	'L_TYPE5' => $lang['ABQ_Type'] . ' 5', 
	'L_TYPE6' => $lang['ABQ_Type'] . ' 6', 
	'L_AUTOQUEST01' => sprintf($lang['ABQ_Question_4Lines'], sprintf($lang['ABQ_Form_AutoQuestType01'], 'x')), 
	'L_AUTOQUEST01_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/101' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST01_ENABLE' => $abq_AutoQuestion_01_yes, 
	'S_AUTOQUEST01_DISABLE' => $abq_AutoQuestion_01_no, 
	'L_AUTOQUEST02' => sprintf($lang['ABQ_Question_3Lines'], sprintf($lang['ABQ_Form_AutoQuestType01'], 'x')), 
	'L_AUTOQUEST02_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/102' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST02_ENABLE' => $abq_AutoQuestion_02_yes, 
	'S_AUTOQUEST02_DISABLE' => $abq_AutoQuestion_02_no, 
	'L_AUTOQUEST03' => sprintf($lang['ABQ_Question_2Lines'], sprintf($lang['ABQ_Form_AutoQuestType01'], 'x')), 
	'L_AUTOQUEST03_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/103' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST03_ENABLE' => $abq_AutoQuestion_03_yes, 
	'S_AUTOQUEST03_DISABLE' => $abq_AutoQuestion_03_no, 
	'L_AUTOQUEST04' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType02']), 
	'L_AUTOQUEST04_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/104' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST04_ENABLE' => $abq_AutoQuestion_04_yes, 
	'S_AUTOQUEST04_DISABLE' => $abq_AutoQuestion_04_no, 
	'L_AUTOQUEST05' => sprintf($lang['ABQ_Question_4Lines'], sprintf($lang['ABQ_Form_AutoQuestType01'], 'x')), 
	'L_AUTOQUEST05_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/105.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST05_ENABLE' => $abq_AutoQuestion_05_yes, 
	'S_AUTOQUEST05_DISABLE' => $abq_AutoQuestion_05_no, 
	'L_AUTOQUEST06' => sprintf($lang['ABQ_Question_3Lines'], sprintf($lang['ABQ_Form_AutoQuestType01'], 'x')), 
	'L_AUTOQUEST06_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/106.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST06_ENABLE' => $abq_AutoQuestion_06_yes, 
	'S_AUTOQUEST06_DISABLE' => $abq_AutoQuestion_06_no, 
	'L_AUTOQUEST07' => sprintf($lang['ABQ_Question_2Lines'], sprintf($lang['ABQ_Form_AutoQuestType01'], 'x')), 
	'L_AUTOQUEST07_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/107.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST07_ENABLE' => $abq_AutoQuestion_07_yes, 
	'S_AUTOQUEST07_DISABLE' => $abq_AutoQuestion_07_no, 
	'L_AUTOQUEST08' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType02']), 
	'L_AUTOQUEST08_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/108.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST08_ENABLE' => $abq_AutoQuestion_08_yes, 
	'S_AUTOQUEST08_DISABLE' => $abq_AutoQuestion_08_no, 
	'L_AUTOQUEST09' => sprintf($lang['ABQ_Question_4Lines'], sprintf($lang['ABQ_Form_AutoQuestType03'], 'x')), 
	'L_AUTOQUEST09_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/109' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST09_ENABLE' => $abq_AutoQuestion_09_yes, 
	'S_AUTOQUEST09_DISABLE' => $abq_AutoQuestion_09_no, 
	'L_AUTOQUEST10' => sprintf($lang['ABQ_Question_3Lines'], sprintf($lang['ABQ_Form_AutoQuestType03'], 'x')), 
	'L_AUTOQUEST10_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/110' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST10_ENABLE' => $abq_AutoQuestion_10_yes, 
	'S_AUTOQUEST10_DISABLE' => $abq_AutoQuestion_10_no, 
	'L_AUTOQUEST11' => sprintf($lang['ABQ_Question_2Lines'], sprintf($lang['ABQ_Form_AutoQuestType03'], 'x')), 
	'L_AUTOQUEST11_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/111' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST11_ENABLE' => $abq_AutoQuestion_11_yes, 
	'S_AUTOQUEST11_DISABLE' => $abq_AutoQuestion_11_no, 
	'L_AUTOQUEST12' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType04']), 
	'L_AUTOQUEST12_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/112' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST12_ENABLE' => $abq_AutoQuestion_12_yes, 
	'S_AUTOQUEST12_DISABLE' => $abq_AutoQuestion_12_no, 
	'L_AUTOQUEST13' => sprintf($lang['ABQ_Question_4Lines'], sprintf($lang['ABQ_Form_AutoQuestType03'], 'x')), 
	'L_AUTOQUEST13_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/113.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST13_ENABLE' => $abq_AutoQuestion_13_yes, 
	'S_AUTOQUEST13_DISABLE' => $abq_AutoQuestion_13_no, 
	'L_AUTOQUEST14' => sprintf($lang['ABQ_Question_3Lines'], sprintf($lang['ABQ_Form_AutoQuestType03'], 'x')), 
	'L_AUTOQUEST14_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/114.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST14_ENABLE' => $abq_AutoQuestion_14_yes, 
	'S_AUTOQUEST14_DISABLE' => $abq_AutoQuestion_14_no, 
	'L_AUTOQUEST15' => sprintf($lang['ABQ_Question_2Lines'], sprintf($lang['ABQ_Form_AutoQuestType03'], 'x')), 
	'L_AUTOQUEST15_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/115.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST15_ENABLE' => $abq_AutoQuestion_15_yes, 
	'S_AUTOQUEST15_DISABLE' => $abq_AutoQuestion_15_no, 
	'L_AUTOQUEST16' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType04']), 
	'L_AUTOQUEST16_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/116.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST16_ENABLE' => $abq_AutoQuestion_16_yes, 
	'S_AUTOQUEST16_DISABLE' => $abq_AutoQuestion_16_no, 
	'L_AUTOQUEST17' => sprintf($lang['ABQ_Question_4Lines'], sprintf($lang['ABQ_Form_AutoQuestType05'], 'x')), 
	'L_AUTOQUEST17_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/117' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST17_ENABLE' => $abq_AutoQuestion_17_yes, 
	'S_AUTOQUEST17_DISABLE' => $abq_AutoQuestion_17_no, 
	'L_AUTOQUEST18' => sprintf($lang['ABQ_Question_3Lines'], sprintf($lang['ABQ_Form_AutoQuestType05'], 'x')), 
	'L_AUTOQUEST18_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/118' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST18_ENABLE' => $abq_AutoQuestion_18_yes, 
	'S_AUTOQUEST18_DISABLE' => $abq_AutoQuestion_18_no, 
	'L_AUTOQUEST19' => sprintf($lang['ABQ_Question_2Lines'], sprintf($lang['ABQ_Form_AutoQuestType05'], 'x')), 
	'L_AUTOQUEST19_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/119' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST19_ENABLE' => $abq_AutoQuestion_19_yes, 
	'S_AUTOQUEST19_DISABLE' => $abq_AutoQuestion_19_no, 
	'L_AUTOQUEST20' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType06']), 
	'L_AUTOQUEST20_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/120' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST20_ENABLE' => $abq_AutoQuestion_20_yes, 
	'S_AUTOQUEST20_DISABLE' => $abq_AutoQuestion_20_no, 
	'L_AUTOQUEST21' => sprintf($lang['ABQ_Question_4Lines'], sprintf($lang['ABQ_Form_AutoQuestType05'], 'x')), 
	'L_AUTOQUEST21_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/121.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST21_ENABLE' => $abq_AutoQuestion_21_yes, 
	'S_AUTOQUEST21_DISABLE' => $abq_AutoQuestion_21_no, 
	'L_AUTOQUEST22' => sprintf($lang['ABQ_Question_3Lines'], sprintf($lang['ABQ_Form_AutoQuestType05'], 'x')), 
	'L_AUTOQUEST22_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/122.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST22_ENABLE' => $abq_AutoQuestion_22_yes, 
	'S_AUTOQUEST22_DISABLE' => $abq_AutoQuestion_22_no, 
	'L_AUTOQUEST23' => sprintf($lang['ABQ_Question_2Lines'], sprintf($lang['ABQ_Form_AutoQuestType05'], 'x')), 
	'L_AUTOQUEST23_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/123.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST23_ENABLE' => $abq_AutoQuestion_23_yes, 
	'S_AUTOQUEST23_DISABLE' => $abq_AutoQuestion_23_no, 
	'L_AUTOQUEST24' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType06']), 
	'L_AUTOQUEST24_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/124.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST24_ENABLE' => $abq_AutoQuestion_24_yes, 
	'S_AUTOQUEST24_DISABLE' => $abq_AutoQuestion_24_no, 
	'L_AUTOQUEST25' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType07'], 'x1, x2, x3, x4, x5, x6, x7 ' . $lang['ABQ_and'] . ' x8')), 
	'L_AUTOQUEST25_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/125' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST25_ENABLE' => $abq_AutoQuestion_25_yes, 
	'S_AUTOQUEST25_DISABLE' => $abq_AutoQuestion_25_no, 
	'L_AUTOQUEST26' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType07'], 'x1, x2, x3, x4, x5, x6 ' . $lang['ABQ_and'] . ' x7')), 
	'L_AUTOQUEST26_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/126' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST26_ENABLE' => $abq_AutoQuestion_26_yes, 
	'S_AUTOQUEST26_DISABLE' => $abq_AutoQuestion_26_no, 
	'L_AUTOQUEST27' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType07'], 'x1, x2, x3, x4, x5 ' . $lang['ABQ_and'] . ' x6')), 
	'L_AUTOQUEST27_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/127' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST27_ENABLE' => $abq_AutoQuestion_27_yes, 
	'S_AUTOQUEST27_DISABLE' => $abq_AutoQuestion_27_no, 
	'L_AUTOQUEST28' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType07'], 'x1, x2, x3, x4, x5, x6, x7 ' . $lang['ABQ_and'] . ' x8')), 
	'L_AUTOQUEST28_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/128.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST28_ENABLE' => $abq_AutoQuestion_28_yes, 
	'S_AUTOQUEST28_DISABLE' => $abq_AutoQuestion_28_no, 
	'L_AUTOQUEST29' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType07'], 'x1, x2, x3, x4, x5, x6 ' . $lang['ABQ_and'] . ' x7')), 
	'L_AUTOQUEST29_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/129.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST29_ENABLE' => $abq_AutoQuestion_29_yes, 
	'S_AUTOQUEST29_DISABLE' => $abq_AutoQuestion_29_no, 
	'L_AUTOQUEST30' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType07'], 'x1, x2, x3, x4, x5 ' . $lang['ABQ_and'] . ' x6')), 
	'L_AUTOQUEST30_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/130.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST30_ENABLE' => $abq_AutoQuestion_30_yes, 
	'S_AUTOQUEST30_DISABLE' => $abq_AutoQuestion_30_no, 
	'L_AUTOQUEST31' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType08'], $lang['ABQ_Color1'])), 
	'L_AUTOQUEST31_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/131' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST31_ENABLE' => $abq_AutoQuestion_31_yes, 
	'S_AUTOQUEST31_DISABLE' => $abq_AutoQuestion_31_no, 
	'L_AUTOQUEST32' => sprintf($lang['ABQ_Question_1Line'], sprintf($lang['ABQ_Form_AutoQuestType08'], $lang['ABQ_Color2'])), 
	'L_AUTOQUEST32_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/132' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST32_ENABLE' => $abq_AutoQuestion_32_yes, 
	'S_AUTOQUEST32_DISABLE' => $abq_AutoQuestion_32_no, 
	'L_AUTOQUEST33' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType09']), 
	'L_AUTOQUEST33_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/133' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST33_ENABLE' => $abq_AutoQuestion_33_yes, 
	'S_AUTOQUEST33_DISABLE' => $abq_AutoQuestion_33_no, 
	'L_AUTOQUEST34' => sprintf($lang['ABQ_Question_1Line'], $lang['ABQ_Form_AutoQuestType09']), 
	'L_AUTOQUEST34_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/134.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_AUTOQUEST34_ENABLE' => $abq_AutoQuestion_34_yes, 
	'S_AUTOQUEST34_DISABLE' => $abq_AutoQuestion_34_no, 

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