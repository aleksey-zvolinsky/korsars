<?php
/***************************************************************************
 *                          abq_fonts.php
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
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'includes/functions_abq.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq_admin.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq.' . $phpEx);

$ABQ_PHP_Version = array();
$ABQ_FTLib_Version = 0;
$ABQ_GDLib_Version = 0;
ABQ_gdVersion();

$MaxFontFileSize = 102400;

$Schriften = array();
$Schriften_AAnzahl = 0;
if ($Schriftverzeichnis = @opendir($phpbb_root_path.'abq_mod/fonts/'))
{
	while (true == ($Dateien = @readdir($Schriftverzeichnis)))
	{
		if ((substr(strtolower($Dateien), -4) == '.ttf'))
		{
			$Schriften[] = substr($Dateien, 0, (strlen($Dateien)-4));
			$SchriftenDatei[] = $Dateien;
		}
	}
	closedir($Schriftverzeichnis);
	sort($Schriften);
	sort($SchriftenDatei);
	$Schriften_AAnzahl = count($Schriften);
}

if (!isset($HTTP_POST_VARS['mode']))
{
	if (!isset($HTTP_GET_VARS['mode']))
	{
		$template->set_filenames(array(
			'body' => 'admin/abq_fonts_body.tpl')
		);

		$template->assign_vars(array(
			'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_FontAdmin_Title'], 
			'L_ABQ_EXPLAIN' => sprintf($lang['ABQ_FontAdmin_Explain'], (($ABQ_GDLib_Version > 0) ? $lang['ABQ_installed'] : '<b>' . $lang['ABQ_not_installed'] . '</b>'), (($ABQ_FTLib_Version) ? $lang['ABQ_installed'] : '<b>' . $lang['ABQ_not_installed'] . '</b>')), 
			'L_ABQ_FONT' => $lang['ABQ_Font'], 
			'L_UPLOAD_NEW_FONT' => $lang['ABQ_Upload_New_Font'], 
			'L_ACTION' => $lang['Action'], 
			'L_EXAMPLE' => $lang['ABQ_Example'], 

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
			'L_ABQ_VERSION' => $lang['ABQ_Version'], 
			'U_ABQ_ACTION' => append_sid('abq_fonts.'.$phpEx))
		);

		if ($Schriften_AAnzahl > 0)
		{
			$BenSchriftFehlt = 1;
			unset($i);
			for ($i=0; $i<$Schriften_AAnzahl; $i++)
			{
				$template->assign_block_vars('fonts', array(
					'COLOR' => ($i % 2) ? 'row1' : 'row2', 
					'FONT' => $Schriften[$i], 
					'U_EXAMPLE_ACTION' => append_sid('abq_fonts.'.$phpEx.'?mode=example&amp;id='.($i+1)), 
					'U_DELETE_ACTION' => (($Schriften[$i] == 'do-not-delete') ? '-' : '<a href="' . append_sid('abq_fonts.'.$phpEx.'?mode=delete&amp;id='.($i+1)) . '" title="' . $lang['Delete'] . '">' . $lang['Delete'] . '</a>')
					)
				);
				if ($Schriften[$i] == 'do-not-delete')
				{
					$BenSchriftFehlt = 0;
				}
			}
			if ($BenSchriftFehlt)
			{
				$template->assign_block_vars('switch_font_missing', array()); 
				$template->assign_vars(array(
					'L_ABQ_FONT_MISSING' => $lang['ABQ_Error_font_missing'])
				);

			}
		}
		else
		{
			$template->assign_block_vars('switch_no_fonts', array()); 
			$template->assign_vars(array(
				'L_ABQ_NO_FONTS' => $lang['ABQ_Error_no_fonts'])
			);
		}

		$template->pparse('body');

		include('./page_footer_admin.'.$phpEx);
	}
	else
	{
		if ($HTTP_GET_VARS['mode'] == 'example')
		{
			$schrift_id = intval($HTTP_GET_VARS['id']);

			$template->set_filenames(array(
				'body' => 'admin/abq_fonts_example_body.tpl')
			);

			$template->assign_vars(array(
				'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_FontAdmin_Example'], 
				'L_ABQ_EXPLAIN' => $lang['ABQ_FontAdmin_Example_Explain'], 
				'L_ABQ_FONT' => $lang['ABQ_Font'], 
				'L_EXAMPLE' => $lang['ABQ_Example'], 
				'L_NOTE' => $lang['ABQ_Font_Characters'], 
				'LINE1' => 'a b d e f g h j m n p q r t x y', 
				'LINE2' => 'A B D E F G H J M N P Q R T U V W X Y Z', 
				'LINE3' => '1 2 3 4 5 6 7 8 9 0', 
				'LINE4' => '% = + - * / ( ) : ; . , ! ?', 

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

			if (($schrift_id < 1) || ($schrift_id > $Schriften_AAnzahl))
			{
				$template->assign_block_vars('switch_unknown_font', array()); 
				$template->assign_vars(array(
					'L_ABQ_UNKNOWN_FONT' => $lang['ABQ_unknown_font'])
				);
			}
			elseif ((!$ABQ_FTLib_Version) || ($ABQ_GDLib_Version < 1))
			{
				$template->assign_block_vars('switch_gd_ft_not_installed', array()); 
				$template->assign_vars(array(
					'L_GD_FT_NOT_INSTALLED' => $lang['ABQ_GD_FT_NotInstalled'])
				);
			}
			else
			{
				$template->assign_block_vars('switch_example', array()); 
				$template->assign_vars(array(
					'FONT' => $Schriften[($schrift_id - 1)],
					'EXAMPLE' => '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?id=' . $schrift_id) . '" alt="' . $lang['ABQ_Example'] . ': ' . $Schriften[($schrift_id - 1)] . '" />')
				);
			}

			$template->pparse('body');

			include('./page_footer_admin.'.$phpEx);
		}
		elseif ($HTTP_GET_VARS['mode'] == 'delete')
		{
			$schrift_id = intval($HTTP_GET_VARS['id']);

			$template->set_filenames(array(
				'body' => 'admin/abq_fonts_delete_body.tpl')
			);

			$template->assign_vars(array(
				'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_FontAdmin_Delete'], 
				'L_ABQ_EXPLAIN' => sprintf($lang['ABQ_FontAdmin_Delete_Explain'], $lang['ABQ_FontAdmin_Delete_Explain2']), 
				'L_ABQ_EXPLAIN2' => $lang['ABQ_FontAdmin_Delete_Explain2'], 
				'L_ABQ_FONT' => $lang['ABQ_Font'], 
				'L_ACTION' => $lang['Action'], 
				'L_DELETE' => $lang['Delete'], 
				'U_DELETE_ACTION' => append_sid('abq_fonts.'.$phpEx),
				'S_FONTID' =>  $schrift_id, 

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

			if (($schrift_id < 1) || ($schrift_id > $Schriften_AAnzahl))
			{
				$template->assign_block_vars('switch_unknown_font', array()); 
				$template->assign_vars(array(
					'L_ABQ_UNKNOWN_FONT' => $lang['ABQ_unknown_font'])
				);
			}
			elseif ($Schriften[($schrift_id - 1)] == 'do-not-delete')
			{
				$template->assign_block_vars('switch_dont_delete_font', array()); 
				$template->assign_vars(array(
					'L_ABQ_DONT_DELETE_FONT' => $lang['ABQ_dont_delete_font'])
				);
			}
			else
			{
				$template->assign_block_vars('switch_delete', array()); 
				$template->assign_vars(array(
					'FONT' => $Schriften[($schrift_id - 1)])
				);
			}

			$template->pparse('body');

			include('./page_footer_admin.'.$phpEx);
		}
	}
}
elseif ($HTTP_POST_VARS['mode'] == 'delete')
{
	$schrift_id = intval($HTTP_POST_VARS['id']);
	$schrift_name = preg_replace('/[^a-zA-Z0-9_-]/', '', $HTTP_POST_VARS['name']);
	if (($schrift_name != $HTTP_POST_VARS['name']) || ($Schriften[($schrift_id - 1)] != $schrift_name))
	{
		$schrift_name == '';
	}

	if (($schrift_id < 1) || ($schrift_id > $Schriften_AAnzahl) || ($schrift_name == ''))
	{
		$message = $lang['ABQ_unknown_font'] . '<br /><br />' . sprintf($lang['ABQ_Click_return_Fonts'], '<a href="' . append_sid('abq_fonts.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	elseif ($Schriften[($schrift_id - 1)] == 'do-not-delete')
	{
		$message = $lang['ABQ_dont_delete_font'] . '<br /><br />' . sprintf($lang['ABQ_Click_return_Fonts'], '<a href="' . append_sid('abq_fonts.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}

	if (@file_exists(@phpbb_realpath($phpbb_root_path . 'abq_mod/fonts/' . $SchriftenDatei[($schrift_id - 1)])))
	{
		if (@unlink($phpbb_root_path . 'abq_mod/fonts/' . $SchriftenDatei[($schrift_id - 1)]))
		{
			$message = $lang['ABQ_delete_Font_ok'] . '<br /><br />' . sprintf($lang['ABQ_Click_return_Fonts'], '<a href="' . append_sid('abq_fonts.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$message = $lang['ABQ_Error_Font_not_deleted'];
			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else
	{
		$message = $lang['ABQ_unknown_font'];
		message_die(GENERAL_MESSAGE, $message);
	}
}
elseif ($HTTP_POST_VARS['mode'] == 'new')
{
	$template->set_filenames(array(
		'body' => 'admin/abq_fonts_upload_body.tpl')
	);

	$template->assign_vars(array(
		'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_FontAdmin_Upload'], 
		'L_ABQ_EXPLAIN' => sprintf($lang['ABQ_FontAdmin_Upload_Explain'], round($MaxFontFileSize / 1024)) . $lang['ABQ_FontAdmin_Upload_FontFile_Explain'], 
		'L_ABQ_FONT' => $lang['ABQ_Font'], 
		'L_FILELOCATION' => $lang['ABQ_File'], 
		'L_UPLOAD_FONT_FILE' => $lang['ABQ_FontAdmin_Upload_FontFile'], 
		'L_UPLOAD_FONT_FILE_EXPLAIN' => $lang['ABQ_FontAdmin_Upload_FontFile_Explain'], 
		'S_FONT_MAXSIZE' => $MaxFontFileSize, 
		'L_UPLOAD' => $lang['ABQ_Upload_New_Font'], 
		'U_UPLOAD_ACTION' => append_sid('abq_fonts.'.$phpEx),

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
}
elseif ($HTTP_POST_VARS['mode'] == 'upload')
{
	include($phpbb_root_path . 'includes/functions_abq_upload.'.$phpEx);

	$FontFile_TmpName = ($HTTP_POST_FILES['fontfile']['tmp_name'] != 'none') ? $HTTP_POST_FILES['fontfile']['tmp_name'] : '';
	$FontFile_Name = (!empty($HTTP_POST_FILES['fontfile']['name']) ) ? $HTTP_POST_FILES['fontfile']['name'] : '';
	$FontFile_Size = (!empty($HTTP_POST_FILES['fontfile']['size']) ) ? (($HTTP_POST_FILES['fontfile']['size'] > $MaxFontFileSize) ? 0 : $HTTP_POST_FILES['fontfile']['size']) : 0;
	$FontFile_Filetype = (!empty($HTTP_POST_FILES['fontfile']['type']) ) ? $HTTP_POST_FILES['fontfile']['type'] : '';

	if ((!empty($FontFile_TmpName)) && (!empty($FontFile_Size)) && (!empty($FontFile_Name)))
	{
		if (!preg_match('/^[a-z0-9_-]+\.[a-z]{3,4}$/i', $FontFile_Name))
		{
			$FontFile_Name = preg_replace('#^.*/([a-z0-9_-]+\.[a-z]{3,4})$#i', '\1', $FontFile_Name);
		}
		if (!preg_match('/^[a-z0-9_-]+\.[a-z]{3,4}$/i', $FontFile_Name))
		{
			$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . $lang['ABQ_Error_upload_invalid_Filename'];
			message_die(GENERAL_MESSAGE, $message);
		}
		$FontFile_Name = strtolower($FontFile_Name);
		abq_upload('Font', $FontFile_TmpName, $FontFile_Name, $FontFile_Size, $FontFile_Filetype);
	}
	elseif (!empty($FontFile_Name))
	{
		$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . sprintf($lang['ABQ_Error_Fontupload_Filesize'], round($MaxFontFileSize / 1024));
		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . $lang['ABQ_Error_upload_no_File'];
		message_die(GENERAL_MESSAGE, $message);
	}
}
?>