<?php
/***************************************************************************
 *                          abq_indig_quests.php
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
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
include($phpbb_root_path . 'includes/functions_abq.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq_admin.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_abq.' . $phpEx);

$ABQ_Question_Maxlenght = 250;
$ABQ_Answer_Maxlenght = 250;

$ABQ_PHP_Version = array();
$ABQ_FTLib_Version = 0;
$ABQ_GDLib_Version = 0;
ABQ_gdVersion();

if (!isset($HTTP_POST_VARS['mode']))
{
	if (!isset($HTTP_GET_VARS['action']))
	{
		$template->set_filenames(array(
			'body' => 'admin/abq_indig_quests_body.tpl')
		);

		$template->assign_vars(array(
			'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . sprintf($lang['ABQ_Admin_Title'], 2),
			'L_ABQ_EXPLAIN' => sprintf($lang['ABQ_Admin_Explain_Type2'], (($ABQ_GDLib_Version < 1) ? $lang['ABQ_not_installed'] : $lang['ABQ_installed'])),
			'L_ABQ_ANSWER' => $lang['ABQ_Answer'],
			'L_ABQ_MCQ' => $lang['ABQ_MCQ'], 
			'L_CREATE_QUESTION' => $lang['ABQ_Create_Question'], 
			'L_EDIT' => $lang['Edit'],
			'L_DELETE' => $lang['Delete'],
			'L_ACTION' => $lang['Action'],
			'L_BOARD_LANGUAGE' => $lang['Board_lang'],

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
			'U_ABQ_ACTION' => append_sid('abq_indig_quests.'.$phpEx))
		);

		$sql = 'SELECT *
			FROM ' . ANTI_BOT_QUEST_TABLE . '
			WHERE imagequestion = \'G\'
			ORDER BY lang ASC, question ASC';
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not query anti-bot-question information', '', __LINE__, __FILE__, $sql);
		}
		while ($row = $db->sql_fetchrow($result))
		{
			$abqrow[] = $row;
		}

		$abq_count = count($abqrow);
		if ($abq_count > 0)
		{
			for ($i=0; $i<$abq_count; $i++)
			{
				$abq_question = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $abqrow[$i]['question']);

				$abq_aw = $abqrow[$i]['answer1'];
				if ($abqrow[$i]['answer2'] != '')
				{
					$abq_aw = 'A) ' . $abq_aw . '<br />B) ' . $abqrow[$i]['answer2'] . '<br />';
				}
				if ($abqrow[$i]['answer3'] != '')
				{
					$abq_aw .= 'C) ' . $abqrow[$i]['answer3'] . '<br />';
				}
				if ($abqrow[$i]['answer4'] != '')
				{
					$abq_aw .= 'D) ' . $abqrow[$i]['answer4'] . '<br />';
				}
				if ($abqrow[$i]['answer5'] != '')
				{
					$abq_aw .= 'E) ' . $abqrow[$i]['answer5'] . '<br />';
				}

				$template->assign_block_vars('abqrow', array(
					'COLOR' => ($i % 2) ? 'row1' : 'row2',
					'QUESTION' => $abq_question,
					'ANSWER' => $abq_aw,
					'ANTI_BOT_IMG' => $abqrow[$i]['anti_bot_img'],
					'MCQ' => (($abqrow[$i]['wronganswer10'] != '') ? $lang['Yes'] : $lang['No']), 
					'LANGUAGE' => $abqrow[$i]['lang'],
					'U_EDIT_ACTION' => append_sid('abq_indig_quests.'.$phpEx.'?action=edit&amp;id=' . $abqrow[$i]['id']),
					'U_DELETE_ACTION' => append_sid('abq_indig_quests.'.$phpEx.'?action=delete&amp;id=' . $abqrow[$i]['id'])
					)
				);
			}
		}
		else
		{
			$template->assign_block_vars('switch_no_questions', array()); 
			$template->assign_vars(array(
				'L_ABQ_NO_QUESTION' => sprintf($lang['ABQ_No_questions'], 2))
			);
		}

		$template->pparse('body');

		include('./page_footer_admin.'.$phpEx);
	}
	else
	{
		if ($HTTP_GET_VARS['action'] == 'edit')
		{
			$abq_id = intval($HTTP_GET_VARS['id']);
			$sql = 'SELECT *
				FROM ' . ANTI_BOT_QUEST_TABLE . '
				WHERE id = ' . $abq_id . ' AND imagequestion = \'G\'';
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not anti-bot-question information', '', __LINE__, __FILE__, $sql);
			}
			if( $db->sql_numrows($result) == 0 )
			{
				message_die(GENERAL_ERROR, 'The requested anti-bot-question does not exist');
			}
			$abqrow = $db->sql_fetchrow($result);

			$template->set_filenames(array(
				'body' => 'admin/abq_indig_quests_edit_body.tpl')
			);

			$template->assign_vars(array(
				'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . sprintf($lang['ABQ_Admin_Title'], 2),
				'L_ABQ_EXPLAIN' => $lang['ABQ_Admin_Explain'],
				'L_PANEL_TITLE' => $lang['ABQ_Edit_Question'],
				'L_QUESTION' => $lang['ABQ_Question'],
				'L_QUESTION_EXPLAIN' => $lang['ABQ_IQ_T2_Explain'],
				'L_ANSWER_CORRECT' => $lang['ABQ_Answer'],
				'L_ANSWER_CORRECT_EXPLAIN' => ($abq_config['IndiQuests_CaseSensitive']) ? '<br />'.$lang['ABQ_Answer_Explain'] : '',
				'L_ITEMS_REQUIRED' => $lang['Items_required'], 
				'L_ANSWER_WRONG' => $lang['ABQ_Answer_wrong'],
				'L_ANSWER_INFO1' => $lang['ABQ_IQ_MC_Info1'],
				'L_ANSWER_INFO1A' => $lang['ABQ_IQ_MC_Info1a'],
				'L_ANSWER_INFO2' => $lang['ABQ_IQ_MC_Info2'],
				'L_ANSWER_INFO2A' => $lang['ABQ_IQ_MC_Info2a'],
				'L_ANSWER_INFO3' => $lang['ABQ_IQ_MC_Info3'],
				'S_MLENGTH_Q' => $ABQ_Question_Maxlenght,
				'S_ANSWER_MAXLENGTH' => $ABQ_Answer_Maxlenght,
				'L_BOARD_LANGUAGE' => $lang['Board_lang'], 
				'S_QUESTION' => $abqrow['question'],
				'S_ANSWER1' => $abqrow['answer1'],
				'S_ANSWER2' => $abqrow['answer2'],
				'S_ANSWER3' => $abqrow['answer3'],
				'S_ANSWER4' => $abqrow['answer4'],
				'S_ANSWER5' => $abqrow['answer5'],
				'S_WRONGANSWER01' => $abqrow['wronganswer01'],
				'S_WRONGANSWER02' => $abqrow['wronganswer02'],
				'S_WRONGANSWER03' => $abqrow['wronganswer03'],
				'S_WRONGANSWER04' => $abqrow['wronganswer04'],
				'S_WRONGANSWER05' => $abqrow['wronganswer05'],
				'S_WRONGANSWER06' => $abqrow['wronganswer06'],
				'S_WRONGANSWER07' => $abqrow['wronganswer07'],
				'S_WRONGANSWER08' => $abqrow['wronganswer08'],
				'S_WRONGANSWER09' => $abqrow['wronganswer09'],
				'S_WRONGANSWER10' => $abqrow['wronganswer10'],
				'S_MODE' => 'edit',
				'S_LANGUAGE' => language_select($abqrow['lang'], 'language'),

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
				'U_ABQ_ACTION' => append_sid('abq_indig_quests.'.$phpEx.'?eid='.$abq_id))
			);

			$template->pparse('body');

			include('./page_footer_admin.'.$phpEx);
		}
		elseif ($HTTP_GET_VARS['action'] == 'delete')
		{
			$abq_id = intval($HTTP_GET_VARS['id']);
			$sql = 'SELECT *
				FROM ' . ANTI_BOT_QUEST_TABLE . '
				WHERE id = ' . $abq_id . ' AND imagequestion = \'G\'';
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not anti-bot-question information', '', __LINE__, __FILE__, $sql);
			}
			if( $db->sql_numrows($result) == 0 )
			{
				message_die(GENERAL_ERROR, 'The requested anti-bot-question does not exist');
			}
			$abqrow = $db->sql_fetchrow($result);

			$template->set_filenames(array(
				'body' => 'admin/abq_indig_quests_delete_body.tpl')
			);

			$template->assign_vars(array(
				'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . $lang['ABQ_Delete_Title'], 
				'L_ABQ_EXPLAIN' => $lang['ABQ_Admin_Explain'], 
				'L_PANEL_TITLE' => $lang['ABQ_Delete_Question'], 
				'L_QUESTION' => $lang['ABQ_Question'], 
				'L_ANTI_BOT_IMG' => $lang['ABQ_ImageURL'], 
				'L_ANTI_BOT_IMG_EXPLAIN' => (($abq_img == '') ? '' : $lang['ABQ_ImageURL_DelExplain']), 
				'L_ABQ_MCQ' => $lang['ABQ_MCQ'], 
				'L_ANSWER_CORRECT' => $lang['ABQ_Answer'], 
				'L_ANSWER_CORRECT_EXPLAIN' => (($abq_config['IndiQuests_CaseSensitive']) && ($abqrow['wronganswer01'] == '')) ? '<br />'.$lang['ABQ_Answer_Explain'] : '', 
				'L_ANSWER_WRONG' => $lang['ABQ_Answer_wrong'],
				'L_BOARD_LANGUAGE' => $lang['Board_lang'], 
				'S_QUESTION' => $abqrow['question'], 
				'S_MCQ' => (($abqrow['wronganswer10'] != '') ? $lang['Yes'] : $lang['No']), 
				'S_ANSWER1' => $abqrow['answer1'], 
				'S_ANSWER2' => $abqrow['answer2'], 
				'S_ANSWER3' => $abqrow['answer3'], 
				'S_ANSWER4' => $abqrow['answer4'], 
				'S_ANSWER5' => $abqrow['answer5'], 
				'S_WRONGANSWER01' => $abqrow['wronganswer01'],
				'S_WRONGANSWER02' => $abqrow['wronganswer02'],
				'S_WRONGANSWER03' => $abqrow['wronganswer03'],
				'S_WRONGANSWER04' => $abqrow['wronganswer04'],
				'S_WRONGANSWER05' => $abqrow['wronganswer05'],
				'S_WRONGANSWER06' => $abqrow['wronganswer06'],
				'S_WRONGANSWER07' => $abqrow['wronganswer07'],
				'S_WRONGANSWER08' => $abqrow['wronganswer08'],
				'S_WRONGANSWER09' => $abqrow['wronganswer09'],
				'S_WRONGANSWER10' => $abqrow['wronganswer10'],
				'S_LANGUAGE' => $abqrow['lang'], 

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
				'U_ABQ_ACTION' => append_sid('abq_indig_quests.'.$phpEx.'?eid='.$abq_id))
			);

			$template->pparse('body');

			include('./page_footer_admin.'.$phpEx);
		}
	}
}
else
{
	if ($HTTP_POST_VARS['mode'] == 'new')
	{
		if (!isset($HTTP_POST_VARS['question']))
		{
			$template->set_filenames(array(
				'body' => 'admin/abq_indig_quests_edit_body.tpl')
			);

			$template->assign_vars(array(
				'L_ABQ_TITLE' => $lang['ABQ_MOD'] . ' - ' . sprintf($lang['ABQ_Admin_Title'], 2),
				'L_ABQ_EXPLAIN' => sprintf($lang['ABQ_Admin_Explain_Type2'], (($ABQ_GDLib_Version < 1) ? $lang['ABQ_not_installed'] : $lang['ABQ_installed'])),
				'L_PANEL_TITLE' => $lang['ABQ_Create_Question'],
				'L_QUESTION' => $lang['ABQ_Question'],
				'L_QUESTION_EXPLAIN' => $lang['ABQ_IQ_T2_Explain'],
				'L_ANSWER_CORRECT' => $lang['ABQ_Answer'],
				'L_ANSWER_CORRECT_EXPLAIN' => ($abq_config['IndiQuests_CaseSensitive']) ? '<br />'.$lang['ABQ_Answer_Explain'] : '',
				'L_ITEMS_REQUIRED' => $lang['Items_required'], 
				'L_ANSWER_WRONG' => $lang['ABQ_Answer_wrong'],
				'L_ANSWER_INFO1' => $lang['ABQ_IQ_MC_Info1'],
				'L_ANSWER_INFO1A' => $lang['ABQ_IQ_MC_Info1a'],
				'L_ANSWER_INFO2' => $lang['ABQ_IQ_MC_Info2'],
				'L_ANSWER_INFO2A' => $lang['ABQ_IQ_MC_Info2a'],
				'L_ANSWER_INFO3' => $lang['ABQ_IQ_MC_Info3'],
				'S_MLENGTH_Q' => $ABQ_Question_Maxlenght,
				'S_ANSWER_MAXLENGTH' => $ABQ_Answer_Maxlenght,
				'L_BOARD_LANGUAGE' => $lang['Board_lang'],
				'S_QUESTION' => '',
				'S_ANSWER1' => '',
				'S_ANSWER2' => '',
				'S_ANSWER3' => '',
				'S_ANSWER4' => '',
				'S_ANSWER5' => '',
				'S_WRONGANSWER01' => '',
				'S_WRONGANSWER02' => '',
				'S_WRONGANSWER03' => '',
				'S_WRONGANSWER04' => '',
				'S_WRONGANSWER05' => '',
				'S_WRONGANSWER06' => '',
				'S_WRONGANSWER07' => '',
				'S_WRONGANSWER08' => '',
				'S_WRONGANSWER09' => '',
				'S_WRONGANSWER10' => '',
				'S_LANGUAGE' => language_select($board_config['default_lang'], 'language'),
				'S_MODE' => 'new',

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
				'U_ABQ_ACTION' => append_sid('abq_indig_quests.'.$phpEx))
			);

			$template->pparse('body');

			include('./page_footer_admin.'.$phpEx);
		}
		else
		{
			$ABQ_Error = '';
			if (strlen($HTTP_POST_VARS['question']) > $ABQ_Question_Maxlenght)
			{
				$ABQ_Error .= sprintf($lang['ABQ_Error_Question_too_long'], $ABQ_Question_Maxlenght) . '<br />';
			}
			if ((strlen($HTTP_POST_VARS['answer1']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer2']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer3']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer4']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer5']) > $ABQ_Answer_Maxlenght))
			{
				$ABQ_Error .= sprintf($lang['ABQ_Error_Answer_too_long'], $ABQ_Answer_Maxlenght) . '<br />';
			}

			$abq_question = htmlspecialchars(trim($HTTP_POST_VARS['question']));
			if (($abq_question != trim($HTTP_POST_VARS['question'])) || (preg_match('#[^A-Za-z0-9%=\+\*/\(\):;\.,!\? -]#', $abq_question)))
			{
					$ABQ_Error .= $lang['ABQ_Error_Sign_not_allowed'] . '<br />';
			}

			$abq_answer1 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer1'])));
			$abq_answer2 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer2'])));
			$abq_answer3 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer3'])));
			$abq_answer4 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer4'])));
			$abq_answer5 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer5'])));
			$abq_wronganswer01 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer01'])));
			$abq_wronganswer02 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer02'])));
			$abq_wronganswer03 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer03'])));
			$abq_wronganswer04 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer04'])));
			$abq_wronganswer05 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer05'])));
			$abq_wronganswer06 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer06'])));
			$abq_wronganswer07 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer07'])));
			$abq_wronganswer08 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer08'])));
			$abq_wronganswer09 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer09'])));
			$abq_wronganswer10 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer10'])));
			$abq_anti_bot_img = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['anti_bot_img'])));
			$abq_language = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['language'])));

			if (empty($abq_question))
			{
				$ABQ_Error .= $lang['ABQ_Error_Question_missed'] . '<br />';
			}

			if ((!empty($abq_answer2)) && (empty($abq_answer1)))
			{
				$abq_answer1 = $abq_answer2;
				$abq_answer2 = '';
			}
			if ((!empty($abq_answer3)) && ((empty($abq_answer1)) || (empty($abq_answer2))))
			{
				if (empty($abq_answer1))
				{
					$abq_answer1 = $abq_answer3;
					$abq_answer3 = '';
				}
				elseif (empty($abq_answer2))
				{
					$abq_answer2 = $abq_answer3;
					$abq_answer3 = '';
				}
			}
			if ((!empty($abq_answer4)) && ((empty($abq_answer1)) || (empty($abq_answer2)) || (empty($abq_answer3))))
			{
				if (empty($abq_answer1))
				{
					$abq_answer1 = $abq_answer4;
					$abq_answer4 = '';
				}
				elseif (empty($abq_answer2))
				{
					$abq_answer2 = $abq_answer4;
					$abq_answer4 = '';
				}
				elseif (empty($abq_answer3))
				{
					$abq_answer3 = $abq_answer4;
					$abq_answer4 = '';
				}
			}
			if ((!empty($abq_answer5)) && ((empty($abq_answer1)) || (empty($abq_answer2)) || (empty($abq_answer3)) || (empty($abq_answer4))))
			{
				if (empty($abq_answer1))
				{
					$abq_answer1 = $abq_answer5;
					$abq_answer5 = '';
				}
				elseif (empty($abq_answer2))
				{
					$abq_answer2 = $abq_answer5;
					$abq_answer5 = '';
				}
				elseif (empty($abq_answer3))
				{
					$abq_answer3 = $abq_answer5;
					$abq_answer5 = '';
				}
				elseif (empty($abq_answer4))
				{
					$abq_answer4 = $abq_answer5;
					$abq_answer5 = '';
				}
			}

			if (empty($abq_answer1))
			{
				$ABQ_Error .= $lang['ABQ_Error_Answer_missed'] . '<br />';
			}

			$CounterWrongAnswers = 0;
			$CounterError1 = 0;
			$CounterError2 = 0;
			unset($i);
			for ($i=1; $i<11; $i++)
			{
				$CWA_VarName = 'abq_wronganswer' . (($i < 10) ? '0' : '') . $i;
				if ($$CWA_VarName != '')
				{
					$CounterWrongAnswers++;
					if ($i > 1)
					{
						unset($j);
						for ($j=1; $j<$i; $j++)
						{
							$CWA_C_VarName = 'abq_wronganswer0' . $j;
							if (strtolower($$CWA_VarName) == strtolower($$CWA_C_VarName))
							{
								$CounterError2 = 1;
							}
						}
					}
				}
				if ((strtolower($$CWA_VarName) == strtolower($abq_answer1)) && ($abq_answer1 != ''))
				{
					$CounterError1 = 1;
				}
			}

			if (($CounterWrongAnswers > 0) && ($abq_answer2 != ''))
			{
				$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_or_not'] . '<br />';
			}
			if ($CounterError1)
			{
				$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_wrong_answer_or_not'] . '<br />';
			}
			if ($CounterError2)
			{
				$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_Answer_twice'] . '<br />';
			}
			if (($CounterWrongAnswers > 0) && ($CounterWrongAnswers != 10))
			{
				$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_Answer_missed'] . '<br />';
			}

			if (trim($ABQ_Error) != '')
			{
				message_die(GENERAL_ERROR, $lang['ABQ_Error_not_updated'] . '<br /><br />' . $ABQ_Error);
			}

			$sql = 'SELECT MAX(id) AS total 
				FROM ' . ANTI_BOT_QUEST_TABLE;
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain next anti-bot-question id information', '', __LINE__, __FILE__, $sql);
			}
			if (!($row = $db->sql_fetchrow($result)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain next anti-bot-question id information', '', __LINE__, __FILE__, $sql);
			}
			$abq_id = $row['total'] + 1;

			$sql = 'INSERT INTO ' . ANTI_BOT_QUEST_TABLE . ' (id, question, answer1, answer2, answer3, answer4, answer5, anti_bot_img, lang, bbcodeuid, wronganswer01, wronganswer02, wronganswer03, wronganswer04, wronganswer05, wronganswer06, wronganswer07, wronganswer08, wronganswer09, wronganswer10, imagequestion) 
				VALUES (' . $abq_id . ', \'' . $abq_question . '\', \'' . $abq_answer1 . '\', \'' . $abq_answer2 . '\', \'' . $abq_answer3 . '\', \'' . $abq_answer4 . '\', \'' . $abq_answer5 . '\', \'\', \'' . $abq_language . '\', \'\', \'' . $abq_wronganswer01 . '\', \'' . $abq_wronganswer02 . '\', \'' . $abq_wronganswer03 . '\', \'' . $abq_wronganswer04 . '\', \'' . $abq_wronganswer05 . '\', \'' . $abq_wronganswer06 . '\', \'' . $abq_wronganswer07 . '\', \'' . $abq_wronganswer08 . '\', \'' . $abq_wronganswer09 . '\', \'' . $abq_wronganswer10 . '\', \'G\')';

			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not create new anti-bot-question', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['ABQ_New_Question_created'] . '<br /><br />' . sprintf($lang['ABQ_Click_return_ABQ'], '<a href="' . append_sid('abq_indig_quests.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
	}
	elseif ($HTTP_POST_VARS['mode'] == 'edit')
	{
		$abq_id = intval($HTTP_GET_VARS['eid']);
		$ABQ_Error = '';
		if (strlen($HTTP_POST_VARS['question']) > $ABQ_Question_Maxlenght)
		{
			$ABQ_Error .= sprintf($lang['ABQ_Error_Question_too_long'], $ABQ_Question_Maxlenght) . '<br />';
		}
		if ((strlen($HTTP_POST_VARS['answer1']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer2']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer3']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer4']) > $ABQ_Answer_Maxlenght) || (strlen($HTTP_POST_VARS['answer5']) > $ABQ_Answer_Maxlenght))
		{
			$ABQ_Error .= sprintf($lang['ABQ_Error_Answer_too_long'], $ABQ_Answer_Maxlenght) . '<br />';
		}

		$abq_question = htmlspecialchars(trim($HTTP_POST_VARS['question']));
		if (($abq_question != trim($HTTP_POST_VARS['question'])) || (preg_match('#[^A-Za-z0-9%=\+\*/\(\):;\.,!\? -]#', $abq_question)))
		{
				$ABQ_Error .= $lang['ABQ_Error_Sign_not_allowed'] . '<br />';
		}

		$abq_answer1 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer1'])));
		$abq_answer2 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer2'])));
		$abq_answer3 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer3'])));
		$abq_answer4 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer4'])));
		$abq_answer5 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['answer5'])));
		$abq_wronganswer01 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer01'])));
		$abq_wronganswer02 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer02'])));
		$abq_wronganswer03 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer03'])));
		$abq_wronganswer04 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer04'])));
		$abq_wronganswer05 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer05'])));
		$abq_wronganswer06 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer06'])));
		$abq_wronganswer07 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer07'])));
		$abq_wronganswer08 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer08'])));
		$abq_wronganswer09 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer09'])));
		$abq_wronganswer10 = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['wronganswer10'])));
		$abq_anti_bot_img = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['anti_bot_img'])));
		$abq_language = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['language'])));

		if (empty($abq_question))
		{
			$ABQ_Error .= $lang['ABQ_Error_Question_missed'] . '<br />';
		}

		if ((!empty($abq_answer2)) && (empty($abq_answer1)))
		{
			$abq_answer1 = $abq_answer2;
			$abq_answer2 = '';
		}
		if ((!empty($abq_answer3)) && ((empty($abq_answer1)) || (empty($abq_answer2))))
		{
			if (empty($abq_answer1))
			{
				$abq_answer1 = $abq_answer3;
				$abq_answer3 = '';
			}
			elseif (empty($abq_answer2))
			{
				$abq_answer2 = $abq_answer3;
				$abq_answer3 = '';
			}
		}
		if ((!empty($abq_answer4)) && ((empty($abq_answer1)) || (empty($abq_answer2)) || (empty($abq_answer3))))
		{
			if (empty($abq_answer1))
			{
				$abq_answer1 = $abq_answer4;
				$abq_answer4 = '';
			}
			elseif (empty($abq_answer2))
			{
				$abq_answer2 = $abq_answer4;
				$abq_answer4 = '';
			}
			elseif (empty($abq_answer3))
			{
				$abq_answer3 = $abq_answer4;
				$abq_answer4 = '';
			}
		}
		if ((!empty($abq_answer5)) && ((empty($abq_answer1)) || (empty($abq_answer2)) || (empty($abq_answer3)) || (empty($abq_answer4))))
		{
			if (empty($abq_answer1))
			{
				$abq_answer1 = $abq_answer5;
				$abq_answer5 = '';
			}
			elseif (empty($abq_answer2))
			{
				$abq_answer2 = $abq_answer5;
				$abq_answer5 = '';
			}
			elseif (empty($abq_answer3))
			{
				$abq_answer3 = $abq_answer5;
				$abq_answer5 = '';
			}
			elseif (empty($abq_answer4))
			{
				$abq_answer4 = $abq_answer5;
				$abq_answer5 = '';
			}
		}

		if (empty($abq_answer1))
		{
			$ABQ_Error .= $lang['ABQ_Error_Answer_missed'] . '<br />';
		}

		if (!empty($abq_anti_bot_img))
		{
			$abq_img_url = '../images/abq_mod/' . $abq_anti_bot_img;
			if ((!file_exists($abq_img_url)) || (!filesize($abq_img_url)))
			{
				$ABQ_Error .= $lang['ABQ_Error_Image_not_available'] . '<br />';
			}
		}

		$CounterWrongAnswers = 0;
		$CounterError1 = 0;
		$CounterError2 = 0;
		unset($i);
		for ($i=1; $i<11; $i++)
		{
			$CWA_VarName = 'abq_wronganswer' . (($i < 10) ? '0' : '') . $i;
			if ($$CWA_VarName != '')
			{
				$CounterWrongAnswers++;
				if ($i > 1)
				{
					unset($j);
					for ($j=1; $j<$i; $j++)
					{
						$CWA_C_VarName = 'abq_wronganswer0' . $j;
						if (strtolower($$CWA_VarName) == strtolower($$CWA_C_VarName))
						{
							$CounterError2 = 1;
						}
					}
				}
			}
			if ((strtolower($$CWA_VarName) == strtolower($abq_answer1)) && ($abq_answer1 != ''))
			{
				$CounterError1 = 1;
			}
		}

		if (($CounterWrongAnswers > 0) && ($abq_answer2 != ''))
		{
			$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_or_not'] . '<br />';
		}
		if ($CounterError1)
		{
			$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_wrong_answer_or_not'] . '<br />';
		}
		if ($CounterError2)
		{
			$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_Answer_twice'] . '<br />';
		}
		if (($CounterWrongAnswers > 0) && ($CounterWrongAnswers != 10))
		{
			$ABQ_Error .= $lang['ABQ_Error_MultipleChoice_Answer_missed'] . '<br />';
		}

		if (trim($ABQ_Error) != '')
		{
			message_die(GENERAL_ERROR, $lang['ABQ_Error_not_updated'] . '<br /><br />' . $ABQ_Error);
		}

		$sql = 'UPDATE ' . ANTI_BOT_QUEST_TABLE . '
			SET question = \'' . $abq_question . '\',
			answer1 = \'' . $abq_answer1 . '\',
			answer2 = \'' . $abq_answer2 . '\',
			answer3 = \'' . $abq_answer3 . '\',
			answer4 = \'' . $abq_answer4 . '\',
			answer5 = \'' . $abq_answer5 . '\',
			anti_bot_img = \'\',
			lang = \'' . $abq_language . '\',
			bbcodeuid = \'\', 
			wronganswer01 = \'' . $abq_wronganswer01 . '\', 
			wronganswer02 = \'' . $abq_wronganswer02 . '\', 
			wronganswer03 = \'' . $abq_wronganswer03 . '\', 
			wronganswer04 = \'' . $abq_wronganswer04 . '\', 
			wronganswer05 = \'' . $abq_wronganswer05 . '\', 
			wronganswer06 = \'' . $abq_wronganswer06 . '\', 
			wronganswer07 = \'' . $abq_wronganswer07 . '\', 
			wronganswer08 = \'' . $abq_wronganswer08 . '\', 
			wronganswer09 = \'' . $abq_wronganswer09 . '\', 
			wronganswer10 = \'' . $abq_wronganswer10 . '\', 
			imagequestion = \'G\' 
			WHERE id = ' . $abq_id;
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update this anti-bot-question', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['ABQ_Question_updated'] . '<br /><br />' . sprintf($lang['ABQ_Click_return_ABQ'], '<a href="' . append_sid('abq_indig_quests.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	elseif ($HTTP_POST_VARS['mode'] == 'delete')
	{
		$abq_id = intval($HTTP_GET_VARS['eid']);

		$sql = 'DELETE FROM ' . ANTI_BOT_QUEST_TABLE . '
			WHERE id = ' . $abq_id . ' AND imagequestion = \'G\'';
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not delete this anti-bot-question', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['ABQ_Question_deleted'] . '<br /><br />' . sprintf($lang['ABQ_Click_return_ABQ'], '<a href="' . append_sid('abq_indig_quests.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
}

?>