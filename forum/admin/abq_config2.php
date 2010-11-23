<?php
/***************************************************************************
 *                          abq_config2.php
 *                          ---------------
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

if (isset($HTTP_POST_VARS['submit']))
{
	$DatenPost = array();
	$ABQ_Error = '';
	$ABQ_Error1 = 0;
	$ABQ_Error2 = 0;

	$DatenPost[] = 'lib_gd';
	if (($HTTP_POST_VARS['lib_gd'] === '0') || ($HTTP_POST_VARS['lib_gd'] === '1') || ($HTTP_POST_VARS['lib_gd'] === '2') || ($HTTP_POST_VARS['lib_gd'] === '3'))
	{
		$new_lib_gd = $HTTP_POST_VARS['lib_gd'];
	}
	else
	{
		$new_lib_gd = '3';
	}

	$DatenPost[] = 'lib_ft';
	if (($HTTP_POST_VARS['lib_ft'] === '0') || ($HTTP_POST_VARS['lib_ft'] === '1') || ($HTTP_POST_VARS['lib_ft'] === '2'))
	{
		$new_lib_ft = $HTTP_POST_VARS['lib_ft'];
	}
	else
	{
		$new_lib_ft = '2';
	}

	$ABQ_POSTVaris = array();
	$ABQ_POSTVaris[0][1] = 'Color_BG_R1';
	$ABQ_POSTVaris[0][2] = 'Color_BG_R2';
	$ABQ_POSTVaris[1][1] = 'Color_BG_G1';
	$ABQ_POSTVaris[1][2] = 'Color_BG_G2';
	$ABQ_POSTVaris[2][1] = 'Color_BG_B1';
	$ABQ_POSTVaris[2][2] = 'Color_BG_B2';
	$ABQ_POSTVaris[3][1] = 'Color_Grid1_R1';
	$ABQ_POSTVaris[3][2] = 'Color_Grid1_R2';
	$ABQ_POSTVaris[4][1] = 'Color_Grid1_G1';
	$ABQ_POSTVaris[4][2] = 'Color_Grid1_G2';
	$ABQ_POSTVaris[5][1] = 'Color_Grid1_B1';
	$ABQ_POSTVaris[5][2] = 'Color_Grid1_B2';
	$ABQ_POSTVaris[6][1] = 'Color_Grid2_R1';
	$ABQ_POSTVaris[6][2] = 'Color_Grid2_R2';
	$ABQ_POSTVaris[7][1] = 'Color_Grid2_G1';
	$ABQ_POSTVaris[7][2] = 'Color_Grid2_G2';
	$ABQ_POSTVaris[8][1] = 'Color_Grid2_B1';
	$ABQ_POSTVaris[8][2] = 'Color_Grid2_B2';
	$ABQ_POSTVaris[9][1] = 'Color_Grid3_R1';
	$ABQ_POSTVaris[9][2] = 'Color_Grid3_R2';
	$ABQ_POSTVaris[10][1] = 'Color_Grid3_G1';
	$ABQ_POSTVaris[10][2] = 'Color_Grid3_G2';
	$ABQ_POSTVaris[11][1] = 'Color_Grid3_B1';
	$ABQ_POSTVaris[11][2] = 'Color_Grid3_B2';
	$ABQ_POSTVaris[12][1] = 'Color_Grid4_R1';
	$ABQ_POSTVaris[12][2] = 'Color_Grid4_R2';
	$ABQ_POSTVaris[13][1] = 'Color_Grid4_G1';
	$ABQ_POSTVaris[13][2] = 'Color_Grid4_G2';
	$ABQ_POSTVaris[14][1] = 'Color_Grid4_B1';
	$ABQ_POSTVaris[14][2] = 'Color_Grid4_B2';
	$ABQ_POSTVaris[15][1] = 'Color_FilledGrid_R1';
	$ABQ_POSTVaris[15][2] = 'Color_FilledGrid_R2';
	$ABQ_POSTVaris[16][1] = 'Color_FilledGrid_G1';
	$ABQ_POSTVaris[16][2] = 'Color_FilledGrid_G2';
	$ABQ_POSTVaris[17][1] = 'Color_FilledGrid_B1';
	$ABQ_POSTVaris[17][2] = 'Color_FilledGrid_B2';
	$ABQ_POSTVaris[18][1] = 'Color_Ellipses_R1';
	$ABQ_POSTVaris[18][2] = 'Color_Ellipses_R2';
	$ABQ_POSTVaris[19][1] = 'Color_Ellipses_G1';
	$ABQ_POSTVaris[19][2] = 'Color_Ellipses_G2';
	$ABQ_POSTVaris[20][1] = 'Color_Ellipses_B1';
	$ABQ_POSTVaris[20][2] = 'Color_Ellipses_B2';
	$ABQ_POSTVaris[21][1] = 'Color_PartialEllipses_R1';
	$ABQ_POSTVaris[21][2] = 'Color_PartialEllipses_R2';
	$ABQ_POSTVaris[22][1] = 'Color_PartialEllipses_G1';
	$ABQ_POSTVaris[22][2] = 'Color_PartialEllipses_G2';
	$ABQ_POSTVaris[23][1] = 'Color_PartialEllipses_B1';
	$ABQ_POSTVaris[23][2] = 'Color_PartialEllipses_B2';
	$ABQ_POSTVaris[24][1] = 'Color_Lines_R1';
	$ABQ_POSTVaris[24][2] = 'Color_Lines_R2';
	$ABQ_POSTVaris[25][1] = 'Color_Lines_G1';
	$ABQ_POSTVaris[25][2] = 'Color_Lines_G2';
	$ABQ_POSTVaris[26][1] = 'Color_Lines_B1';
	$ABQ_POSTVaris[26][2] = 'Color_Lines_B2';
	$ABQ_POSTVaris[27][1] = 'Color_Arcs_R1';
	$ABQ_POSTVaris[27][2] = 'Color_Arcs_R2';
	$ABQ_POSTVaris[28][1] = 'Color_Arcs_G1';
	$ABQ_POSTVaris[28][2] = 'Color_Arcs_G2';
	$ABQ_POSTVaris[29][1] = 'Color_Arcs_B1';
	$ABQ_POSTVaris[29][2] = 'Color_Arcs_B2';
	$ABQ_POSTVaris[30][1] = 'Color_BGText_R1';
	$ABQ_POSTVaris[30][2] = 'Color_BGText_R2';
	$ABQ_POSTVaris[31][1] = 'Color_BGText_G1';
	$ABQ_POSTVaris[31][2] = 'Color_BGText_G2';
	$ABQ_POSTVaris[32][1] = 'Color_BGText_B1';
	$ABQ_POSTVaris[32][2] = 'Color_BGText_B2';
	$ABQ_POSTVaris[33][1] = 'Color_Text_R1';
	$ABQ_POSTVaris[33][2] = 'Color_Text_R2';
	$ABQ_POSTVaris[34][1] = 'Color_Text_G1';
	$ABQ_POSTVaris[34][2] = 'Color_Text_G2';
	$ABQ_POSTVaris[35][1] = 'Color_Text_B1';
	$ABQ_POSTVaris[35][2] = 'Color_Text_B2';
	$ABQ_POSTVaris[36][1] = 'Color_SeparatingLines_R1';
	$ABQ_POSTVaris[36][2] = 'Color_SeparatingLines_R2';
	$ABQ_POSTVaris[37][1] = 'Color_SeparatingLines_G1';
	$ABQ_POSTVaris[37][2] = 'Color_SeparatingLines_G2';
	$ABQ_POSTVaris[38][1] = 'Color_SeparatingLines_B1';
	$ABQ_POSTVaris[38][2] = 'Color_SeparatingLines_B2';

	unset($i);
	unset($j);
	$j = count($ABQ_POSTVaris);
	for ($i=0; $i<$j; $i++)
	{
		$DatenPost[] = $ABQ_POSTVaris[$i][1];
		if (($HTTP_POST_VARS[$ABQ_POSTVaris[$i][1]] < 0) || ($HTTP_POST_VARS[$ABQ_POSTVaris[$i][1]] > 255) || (!preg_match('/^[0-9]{1,3}$/',$HTTP_POST_VARS[$ABQ_POSTVaris[$i][1]])))
		{
			$ABQ_Error1 = 1;
			break;
		}
		else
		{
			${'new_'.$ABQ_POSTVaris[$i][1]} = $HTTP_POST_VARS[$ABQ_POSTVaris[$i][1]];
		}
		$DatenPost[] = $ABQ_POSTVaris[$i][2];
		if (($HTTP_POST_VARS[$ABQ_POSTVaris[$i][2]] < 0) || ($HTTP_POST_VARS[$ABQ_POSTVaris[$i][2]] > 255) || (!preg_match('/^[0-9]{1,3}$/',$HTTP_POST_VARS[$ABQ_POSTVaris[$i][1]])))
		{
			$ABQ_Error1 = 1;
			break;
		}
		else
		{
			${'new_'.$ABQ_POSTVaris[$i][2]} = $HTTP_POST_VARS[$ABQ_POSTVaris[$i][2]];
		}
		if ((isset(${'new_'.$ABQ_POSTVaris[$i][1]})) && (isset(${'new_'.$ABQ_POSTVaris[$i][2]})) && (${'new_'.$ABQ_POSTVaris[$i][2]} <= ${'new_'.$ABQ_POSTVaris[$i][1]}))
		{
			$ABQ_Error2 = 1;
			break;
		}
	}

	unset($ABQ_POSTVaris);
	$ABQ_POSTVaris = array();
	$ABQ_POSTVaris[] = 'Color_Text_Question1_R';
	$ABQ_POSTVaris[] = 'Color_Text_Question1_G';
	$ABQ_POSTVaris[] = 'Color_Text_Question1_B';
	$ABQ_POSTVaris[] = 'Color_Text_Question2_R';
	$ABQ_POSTVaris[] = 'Color_Text_Question2_G';
	$ABQ_POSTVaris[] = 'Color_Text_Question2_B';

	unset($i);
	unset($j);
	$j = count($ABQ_POSTVaris);
	for ($i=0; $i<$j; $i++)
	{
		$DatenPost[] = $ABQ_POSTVaris[$i];
		if (($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] < 0) || ($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] > 255) || (!preg_match('/^[0-9]{1,3}$/',$HTTP_POST_VARS[$ABQ_POSTVaris[$i]])))
		{
			$ABQ_Error1 = 1;
			break;
		}
		else
		{
			${'new_'.$ABQ_POSTVaris[$i]} = $HTTP_POST_VARS[$ABQ_POSTVaris[$i]];
		}
	}

	if ($ABQ_Error1)
	{
		$ABQ_Error .= $lang['ABQ_Error_ColorValue1'] . '<br />';
	}
	if ($ABQ_Error2)
	{
		$ABQ_Error .= $lang['ABQ_Error_ColorValue2'] . '<br />';
	}

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

	$message = $lang['ABQ_Config2_updated'] . "<br /><br />" . sprintf($lang['ABQ_Click_return_config2'], "<a href=\"" . append_sid("abq_config2.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}

$sql = 'SELECT * 
	FROM ' . ANTI_BOT_QUEST_CONFIG_TABLE . '
	WHERE config_name LIKE \'Color_%\' OR config_name LIKE \'lib_%\'';
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in abq_config2", "", __LINE__, __FILE__, $sql);
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

$lib_gd_installed1 = ($new['lib_gd'] === '1') ? 'checked="checked"' : '';
$lib_gd_installed2 = ($new['lib_gd'] === '2') ? 'checked="checked"' : '';
$lib_gd_notinstalled = ($new['lib_gd'] === '0') ? 'checked="checked"' : '';
$lib_gd_auto = (($new['lib_gd'] !== '0') && ($new['lib_gd'] !== '1') && ($new['lib_gd'] !== '2')) ? 'checked="checked"' : '';

$lib_ft_installed1 = ($new['lib_ft'] === '1') ? 'checked="checked"' : '';
$lib_ft_notinstalled = ($new['lib_ft'] === '0') ? 'checked="checked"' : '';
$lib_ft_auto = (($new['lib_ft'] !== '0') && ($new['lib_ft'] !== '1')) ? 'checked="checked"' : '';

$template->set_filenames(array(
	'body' => 'admin/abq_config2_body.tpl')
);

$template->assign_vars(array(
	'U_CONFIG_ACTION' => append_sid("abq_config2.$phpEx"), 
	'L_SUBMIT' => $lang['Submit'], 
	'L_RESET' => $lang['Reset'], 
	'L_CONFIGURATION_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_ColorConf_Titel'], 
	'L_CONFIGURATION_EXPLAIN' => $lang['ABQ_ColorConf_Explain'], 
	'L_RGB_R' => $lang['ABQ_RGB_red'], 
	'L_RGB_G' => $lang['ABQ_RGB_green'], 
	'L_RGB_B' => $lang['ABQ_RGB_blue'], 

	'L_LIBRARYCONFIG' => $lang['ABQ_Libraries'], 
	'L_INSTALLED' => $lang['ABQ_installed'], 
	'L_NOTINSTALLED' => $lang['ABQ_not_installed'], 
	'L_AUTO' => $lang['ABQ_auto_detection'], 
	'L_VERSION1' => $lang['ABQ_Version1'], 
	'L_VERSION2' => $lang['ABQ_Version2'], 
	'L_LIB_GD' => $lang['ABQ_lib_GD_conf'], 
	'L_LIB_GD_EXPLAIN' => $lang['ABQ_lib_GD_conf_explain'], 
	'L_LIB_FT' => $lang['ABQ_lib_FT_conf'], 
	'L_LIB_FT_EXPLAIN' => $lang['ABQ_lib_FT_conf_explain'], 
	'S_LIB_GD_INSTALLED1' => $lib_gd_installed1, 
	'S_LIB_GD_INSTALLED2' => $lib_gd_installed2, 
	'S_LIB_GD_NOTINSTALLED' => $lib_gd_notinstalled, 
	'S_LIB_GD_AUTO' => $lib_gd_auto, 
	'S_LIB_FT_INSTALLED1' => $lib_ft_installed1, 
	'S_LIB_FT_NOTINSTALLED' => $lib_ft_notinstalled, 
	'S_LIB_FT_AUTO' => $lib_ft_auto, 

	'L_MAINCONFIG' => $lang['ABQ_ColorMainconfig'], 
	'L_BG' => $lang['ABQ_Color_BG'], 
	'L_TEXT' => $lang['ABQ_Color_Text'], 
	'L_TEXT_EXPLAIN' => $lang['ABQ_Color_Text_Explain'], 
	'L_TEXT_QUESTION1' => $lang['ABQ_Color_Question1'], 
	'L_TEXT_QUESTION1_EXPLAIN' => sprintf($lang['ABQ_Color_Question1_Explain'], sprintf($lang['ABQ_Form_AutoQuestType08'], $lang['ABQ_Color1'])), 
	'L_TEXT_QUESTION2' => $lang['ABQ_Color_Question2'], 
	'L_TEXT_QUESTION2_EXPLAIN' => sprintf($lang['ABQ_Color_Question2_Explain'], sprintf($lang['ABQ_Form_AutoQuestType08'], $lang['ABQ_Color2'])), 
	'S_BG_R1' => $new['Color_BG_R1'], 
	'S_BG_R2' => $new['Color_BG_R2'], 
	'S_BG_G1' => $new['Color_BG_G1'], 
	'S_BG_G2' => $new['Color_BG_G2'], 
	'S_BG_B1' => $new['Color_BG_B1'], 
	'S_BG_B2' => $new['Color_BG_B2'], 
	'S_TEXT_R1' => $new['Color_Text_R1'], 
	'S_TEXT_R2' => $new['Color_Text_R2'], 
	'S_TEXT_G1' => $new['Color_Text_G1'], 
	'S_TEXT_G2' => $new['Color_Text_G2'], 
	'S_TEXT_B1' => $new['Color_Text_B1'], 
	'S_TEXT_B2' => $new['Color_Text_B2'], 
	'S_TEXT_QUESTION1_R' => $new['Color_Text_Question1_R'], 
	'S_TEXT_QUESTION1_G' => $new['Color_Text_Question1_G'], 
	'S_TEXT_QUESTION1_B' => $new['Color_Text_Question1_B'], 
	'S_TEXT_QUESTION2_R' => $new['Color_Text_Question2_R'], 
	'S_TEXT_QUESTION2_G' => $new['Color_Text_Question2_G'], 
	'S_TEXT_QUESTION2_B' => $new['Color_Text_Question2_B'], 
	'L_EFFECTCONFIG' => $lang['ABQ_Effect_conf'],
	'L_SEPARATINGLINES' => $lang['ABQ_Color_SeparatingLines'], 
	'L_BGTEXT' => $lang['ABQ_Color_BGText'], 
	'L_BGTEXT_EXPLAIN' => $lang['ABQ_Color_BGText_Explain'], 
	'L_GRID1' => $lang['ABQ_Color_Grid'] . ' 1', 
	'L_GRID2' => $lang['ABQ_Color_Grid'] . ' 2', 
	'L_GRID3' => $lang['ABQ_Color_Grid'] . ' 3', 
	'L_GRID4' => $lang['ABQ_Color_Grid'] . ' 4', 
	'L_FILLEDGRID' => $lang['ABQ_Color_FilledGrid'], 
	'L_ELLIPSES' => $lang['ABQ_Color_Ellipses'], 
	'L_PARTIALELLIPSES' => $lang['ABQ_Color_PartialEllipses'], 
	'L_ARCS' => $lang['ABQ_Color_Arcs'], 
	'L_LINES' => $lang['ABQ_Color_Lines'], 
	'S_SEPARATINGLINES_R1' => $new['Color_SeparatingLines_R1'], 
	'S_SEPARATINGLINES_R2' => $new['Color_SeparatingLines_R2'], 
	'S_SEPARATINGLINES_G1' => $new['Color_SeparatingLines_G1'], 
	'S_SEPARATINGLINES_G2' => $new['Color_SeparatingLines_G2'], 
	'S_SEPARATINGLINES_B1' => $new['Color_SeparatingLines_B1'], 
	'S_SEPARATINGLINES_B2' => $new['Color_SeparatingLines_B2'], 
	'S_BGTEXT_R1' => $new['Color_BGText_R1'], 
	'S_BGTEXT_R2' => $new['Color_BGText_R2'], 
	'S_BGTEXT_G1' => $new['Color_BGText_G1'], 
	'S_BGTEXT_G2' => $new['Color_BGText_G2'], 
	'S_BGTEXT_B1' => $new['Color_BGText_B1'], 
	'S_BGTEXT_B2' => $new['Color_BGText_B2'], 
	'S_GRID1_R1' => $new['Color_Grid1_R1'], 
	'S_GRID1_R2' => $new['Color_Grid1_R2'], 
	'S_GRID1_G1' => $new['Color_Grid1_G1'], 
	'S_GRID1_G2' => $new['Color_Grid1_G2'], 
	'S_GRID1_B1' => $new['Color_Grid1_B1'], 
	'S_GRID1_B2' => $new['Color_Grid1_B2'], 
	'S_GRID2_R1' => $new['Color_Grid2_R1'], 
	'S_GRID2_R2' => $new['Color_Grid2_R2'], 
	'S_GRID2_G1' => $new['Color_Grid2_G1'], 
	'S_GRID2_G2' => $new['Color_Grid2_G2'], 
	'S_GRID2_B1' => $new['Color_Grid2_B1'], 
	'S_GRID2_B2' => $new['Color_Grid2_B2'], 
	'S_GRID3_R1' => $new['Color_Grid3_R1'], 
	'S_GRID3_R2' => $new['Color_Grid3_R2'], 
	'S_GRID3_G1' => $new['Color_Grid3_G1'], 
	'S_GRID3_G2' => $new['Color_Grid3_G2'], 
	'S_GRID3_B1' => $new['Color_Grid3_B1'], 
	'S_GRID3_B2' => $new['Color_Grid3_B2'], 
	'S_GRID4_R1' => $new['Color_Grid4_R1'], 
	'S_GRID4_R2' => $new['Color_Grid4_R2'], 
	'S_GRID4_G1' => $new['Color_Grid4_G1'], 
	'S_GRID4_G2' => $new['Color_Grid4_G2'], 
	'S_GRID4_B1' => $new['Color_Grid4_B1'], 
	'S_GRID4_B2' => $new['Color_Grid4_B2'], 
	'S_FILLEDGRID_R1' => $new['Color_FilledGrid_R1'], 
	'S_FILLEDGRID_R2' => $new['Color_FilledGrid_R2'], 
	'S_FILLEDGRID_G1' => $new['Color_FilledGrid_G1'], 
	'S_FILLEDGRID_G2' => $new['Color_FilledGrid_G2'], 
	'S_FILLEDGRID_B1' => $new['Color_FilledGrid_B1'], 
	'S_FILLEDGRID_B2' => $new['Color_FilledGrid_B2'], 
	'S_ELLIPSES_R1' => $new['Color_Ellipses_R1'], 
	'S_ELLIPSES_R2' => $new['Color_Ellipses_R2'], 
	'S_ELLIPSES_G1' => $new['Color_Ellipses_G1'], 
	'S_ELLIPSES_G2' => $new['Color_Ellipses_G2'], 
	'S_ELLIPSES_B1' => $new['Color_Ellipses_B1'], 
	'S_ELLIPSES_B2' => $new['Color_Ellipses_B2'], 
	'S_PARTIALELLIPSES_R1' => $new['Color_PartialEllipses_R1'], 
	'S_PARTIALELLIPSES_R2' => $new['Color_PartialEllipses_R2'], 
	'S_PARTIALELLIPSES_G1' => $new['Color_PartialEllipses_G1'], 
	'S_PARTIALELLIPSES_G2' => $new['Color_PartialEllipses_G2'], 
	'S_PARTIALELLIPSES_B1' => $new['Color_PartialEllipses_B1'], 
	'S_PARTIALELLIPSES_B2' => $new['Color_PartialEllipses_B2'], 
	'S_ARCS_R1' => $new['Color_Arcs_R1'], 
	'S_ARCS_R2' => $new['Color_Arcs_R2'], 
	'S_ARCS_G1' => $new['Color_Arcs_G1'], 
	'S_ARCS_G2' => $new['Color_Arcs_G2'], 
	'S_ARCS_B1' => $new['Color_Arcs_B1'], 
	'S_ARCS_B2' => $new['Color_Arcs_B2'], 
	'S_LINES_R1' => $new['Color_Lines_R1'], 
	'S_LINES_R2' => $new['Color_Lines_R2'], 
	'S_LINES_G1' => $new['Color_Lines_G1'], 
	'S_LINES_G2' => $new['Color_Lines_G2'], 
	'S_LINES_B1' => $new['Color_Lines_B1'], 
	'S_LINES_B2' => $new['Color_Lines_B2'], 

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