<?php
/***************************************************************************
 *                          abq_config.php
 *                          --------------
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

if(isset($HTTP_POST_VARS['submit']))
{
	$DatenPost = array();
	$ABQ_Error = '';

	$DatenPost[] = 'abq_register';
	if (($HTTP_POST_VARS['abq_register'] === '1') || ($HTTP_POST_VARS['abq_register'] === '0'))
	{
		$new_abq_register = $HTTP_POST_VARS['abq_register'];
	}
	else
	{
		$new_abq_register = '0';
	}

	$DatenPost[] = 'abq_guest';
	if (($HTTP_POST_VARS['abq_guest'] === '1') || ($HTTP_POST_VARS['abq_guest'] === '0'))
	{
		$new_abq_guest = $HTTP_POST_VARS['abq_guest'];
	}
	else
	{
		$new_abq_guest = '0';
	}

	$DatenPost[] = 'agreed_variable_name';
	if ((strlen($HTTP_POST_VARS['agreed_variable_name']) < 3) || (strlen($HTTP_POST_VARS['agreed_variable_name']) > 35))
	{
		$ABQ_Error .= $lang['ABQ_Error_agreedvariable_name_length'] . '<br />';
	}
	elseif (!preg_match('/^[a-z0-9]{3,35}$/i', $HTTP_POST_VARS['agreed_variable_name']))
	{
		$ABQ_Error .= $lang['ABQ_Error_agreedvariable_name_length'] . '<br />';
	}
	else
	{
		$new_agreed_variable_name = 'ab_' . $HTTP_POST_VARS['agreed_variable_name'];
	}

	$DatenPost[] = 'agreed_variable_value';
	if ((strlen($HTTP_POST_VARS['agreed_variable_value']) < 3) || (strlen($HTTP_POST_VARS['agreed_variable_value']) > 35))
	{
		$ABQ_Error .= $lang['ABQ_Error_agreedvariable_value_length'] . '<br />';
	}
	elseif (!preg_match('/^[a-z0-9]{3,35}$/i', $HTTP_POST_VARS['agreed_variable_value']))
	{
		$ABQ_Error .= $lang['ABQ_Error_agreedvariable_value_length'] . '<br />';
	}
	else
	{
		$new_agreed_variable_value = $HTTP_POST_VARS['agreed_variable_value'];
	}

	$DatenPost[] = 'email_variable_name';
	if ((strlen($HTTP_POST_VARS['email_variable_name']) < 3) || (strlen($HTTP_POST_VARS['email_variable_name']) > 35))
	{
		$ABQ_Error .= $lang['ABQ_Error_emailvariable_name_length'] . '<br />';
	}
	elseif (!preg_match('/^[a-z0-9]{3,35}$/i',$HTTP_POST_VARS['email_variable_name']))
	{
		$ABQ_Error .= $lang['ABQ_Error_emailvariable_name_length'] . '<br />';
	}
	elseif (strtolower($HTTP_POST_VARS['email_variable_name']) == strtolower($HTTP_POST_VARS['agreed_variable_name']))
	{
		$ABQ_Error .= $lang['ABQ_Error_variables_same_name'] . '<br />';
	}
	else
	{
		$new_email_variable_name = 'ab_' . $HTTP_POST_VARS['email_variable_name'];
	}

	$DatenPost[] = 'abq_variable_name';
	$new_abq_variable_name = '';
	if (isset($HTTP_POST_VARS['abq_variable_namepart1']))
	{
		$new_abq_variable_name .= $HTTP_POST_VARS['abq_variable_namepart1'];
	}
	if (isset($HTTP_POST_VARS['abq_variable_namepart2']))
	{
		$new_abq_variable_name .= $HTTP_POST_VARS['abq_variable_namepart2'];
	}
	if (isset($HTTP_POST_VARS['abq_variable_namepart3']))
	{
		$new_abq_variable_name .= $HTTP_POST_VARS['abq_variable_namepart3'];
	}
	if (isset($HTTP_POST_VARS['abq_variable_namepart4']))
	{
		$new_abq_variable_name .= $HTTP_POST_VARS['abq_variable_namepart4'];
	}
	if (isset($HTTP_POST_VARS['abq_variable_namepart5']))
	{
		$new_abq_variable_name .= $HTTP_POST_VARS['abq_variable_namepart5'];
	}
	if (isset($HTTP_POST_VARS['abq_variable_namepart6']))
	{
		$new_abq_variable_name .= $HTTP_POST_VARS['abq_variable_namepart6'];
	}
	if ((trim($new_abq_variable_name) == '') || (!preg_match('/^[a-z_]{2,5}[0-9]{4}[0-9a-z]{0,5}$/', $new_abq_variable_name)))
	{
		$new_abq_variable_name == 'abq_0001';
	}

	$DatenPost[] = 'Ratio_Auto_Indi_Questions';
	if (($HTTP_POST_VARS['Ratio_Auto_Indi_Questions'] < 0) || ($HTTP_POST_VARS['Ratio_Auto_Indi_Questions'] > 100) || (!preg_match('/^[0-9]{1,3}$/',$HTTP_POST_VARS['Ratio_Auto_Indi_Questions'])))
	{
		$ABQ_Error .= $lang['ABQ_Error_Percentage'] . '<br />';
	}
	else
	{
		$new_Ratio_Auto_Indi_Questions = $HTTP_POST_VARS['Ratio_Auto_Indi_Questions'];
	}

	$DatenPost[] = 'fontsize';
	if (($HTTP_POST_VARS['fontsize'] < 15) || ($HTTP_POST_VARS['fontsize'] > 40) || (!preg_match('/^[0-9]{1,2}$/',$HTTP_POST_VARS['fontsize'])))
	{
		$ABQ_Error .= $lang['ABQ_Error_Fontsize'] . '<br />';
	}
	else
	{
		$new_fontsize = $HTTP_POST_VARS['fontsize'];
	}

	$DatenPost[] = 'ImageFormat';
	if (($HTTP_POST_VARS['ImageFormat'] === '1') || ($HTTP_POST_VARS['ImageFormat'] === '0'))
	{
		$new_ImageFormat = $HTTP_POST_VARS['ImageFormat'];
	}
	else
	{
		$new_ImageFormat = '1';
	}

	$DatenPost[] = 'JPG_Quality';
	if (($HTTP_POST_VARS['JPG_Quality'] < 50) || ($HTTP_POST_VARS['JPG_Quality'] > 90) || (!preg_match('/^[0-9]{1,2}$/',$HTTP_POST_VARS['JPG_Quality'])))
	{
		$ABQ_Error .= $lang['ABQ_Error_JPGQuality'] . '<br />';
	}
	else
	{
		$new_JPG_Quality = $HTTP_POST_VARS['JPG_Quality'];
	}

	$DatenPost[] = 'max_Effects';
	if (($HTTP_POST_VARS['max_Effects'] < 0) || ($HTTP_POST_VARS['max_Effects'] > 6) || (!preg_match('/^[0-9]$/',$HTTP_POST_VARS['max_Effects'])))
	{
		$ABQ_Error .= $lang['ABQ_Error_MaxEffects'] . '<br />';
	}
	else
	{
		$new_max_Effects = $HTTP_POST_VARS['max_Effects'];
	}

	$DatenPost[] = 'Effect_GridWidth';
	if ((($HTTP_POST_VARS['Effect_GridWidth'] < 10) && ($HTTP_POST_VARS['Effect_GridWidth'] != 0)) || ($HTTP_POST_VARS['Effect_GridWidth'] > 100) || (!preg_match('/^[0-9]{1,3}$/',$HTTP_POST_VARS['Effect_GridWidth'])))
	{
		$ABQ_Error .= $lang['ABQ_Error_GridWidth'] . '<br />';
	}
	else
	{
		$new_Effect_GridWidth = $HTTP_POST_VARS['Effect_GridWidth'];
	}

	$DatenPost[] = 'Effect_GridHeight';
	if ((($HTTP_POST_VARS['Effect_GridHeight'] < 10) && ($HTTP_POST_VARS['Effect_GridHeight'] != 0)) || ($HTTP_POST_VARS['Effect_GridHeight'] > 50) || (!preg_match('/^[0-9]{1,2}$/',$HTTP_POST_VARS['Effect_GridHeight'])))
	{
		$ABQ_Error .= $lang['ABQ_Error_GridHeight'] . '<br />';
	}
	else
	{
		$new_Effect_GridHeight = $HTTP_POST_VARS['Effect_GridHeight'];
	}

	$DatenPost[] = 'AutoQuests_MultiplicationSymbol';
	if (($HTTP_POST_VARS['AutoQuests_MultiplicationSymbol'] == '*') || ($HTTP_POST_VARS['AutoQuests_MultiplicationSymbol'] == 'x') || ($HTTP_POST_VARS['AutoQuests_MultiplicationSymbol'] == 'X'))
	{
		$new_AutoQuests_MultiplicationSymbol = $HTTP_POST_VARS['AutoQuests_MultiplicationSymbol'];
	}
	else
	{
		$new_AutoQuests_MultiplicationSymbol = '*';
	}

	$DatenPost[] = 'show_counter';
	if (($HTTP_POST_VARS['show_counter'] === '0') || ($HTTP_POST_VARS['show_counter'] === '1') || ($HTTP_POST_VARS['show_counter'] === '2') || ($HTTP_POST_VARS['show_counter'] === '3'))
	{
		$new_show_counter = $HTTP_POST_VARS['show_counter'];
	}
	else
	{
		$new_show_counter = '2';
	}

	$DatenPost[] = 'lockregister';
	if (($HTTP_POST_VARS['lockregister'] >= 0) && ($HTTP_POST_VARS['lockregister'] <= 19) && (preg_match('/^[0-9]{1,2}$/',$HTTP_POST_VARS['lockregister'])))
	{
		$new_lockregister = $HTTP_POST_VARS['lockregister'];
	}
	else
	{
		$ABQ_Error .= $lang['ABQ_Error_Attemps'] . '<br />';
	}

	$DatenPost[] = 'lockguestposts';
	if (($HTTP_POST_VARS['lockguestposts'] >= 0) && ($HTTP_POST_VARS['lockguestposts'] <= 19) && (preg_match('/^[0-9]{1,2}$/',$HTTP_POST_VARS['lockguestposts'])))
	{
		$new_lockguestposts = $HTTP_POST_VARS['lockguestposts'];
	}
	else
	{
		$ABQ_Error .= $lang['ABQ_Error_Attemps'] . '<br />';
	}

	unset($ABQ_POSTVaris);
	unset($i);
	unset($j);
	$ABQ_POSTVaris = array();
	$ABQ_POSTVaris[] = 'Individuel_Questions';
	$ABQ_POSTVaris[] = 'IndiQuests_CaseSensitive';
	$ABQ_POSTVaris[] = 'IndiQuests_ImagePHP';
	$ABQ_POSTVaris[] = 'Effect_SeparatingLines';
	$ABQ_POSTVaris[] = 'AutoQuests_MultipleChoise';
	$ABQ_POSTVaris[] = 'multiimages';
	$j = count($ABQ_POSTVaris);
	for ($i=0; $i<$j; $i++)
	{
		$DatenPost[] = $ABQ_POSTVaris[$i];
		if (($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] === '1') || ($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] === '0'))
		{
			${'new_'.$ABQ_POSTVaris[$i]} = $HTTP_POST_VARS[$ABQ_POSTVaris[$i]];
		}
		else
		{
			${'new_'.$ABQ_POSTVaris[$i]} = '0';
		}
	}

	unset($ABQ_POSTVaris);
	unset($i);
	unset($j);
	$ABQ_POSTVaris = array();
	$ABQ_POSTVaris[] = 'AutoQuests_LargeNumbers';
	$ABQ_POSTVaris[] = 'Effect_BGText';
	$ABQ_POSTVaris[] = 'Effect_Grid';
	$ABQ_POSTVaris[] = 'Effect_FilledGrid';
	$ABQ_POSTVaris[] = 'Effect_Ellipses';
	$ABQ_POSTVaris[] = 'Effect_Arcs';
	$ABQ_POSTVaris[] = 'Effect_Lines';
	$j = count($ABQ_POSTVaris);
	for ($i=0; $i<$j; $i++)
	{
		$DatenPost[] = $ABQ_POSTVaris[$i];
		if (($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] === '2') || ($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] === '1') || ($HTTP_POST_VARS[$ABQ_POSTVaris[$i]] === '0'))
		{
			${'new_'.$ABQ_POSTVaris[$i]} = $HTTP_POST_VARS[$ABQ_POSTVaris[$i]];
		}
		else
		{
			${'new_'.$ABQ_POSTVaris[$i]} = '0';
		}
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

	$message = $lang['ABQ_Config_updated'] . "<br /><br />" . sprintf($lang['ABQ_Click_return_config'], "<a href=\"" . append_sid("abq_config.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}

$ABQ_PHP_Version = array();
$ABQ_FTLib_Version = 0;
$ABQ_GDLib_Version = 0;
ABQ_gdVersion();

$ABQ_Elip_JN = 0;
if (($ABQ_PHP_Version[0] > 4) || (($ABQ_PHP_Version[0] == 4) && ($ABQ_PHP_Version[1] > 0)) || (($ABQ_PHP_Version[0] == 4) && ($ABQ_PHP_Version[1] == 0) && ($ABQ_PHP_Version[2] >= 6)))
{
	$ABQ_Elip_JN = 1;
}

$sql = 'SELECT * 
	FROM ' . ANTI_BOT_QUEST_CONFIG_TABLE . '
	WHERE config_name NOT LIKE \'AutoQuestion_%\' AND config_name NOT LIKE \'Color_%\'';
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in abq_config", "", __LINE__, __FILE__, $sql);
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

$abq_register_yes = ($new['abq_register']) ? 'checked="checked"' : '';
$abq_register_no = (!$new['abq_register']) ? 'checked="checked"' : '';

$abq_guest_yes = ($new['abq_guest']) ? 'checked="checked"' : '';
$abq_guest_no = (!$new['abq_guest']) ? 'checked="checked"' : '';

$new['agreed_variable_name'] = substr($new['agreed_variable_name'],3);
$new['email_variable_name'] = substr($new['email_variable_name'],3);

$ef_yes = ($new['Individuel_Questions']) ? 'checked="checked"' : '';
$ef_no = (!$new['Individuel_Questions']) ? 'checked="checked"' : '';

$efcasesen_yes = ($new['IndiQuests_CaseSensitive']) ? 'checked="checked"' : '';
$efcasesen_no = (!$new['IndiQuests_CaseSensitive']) ? 'checked="checked"' : '';

$bildphp_yes = ($new['IndiQuests_ImagePHP']) ? 'checked="checked"' : '';
$bildphp_no = (!$new['IndiQuests_ImagePHP']) ? 'checked="checked"' : '';

$af_ImageFormat_JPG = ($new['ImageFormat']) ? 'checked="checked"' : '';
$af_ImageFormat_PNG = (!$new['ImageFormat']) ? 'checked="checked"' : '';

$AutoQuests_LargeNumbers_yes = ($new['AutoQuests_LargeNumbers'] == 1) ? 'checked="checked"' : '';
$AutoQuests_LargeNumbers_no = ($new['AutoQuests_LargeNumbers'] == 0) ? 'checked="checked"' : '';
$AutoQuests_LargeNumbers_rand = ($new['AutoQuests_LargeNumbers'] == 2) ? 'checked="checked"' : '';

$Effect_SeparatingLines_yes = ($new['Effect_SeparatingLines']) ? 'checked="checked"' : '';
$Effect_SeparatingLines_no = (!$new['Effect_SeparatingLines']) ? 'checked="checked"' : '';

$Effect_BGText_yes = ($new['Effect_BGText'] == 1) ? 'checked="checked"' : '';
$Effect_BGText_no = ($new['Effect_BGText'] == 0) ? 'checked="checked"' : '';
$Effect_BGText_rand = ($new['Effect_BGText'] == 2) ? 'checked="checked"' : '';

$Effect_Grid_yes = ($new['Effect_Grid'] == 1) ? 'checked="checked"' : '';
$Effect_Grid_no = ($new['Effect_Grid'] == 0) ? 'checked="checked"' : '';
$Effect_Grid_rand = ($new['Effect_Grid'] == 2) ? 'checked="checked"' : '';

$Effect_FilledGrid_yes = ($new['Effect_FilledGrid'] == 1) ? 'checked="checked"' : '';
$Effect_FilledGrid_no = ($new['Effect_FilledGrid'] == 0) ? 'checked="checked"' : '';
$Effect_FilledGrid_rand = ($new['Effect_FilledGrid'] == 2) ? 'checked="checked"' : '';

$Effect_Ellipses_yes = ((($new['Effect_Ellipses'] == 1) && ($ABQ_Elip_JN == 1)) ? 'checked="checked"' : '') . (($ABQ_Elip_JN == 0) ? ' disabled="disabled"' : '');
$Effect_Ellipses_no = (($new['Effect_Ellipses'] == 0) || ($ABQ_Elip_JN == 0)) ? 'checked="checked"' : '';
$Effect_Ellipses_rand = ((($new['Effect_Ellipses'] == 2) && ($ABQ_Elip_JN == 1)) ? 'checked="checked"' : '') . (($ABQ_Elip_JN == 0) ? ' disabled="disabled"' : '');

$Effect_Arcs_yes = ($new['Effect_Arcs'] == 1) ? 'checked="checked"' : '';
$Effect_Arcs_no = ($new['Effect_Arcs'] == 0) ? 'checked="checked"' : '';
$Effect_Arcs_rand = ($new['Effect_Arcs'] == 2) ? 'checked="checked"' : '';

$Effect_Lines_yes = ($new['Effect_Lines'] == 1) ? 'checked="checked"' : '';
$Effect_Lines_no = ($new['Effect_Lines'] == 0) ? 'checked="checked"' : '';
$Effect_Lines_rand = ($new['Effect_Lines'] == 2) ? 'checked="checked"' : '';

$AutoQuests_MultiplicationSymbol_1 = ($new['AutoQuests_MultiplicationSymbol'] == '*') ? 'checked="checked"' : '';
$AutoQuests_MultiplicationSymbol_2 = ($new['AutoQuests_MultiplicationSymbol'] == 'x') ? 'checked="checked"' : '';
$AutoQuests_MultiplicationSymbol_3 = ($new['AutoQuests_MultiplicationSymbol'] == 'X') ? 'checked="checked"' : '';

$AutoQuests_MultipleChoise_yes = ($new['AutoQuests_MultipleChoise'] == 1) ? 'checked="checked"' : '';
$AutoQuests_MultipleChoise_no = ($new['AutoQuests_MultipleChoise'] == 0) ? 'checked="checked"' : '';

$show_counter_0 = ($new['show_counter'] == 0) ? 'checked="checked"' : '';
$show_counter_1 = ($new['show_counter'] == 1) ? 'checked="checked"' : '';
$show_counter_2 = ($new['show_counter'] == 2) ? 'checked="checked"' : '';
$show_counter_3 = ($new['show_counter'] == 3) ? 'checked="checked"' : '';

$multiimages_yes = ($new['multiimages'] == 1) ? 'checked="checked"' : '';
$multiimages_no = ($new['multiimages'] == 0) ? 'checked="checked"' : '';

if ($new['abq_variable_name'] != '')
{
	$abq_get_t2 = '';
	if (preg_match('/\A(fg|ih|zg)[0-9]{4}[0-9a-z]{0,5}\z/',$new['abq_variable_name']))
	{
		$abq_get_t1 = strval(substr($new['abq_variable_name'],0,2));
		$abq_get_z1 = strval(substr($new['abq_variable_name'],2,1));
		$abq_get_z2 = strval(substr($new['abq_variable_name'],3,1));
		$abq_get_z3 = strval(substr($new['abq_variable_name'],4,1));
		$abq_get_z4 = strval(substr($new['abq_variable_name'],5,1));
		if (strlen($new['abq_variable_name']) > 6)
		{
			$abq_get_t2 = strval(substr($new['abq_variable_name'],6));
		}
	}
	elseif (preg_match('/\A(bfj|g_e|www|xwe|xxx)[0-9]{4}[0-9a-z]{0,5}\z/',$new['abq_variable_name']))
	{
		$abq_get_t1 = strval(substr($new['abq_variable_name'],0,3));
		$abq_get_z1 = strval(substr($new['abq_variable_name'],3,1));
		$abq_get_z2 = strval(substr($new['abq_variable_name'],4,1));
		$abq_get_z3 = strval(substr($new['abq_variable_name'],5,1));
		$abq_get_z4 = strval(substr($new['abq_variable_name'],6,1));
		if (strlen($new['abq_variable_name']) > 7)
		{
			$abq_get_t2 = strval(substr($new['abq_variable_name'],7));
		}
	}
	elseif (preg_match('/\A(abq_|home|name|sfhf|www_)[0-9]{4}[0-9a-z]{0,5}\z/',$new['abq_variable_name']))
	{
		$abq_get_t1 = strval(substr($new['abq_variable_name'],0,4));
		$abq_get_z1 = strval(substr($new['abq_variable_name'],4,1));
		$abq_get_z2 = strval(substr($new['abq_variable_name'],5,1));
		$abq_get_z3 = strval(substr($new['abq_variable_name'],6,1));
		$abq_get_z4 = strval(substr($new['abq_variable_name'],7,1));
		if (strlen($new['abq_variable_name']) > 8)
		{
			$abq_get_t2 = strval(substr($new['abq_variable_name'],8));
		}
	}
	elseif (preg_match('/\A(email|ldknf|name_|rgwsf)[0-9]{4}[0-9a-z]{0,5}\z/',$new['abq_variable_name']))
	{
		$abq_get_t1 = strval(substr($new['abq_variable_name'],0,5));
		$abq_get_z1 = strval(substr($new['abq_variable_name'],5,1));
		$abq_get_z2 = strval(substr($new['abq_variable_name'],6,1));
		$abq_get_z3 = strval(substr($new['abq_variable_name'],7,1));
		$abq_get_z4 = strval(substr($new['abq_variable_name'],8,1));
		if (strlen($new['abq_variable_name']) > 9)
		{
			$abq_get_t2 = strval(substr($new['abq_variable_name'],9));
		}
	}
	else
	{
		$new['abq_variable_name'] = '';
	}
}
if ($new['abq_variable_name'] == '')
{
	$new['abq_variable_name'] = 'abq_0001';
	$abq_get_t1 = 'abq_';
	$abq_get_t2 = '';
	$abq_get_z1 = '0';
	$abq_get_z2 = '0';
	$abq_get_z3 = '0';
	$abq_get_z4 = '1';
}

$abq_get_A1 = array();
$abq_get_A1[] = 'abq_';
$abq_get_A1[] = 'bfj';
$abq_get_A1[] = 'email';
$abq_get_A1[] = 'fg';
$abq_get_A1[] = 'g_e';
$abq_get_A1[] = 'home';
$abq_get_A1[] = 'ih';
$abq_get_A1[] = 'ldknf';
$abq_get_A1[] = 'name';
$abq_get_A1[] = 'name_';
$abq_get_A1[] = 'rgwsf';
$abq_get_A1[] = 'sfhf';
$abq_get_A1[] = 'www';
$abq_get_A1[] = 'www_';
$abq_get_A1[] = 'xwe';
$abq_get_A1[] = 'xxx';
$abq_get_A1[] = 'zg';
$abq_get_A2 = array();
$abq_get_A2[] = '';
$abq_get_A2[] = '001';
$abq_get_A2[] = '3567';
$abq_get_A2[] = '94859';
$abq_get_A2[] = 'abf';
$abq_get_A2[] = 'f';
$abq_get_A2[] = 'sfgr';
$abq_get_A2[] = 'uc';
$abq_get_A2[] = 'dsdvg';
$abq_variable_namepart1 = '';
for ($i=0; $i<count($abq_get_A1); $i++)
{
	if ($abq_get_A1[$i] == $abq_get_t1)
	{
		$abq_get_selected = ' selected="selected"';
	}
	else
	{
		$abq_get_selected = "";
	}
	$abq_variable_namepart1 .= '<option value="' . $abq_get_A1[$i] . '"' . $abq_get_selected . '>' . $abq_get_A1[$i] . '</option>';
}
$abq_variable_namepart2 = '';
for ($i=0; $i<10; $i++)
{
	if (strval($i) == $abq_get_z1)
	{
		$abq_get_selected = ' selected="selected"';
	}
	else
	{
		$abq_get_selected = "";
	}
	$abq_variable_namepart2 .= '<option value="' . $i . '"' . $abq_get_selected . '>' . $i . '</option>';
}
$abq_variable_namepart3 = '';
for ($i=0; $i<10; $i++)
{
	if (strval($i) == $abq_get_z2)
	{
		$abq_get_selected = ' selected="selected"';
	}
	else
	{
		$abq_get_selected = "";
	}
	$abq_variable_namepart3 .= '<option value="' . $i . '"' . $abq_get_selected . '>' . $i . '</option>';
}
$abq_variable_namepart4 = '';
for ($i=0; $i<10; $i++)
{
	if (strval($i) == $abq_get_z3)
	{
		$abq_get_selected = ' selected="selected"';
	}
	else
	{
		$abq_get_selected = "";
	}
	$abq_variable_namepart4 .= '<option value="' . $i . '"' . $abq_get_selected . '>' . $i . '</option>';
}
$abq_variable_namepart5 = '';
for ($i=0; $i<10; $i++)
{
	if (strval($i) == $abq_get_z4)
	{
		$abq_get_selected = ' selected="selected"';
	}
	else
	{
		$abq_get_selected = "";
	}
	$abq_variable_namepart5 .= '<option value="' . $i . '"' . $abq_get_selected . '>' . $i . '</option>';
}
$abq_variable_namepart6 = '';
for ($i=0; $i<count($abq_get_A2); $i++)
{
	if ($abq_get_A2[$i] == $abq_get_t2)
	{
		$abq_get_selected = ' selected="selected"';
	}
	else
	{
		$abq_get_selected = "";
	}
	$abq_variable_namepart6 .= '<option value="' . $abq_get_A2[$i] . '"' . $abq_get_selected . '>' . $abq_get_A2[$i] . '</option>';
}

$template->set_filenames(array(
	'body' => 'admin/abq_config_body.tpl')
);

if ($ABQ_GDLib_Version < 1)
{
	$template->assign_block_vars('switch_readonly1', array());
}
if (!$ABQ_FTLib_Version)
{
	$template->assign_block_vars('switch_readonly2', array());
}

$template->assign_vars(array(
	'U_CONFIG_ACTION' => append_sid("abq_config.$phpEx"), 
	'L_YES' => $lang['Yes'], 
	'L_NO' => $lang['No'], 
	'L_RAND' => $lang['ABQ_Randomly_Selected'], 
	'L_SUBMIT' => $lang['Submit'], 
	'L_RESET' => $lang['Reset'], 
	'L_CONFIGURATION_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['Configuration'], 
	'L_READONLY1' => (($ABQ_GDLib_Version < 1) ? ' *' : ''), 
	'L_READONLY1_EXPLAIN' => '* - ' . $lang['ABQ_ReadOnly1_Explain'], 
	'L_READONLY2' => ((!$ABQ_FTLib_Version) ? ' **' : ''), 
	'L_READONLY2_EXPLAIN' => '** - ' . $lang['ABQ_ReadOnly2_Explain'], 
	'L_ACTIVATE' => $lang['ABQ_EnableDisableABQ'], 
	'L_ACTIVATE_EXPLAIN' => $lang['ABQ_EnableDisableABQ_explain'], 
	'L_ANTI_BOT_QUEST_REGISTER' => $lang['ABQ_Register'], 
	'L_ANTI_BOT_QUEST_REGISTER_EXPLAIN' => $lang['ABQ_Register_explain'], 
	'L_ANTI_BOT_QUEST_CONFIRM' => ($board_config['enable_confirm']) ? '<br />'.$lang['ABQ_confirm_enabled'] : '', 
	'L_ANTI_BOT_QUEST_GUEST' => $lang['ABQ_Guest'], 
	'L_ANTI_BOT_QUEST_GUEST_EXPLAIN' => $lang['ABQ_Guest_explain'], 
	'S_ANTI_BOT_QUEST_REGISTER_ENABLE' => $abq_register_yes, 
	'S_ANTI_BOT_QUEST_REGISTER_DISABLE' => $abq_register_no, 
	'S_ANTI_BOT_QUEST_GUEST_ENABLE' => $abq_guest_yes, 
	'S_ANTI_BOT_QUEST_GUEST_DISABLE' => $abq_guest_no, 

	'L_GENERAL_SETTINGS' => $lang['ABQ_General_Config'], 
	'L_LOCKREGISTER' => $lang['ABQ_LockRegister'], 
	'L_LOCKREGISTER_EXPLAIN' => $lang['ABQ_LockRegister_explain'], 
	'L_LOCKGUESTPOSTS' => $lang['ABQ_LockGuestPosts'], 
	'L_LOCKGUESTPOSTS_EXPLAIN' => $lang['ABQ_LockGuestPosts_explain'], 
	'L_AGREEDVARIABLE_NAME' => $lang['ABQ_AgreedVariable_Name'], 
	'L_AGREEDVARIABLE_NAME_EXPLAIN' => $lang['ABQ_AgreedVariable_Name_explain'], 
	'L_AGREEDVARIABLE_VALUE' => $lang['ABQ_AgreedVariable_Value'], 
	'L_EMAILVARIABLE_NAME' => $lang['ABQ_RegistrationForm_Email_Name'], 
	'L_EMAILVARIABLE_NAME_EXPLAIN' => $lang['ABQ_RegistrationForm_Email_Name_explain'], 
	'L_ABQVARIABLE_NAME' => $lang['ABQ_ABQVariable_Name'], 
	'L_ABQVARIABLE_NAME_EXPLAIN' => $lang['ABQ_ABQVariable_Name_Explain'],
	'L_RATIO_AUTO_INDI_QUESTS' => $lang['ABQ_Ratio_Auto_Individual_Quests'], 
	'L_RATIO_AUTO_INDI_QUESTS_EXPLAIN' => $lang['ABQ_Ratio_Auto_Individual_Quests_Explain'], 
	'L_SHOW_COUNTER' => $lang['ABQ_Show_Counter'], 
	'L_SHOW_COUNTER_EXPLAIN' => $lang['ABQ_Show_Counter_Explain'], 
	'L_SHOW_COUNTER_1' => $lang['ABQ_Show_Counter_1'], 
	'L_SHOW_COUNTER_2' => $lang['ABQ_Show_Counter_2'], 
	'L_SHOW_COUNTER_3' => $lang['ABQ_Show_Counter_3'], 
	'L_SHOW_COUNTER_4' => $lang['ABQ_Show_Counter_4'], 
	'S_LOCKREGISTER' => $new['lockregister'], 
	'S_LOCKGUESTPOSTS' => $new['lockguestposts'], 
	'S_AGREEDVARIABLE_NAME' => $new['agreed_variable_name'], 
	'S_AGREEDVARIABLE_VALUE' => $new['agreed_variable_value'], 
	'S_EMAILVARIABLE_NAME' => $new['email_variable_name'], 
	'S_ABQVARIABLE_NAMEPART1' => $abq_variable_namepart1, 
	'S_ABQVARIABLE_NAMEPART2' => $abq_variable_namepart2, 
	'S_ABQVARIABLE_NAMEPART3' => $abq_variable_namepart3, 
	'S_ABQVARIABLE_NAMEPART4' => $abq_variable_namepart4, 
	'S_ABQVARIABLE_NAMEPART5' => $abq_variable_namepart5, 
	'S_ABQVARIABLE_NAMEPART6' => $abq_variable_namepart6,
	'S_RATIO_AUTO_INDI_QUESTS' => $new['Ratio_Auto_Indi_Questions'], 
	'S_SHOW_COUNTER_1' => $show_counter_0, 
	'S_SHOW_COUNTER_2' => $show_counter_1, 
	'S_SHOW_COUNTER_3' => $show_counter_2, 
	'S_SHOW_COUNTER_4' => $show_counter_3, 

	'L_INDIVIDUELQUESTS_SETTINGS' => $lang['ABQ_Individual_Quest_Config'], 
	'L_INDIVIDUELQUESTS_SETTINGS_EXPLAIN' => $lang['ABQ_Individual_Quest_Config_explain'], 
	'L_INDIVIDUELQUESTS' => $lang['ABQ_Enable_Individual_Quests'],
	'L_INDIVIDUELQUESTS_EXPLAIN' => $lang['ABQ_Enable_Individual_Quests_Explain'],
	'L_CASESENSITIVE' => $lang['ABQ_CaseSensitive'],
	'L_CASESENSITIVE_EXPLAIN' => $lang['ABQ_CaseSensitive_Explain'],
	'S_INDIVIDUELQUESTS_ENABLE' => $ef_yes, 
	'S_INDIVIDUELQUESTS_DISABLE' => $ef_no, 
	'S_CASESENSITIVE_ENABLE' => $efcasesen_yes, 
	'S_CASESENSITIVE_DISABLE' => $efcasesen_no, 

	'L_INDIQUESTSTYPE1_SETTINGS' => $lang['ABQ_IndiQuestsType1_Config'], 
	'L_INDIQUESTSTYPE1_SETTINGS_EXPLAIN' => $lang['ABQ_IndiQuestsType1_Config_explain'], 
	'L_IMAGEPHP' => $lang['ABQ_ImagePHP'], 
	'L_IMAGEPHP_EXPLAIN' => sprintf($lang['ABQ_ImagePHP_Explain'], '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=test') . '" width="60" height="30" alt="" />'), 
	'S_IMAGEPHP_ENABLE' => $bildphp_yes, 
	'S_IMAGEPHP_DISABLE' => $bildphp_no, 

	'L_AUTOQUESTS_SETTINGS' => $lang['ABQ_AutoQuest_Config'], 
	'L_AUTOQUESTS_SETTINGS_EXPLAIN' => $lang['ABQ_AutoQuest_Config_explain'], 
	'L_AUTOQUESTS_LARGENUMBERS' => $lang['ABQ_LargeNumbers'], 
	'L_AUTOQUESTS_LARGENUMBERS_EXPLAIN' => $lang['ABQ_LargeNumbers_Explain'], 
	'L_AUTOQUESTS_MULTIPLICATION' => $lang['ABQ_Multiplication_Symbol'], 
	'L_AUTOQUESTS_MULTIPLICATION_EXPLAIN' => $lang['ABQ_Multiplication_Symbol_Explain'], 
	'L_AUTOQUESTS_MULTIPLECHOISE' => $lang['ABQ_AutoQuests_MultipleChoice'], 
	'L_AUTOQUESTS_MULTIPLECHOISE_EXPLAIN' => $lang['ABQ_AutoQuests_MultipleChoice_Explain'], 
	'S_AUTOQUESTS_LARGENUMBERS_ENABLE' => $AutoQuests_LargeNumbers_yes, 
	'S_AUTOQUESTS_LARGENUMBERS_DISABLE' => $AutoQuests_LargeNumbers_no, 
	'S_AUTOQUESTS_LARGENUMBERS_RAND' => $AutoQuests_LargeNumbers_rand, 
	'S_AUTOQUESTS_MULTIPLICATION_1' => $AutoQuests_MultiplicationSymbol_1, 
	'S_AUTOQUESTS_MULTIPLICATION_2' => $AutoQuests_MultiplicationSymbol_2, 
	'S_AUTOQUESTS_MULTIPLICATION_3' => $AutoQuests_MultiplicationSymbol_3, 
	'S_AUTOQUESTS_MULTIPLECHOISE_ENABLE' => $AutoQuests_MultipleChoise_yes, 
	'S_AUTOQUESTS_MULTIPLECHOISE_DISABLE' => $AutoQuests_MultipleChoise_no, 

	'L_INDI_AUTO_QUESTS_SETTINGS' => $lang['ABQ_IndiQuests_AutoQuests_Config'], 
	'L_INDI_AUTO_QUESTS_SETTINGS_EXPLAIN' => sprintf($lang['ABQ_IndiQuests_AutoQuests_Config_explain'], (($ABQ_GDLib_Version > 0) ? $lang['ABQ_installed'] : '<b>' . $lang['ABQ_not_installed'] . '</b>'), (($ABQ_FTLib_Version) ? $lang['ABQ_installed'] : '<b>' . $lang['ABQ_not_installed'] . '</b>')) . (($ABQ_FTLib_Version) ? '' : '<br />' . ($lang['ABQ_IndiQuests_AutoQuests_Config_explain2'] . '<br /><img src="' . $phpbb_root_path . 'images/abq_mod/admin/001a.jpg" alt="' . $lang['ABQ_IndiQuests_AutoQuests_Config_explain2'] . '" /><br clear="all" />' . $lang['ABQ_IndiQuests_AutoQuests_Config_explain3'] . ':<br /><img src="' . $phpbb_root_path . 'images/abq_mod/admin/001.jpg" alt="' . $lang['ABQ_IndiQuests_AutoQuests_Config_explain3'] . '" />')), 
	'L_IMAGEFORMAT' => $lang['ABQ_ImageFormat'], 
	'L_IMAGEFORMAT_EXPLAIN' => $lang['ABQ_ImageFormat_Explain'], 
	'L_JPG' => $lang['ABQ_JPG'], 
	'L_PNG' => $lang['ABQ_PNG'], 
	'L_JPGQUALITY' => $lang['ABQ_JPGQuality'], 
	'L_JPGQUALITY_EXPLAIN' => $lang['ABQ_JPGQuality_Explain'], 
	'L_MULTIIMAGES' => $lang['ABQ_Multiimages'], 
	'L_MULTIIMAGES_EXPLAIN' => $lang['ABQ_Multiimages_Explain'], 
	'L_FONTSIZE' => $lang['ABQ_Fontsize'], 
	'L_FONTSIZE_EXPLAIN' => $lang['ABQ_Fontsize_Explain'], 
	'L_MAX_EFFECTS' => $lang['ABQ_Max_Effects'], 
	'L_MAX_EFFECTS_EXPLAIN' => $lang['ABQ_Max_Effects_explain'], 
	'L_EFF_SEPARATINGLINES' => $lang['ABQ_Effect_SeparatingLines'], 
	'L_EFF_SEPARATINGLINES_EXPLAIN' => $lang['ABQ_Effect_SeparatingLines_explain'] . '<br /><a href="' . $phpbb_root_path . 'images/abq_mod/admin/001' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'L_EFF_BGTEXT' => $lang['ABQ_Effect_BackgroundText'], 
	'L_EFF_BGTEXT_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/002' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'L_EFF_GRID' => $lang['ABQ_Effect_Grid'], 
	'L_EFF_GRID_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/003' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'L_EFF_GRIDWIDTH' => $lang['ABQ_Effect_GridWidth'], 
	'L_EFF_GRIDWIDTH_EXPLAIN' => $lang['ABQ_Effect_GridWidth_explain'], 
	'L_EFF_GRIDHEIGHT' => $lang['ABQ_Effect_GridHeight'], 
	'L_EFF_GRIDHEIGHT_EXPLAIN' => $lang['ABQ_Effect_GridHeight_explain'], 
	'L_EFF_FILLEDGRID' => $lang['ABQ_Effect_FilledGrid'], 
	'L_EFF_FILLEDGRID_EXPLAIN' => $lang['ABQ_Effect_FilledGrid_explain'] . '<br /><a href="' . $phpbb_root_path . 'images/abq_mod/admin/004' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'L_EFF_ELLIPSES' => $lang['ABQ_Effect_Ellipses'], 
	'L_EFF_ELLIPSES_EXPLAIN' => ((!$ABQ_Elip_JN) ? '<b>' : '') . sprintf($lang['ABQ_Effect_Ellipses_explain'], $ABQ_PHP_Version[0].'.'.$ABQ_PHP_Version[1].'.'.$ABQ_PHP_Version[2]) . ((!$ABQ_Elip_JN) ? '</b>' : '') . '<br /><a href="' . $phpbb_root_path . 'images/abq_mod/admin/005' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'L_EFF_ARCS' => $lang['ABQ_Effect_Arcs'], 
	'L_EFF_ARCS_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/006' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'L_EFF_LINES' => $lang['ABQ_Effect_Lines'], 
	'L_EFF_LINES_EXPLAIN' => '<a href="' . $phpbb_root_path . 'images/abq_mod/admin/007' . (($ABQ_FTLib_Version) ? '' : 'a') . '.jpg" title="' . $lang['ABQ_Example'] . '" target="_blank">' . $lang['ABQ_Example'] . '</a>', 
	'S_IMAGEFORMAT_JPG' => $af_ImageFormat_JPG, 
	'S_IMAGEFORMAT_PNG' => $af_ImageFormat_PNG, 
	'S_JPGQUALITY_VALUE' => $new['JPG_Quality'], 
	'S_MULTIIMAGES_ENABLE' => $multiimages_yes, 
	'S_MULTIIMAGES_DISABLE' => $multiimages_no, 
	'S_FONTSIZE_VALUE' => $new['fontsize'], 
	'S_MAX_EFFECTS_VALUE' => $new['max_Effects'], 
	'S_EFF_SEPARATINGLINES_ENABLE' => $Effect_SeparatingLines_yes, 
	'S_EFF_SEPARATINGLINES_DISABLE' => $Effect_SeparatingLines_no, 
	'S_EFF_BGTEXT_ENABLE' => $Effect_BGText_yes, 
	'S_EFF_BGTEXT_DISABLE' => $Effect_BGText_no, 
	'S_EFF_BGTEXT_RAND' => $Effect_BGText_rand, 
	'S_EFF_GRID_ENABLE' => $Effect_Grid_yes, 
	'S_EFF_GRID_DISABLE' => $Effect_Grid_no, 
	'S_EFF_GRID_RAND' => $Effect_Grid_rand, 
	'S_EFF_GRIDWIDTH_VALUE' => $new['Effect_GridWidth'], 
	'S_EFF_GRIDHEIGHT_VALUE' => $new['Effect_GridHeight'], 
	'S_EFF_FILLEDGRID_ENABLE' => $Effect_FilledGrid_yes, 
	'S_EFF_FILLEDGRID_DISABLE' => $Effect_FilledGrid_no, 
	'S_EFF_FILLEDGRID_RAND' => $Effect_FilledGrid_rand, 
	'S_EFF_ELLIPSES_ENABLE' => $Effect_Ellipses_yes, 
	'S_EFF_ELLIPSES_DISABLE' => $Effect_Ellipses_no, 
	'S_EFF_ELLIPSES_RAND' => $Effect_Ellipses_rand, 
	'S_EFF_ARCS_ENABLE' => $Effect_Arcs_yes, 
	'S_EFF_ARCS_DISABLE' => $Effect_Arcs_no, 
	'S_EFF_ARCS_RAND' => $Effect_Arcs_rand, 
	'S_EFF_LINES_ENABLE' => $Effect_Lines_yes, 
	'S_EFF_LINES_DISABLE' => $Effect_Lines_no, 
	'S_EFF_LINES_RAND' => $Effect_Lines_rand, 

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