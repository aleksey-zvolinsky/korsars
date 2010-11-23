<?php
/***************************************************************************
 *                          functions_abq.php
 *                          -----------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
	exit;
}

// ABQ_AskQuestion() selects an Anti Bot Question for the posting / registration form
// $WhichForm = 'Posting' || 'Registration'
function ABQ_AskQuestion($WhichForm)
{
	global $abq_answerfield, $abq_config, $abq_id, $abq_quest, $board_config, $db, $dbms, $ABQ_FTLib_Version, $ABQ_GDLib_Version, $lang, $phpbb_root_path, $phpEx, $template, $user_ip, $userdata;

	mt_srand((double)microtime()*1231230);

	$ReturnValue = 0;
	$AskQuestion = 0;
	$abq_quest = '';
	$abq_image = '';

	if ($WhichForm == 'Posting')
	{
		global $hidden_form_fields;

		if ($abq_config['abq_guest'] && !$userdata['session_logged_in'])
		{
			if (!isset($abq_id))
			{
				$abq_id = 0;
			}
			$AskQuestion = 1;
		}
	}
	elseif ($WhichForm == 'Registration')
	{
		global $idabq, $s_hidden_fields;

		if (isset($idabq))
		{
			$abq_id = htmlspecialchars($idabq);
		}
		else
		{
			$abq_id = 0;
		}
		$AskQuestion = 1;
	}

	// Delete all ANTI_BOT_QUEST_CONFIRM_TABLE entries without an existing session
	$sql = 'DELETE FROM ' .  ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
		WHERE start_time < ' . (time() - (int) $board_config['session_length']) . ' 
		AND session_id <> \'' . $userdata['session_id'] . '\'';

	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not delete stale anti bot question data', '', __LINE__, __FILE__, $sql);
	}
	$db->sql_freeresult($result);

	if ($abq_config['multiimages'])
	{
		// Select all existing sessions
		$sql = 'SELECT session_id 
			FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE; 
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
		}
		if ($row = $db->sql_fetchrow($result))
		{
			$ImageFiles = array();
			do
			{
				$ImageFiles[] = $row['session_id'];
			}
			while ($row = $db->sql_fetchrow($result));

			// Delete all multiimage files without an existing session
			unset($CacheFiles);
			$CacheFiles = array();
			if ($CacheFolder = @opendir($phpbb_root_path.'images/abq_mod/cache/'))
			{
				while (true == ($Files = @readdir($CacheFolder)))
				{
					if ((substr(strtolower($Files), -4) == '.jpg') || (substr(strtolower($Files), -4) == '.png'))
					{
						$CacheFiles[] = $Files;
					}
				}
				closedir($CacheFolder);
			}
			$CacheFilesAmount = count($CacheFiles);
			if ($CacheFilesAmount > 0)
			{
				for ($i=0; $i<$CacheFilesAmount; $i++)
				{
					$DatSesID = substr($CacheFiles[$i], 0, -6);
					if (!in_array($DatSesID, $ImageFiles))
					{
						@unlink($phpbb_root_path . 'images/abq_mod/cache/' . $CacheFiles[$i]);
					}
				}
			}
		}
	}
	$db->sql_freeresult($result);

	if ($AskQuestion)
	{
		// How often was the answer wrong?
		$sql = 'SELECT COUNT(session_id) AS attempts 
			FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
			WHERE session_id = \'' . $userdata['session_id'] . '\' AND whichform = \'' . substr($WhichForm,0,1) . '\'';
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain anti bot question answers count', '', __LINE__, __FILE__, $sql);
		}
		if ($row = $db->sql_fetchrow($result))
		{
			// Block the posting or registration if the max. number of attempts is reached
			if (($WhichForm == 'Registration') && ($abq_config['lockregister'] > 0) && ($row['attempts'] > $abq_config['lockregister']))
			{
				message_die(GENERAL_MESSAGE, $lang['Too_many_registers']);
			}
			elseif (($WhichForm == 'Posting') && ($abq_config['lockguestposts'] > 0) && ($row['attempts'] > $abq_config['lockguestposts']))
			{
				message_die(GENERAL_MESSAGE, $lang['ABQ_Too_many_posts']);
			}
		}
		$db->sql_freeresult($result);

		// Check the PHP, FreeType Library and GD Library Version
		$ABQ_PHP_Version = array();
		$ABQ_FTLib_Version = 0;
		$ABQ_GDLib_Version = 0;
		ABQ_gdVersion();

		$confirm_id = md5(uniqid($user_ip));

		$quest_line1 = '';
		$quest_line2 = '';
		$quest_line3 = '';
		$quest_line4 = '';
		$quest_colour = '';

		// How many different types of Automatic Questions are available?
		$QuestionType = 1;		// E - Individual Question; 1+ = type of Automatic Question
		$maximumrand = 0;
		for ($i=1; $i<=34; $i++)
		{
			unset($j);
			$j = ($i < 10) ? '0' . $i : $i;
			if (($ABQ_GDLib_Version < 1) && (($i == 1) || ($i == 2) || ($i == 3) || ($i == 4) || ($i == 9) || ($i == 10) || ($i == 11) || ($i == 12) || ($i == 17) || ($i == 18) || ($i == 19) || ($i == 20) || ($i == 25) || ($i == 26) || ($i == 27) || ($i == 31) || ($i == 32) || ($i == 34)))
			{
				// This type of Automatic Questions is not available because it needs the GD-Library and the Library is not installed.
			}
			else
			{
				$maximumrand += $abq_config["AutoQuestion_$j"];
			}
		}

		// Create what type of question? Individual or Automatic
		if (($abq_config['Individuel_Questions'] == 1) || ($maximumrand < 1))
		{
			if (($abq_config['Ratio_Auto_Indi_Questions'] == 100) || ($maximumrand < 1))
			{
				// Configuration: Use Individual Question with a percentage of 100 -or- no Automatic Question is enabled
				$QuestionType = 'E';
			}
			elseif ($abq_config['Ratio_Auto_Indi_Questions'] == 0)
			{
				// Configuration: Use Individual Question with a percentage of 0
			}
			else
			{
				$percent = mt_rand(1, 100);
				if ($percent <= $abq_config['Ratio_Auto_Indi_Questions'])
				{
					$QuestionType = 'E';
				}
			}
		}

		// Select an Individual Question if $QuestionType = 'E'
		if ($QuestionType == 'E')
		{
			if (preg_match('/[^a-z0-9]/i', $abq_id))
			{
				$abq_id = 0;
			}
			// If $abq_id is not empty it is not the first Anti Bot Question within this session
			if (!empty($abq_id))
			{
				// What was the last Anti Bot Question?
				$sql = 'SELECT answer 
					FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
					WHERE confirm_id = \'' . $confirm_id . '\' 
						AND session_id = \'' . $userdata['session_id'] . '\'';
				if (!($result = $db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', __LINE__, __FILE__, $sql);
				}

				// Select randomly an Anti Bot Question but not the last one
				if (($dbms == 'mysql') || ($dbms == 'mysql4'))
				{
					$sql = 'SELECT * 
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE lang = \'' . $board_config['default_lang'] . '\' ';
					if ($row = $db->sql_fetchrow($result))
					{
						if (substr($row['answer'],0,1) == '_')
						{
							$sql .= 'AND id != ' . substr($row['answer'],1) . ' ';
						}
					}
					$sql .= (($ABQ_GDLib_Version < 1) ? 'AND imagequestion = \'\' ' : '') . 'ORDER BY RAND() LIMIT 1';
				}
				elseif ($dbms == 'mssql')
				{
					$sql = 'SELECT TOP 1 * 
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE lang = \'' . $board_config['default_lang'] . '\' ';
					if ($row = $db->sql_fetchrow($result))
					{
						if (substr($row['answer'],0,1) == '_')
						{
							$sql .= 'AND id != ' . substr($row['answer'],1) . ' ';
						}
					}
					$sql .= (($ABQ_GDLib_Version < 1) ? 'AND imagequestion = \'\' ' : '') . 'ORDER BY NEWID()';

				}
				else
				{
					$sql = 'SELECT id 
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE lang = \'' . $board_config['default_lang'] . '\' ';
					if ($row = $db->sql_fetchrow($result))
					{
						if (substr($row['answer'],0,1) == '_')
						{
							$sql .= 'AND id != ' . substr($row['answer'],1) . ' ';
						}
					}
					$sql .= (($ABQ_GDLib_Version < 1) ? 'AND imagequestion = \'\' ' : '');

					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', __LINE__, __FILE__, $sql);
					}
					$ABQ_IDList = array();
					if ($row = $db->sql_fetchrow($result))
					{
						$ABQ_IDList[] = $row['id'];
					}
					$max = count($ABQ_IDList) - 1;
					$useABQID = 0;
					if ($max >= 0)
					{
						$useABQID = mt_rand(0, $max);
						$useABQID = $ABQ_IDList[$useABQID];
					}
					$sql = 'SELECT * 
						FROM ' . ANTI_BOT_QUEST_TABLE . ' 
						WHERE id = ' . $useABQID;
				}
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not obtain anti bot question information', '', __LINE__, __FILE__, $sql);
				}
				if ($db->sql_numrows($result) < 1)
				{
					// No or no other Individual Question is available
					$abq_id = 0;
				}
			}
			// If $abq_id is empty it is the first Anti Bot Question within this session or only one Individual Question is available
			if (empty($abq_id))
			{
				// Select randomly an Anti Bot Question but not the last one
				if (($dbms == 'mysql') || ($dbms == 'mysql4'))
				{
					$sql = 'SELECT *
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE lang = \'' . $board_config['default_lang'] . '\' ' . (($ABQ_GDLib_Version < 1) ? 'AND imagequestion = \'\' ' : '') . '
						ORDER BY RAND() LIMIT 1';
				}
				elseif ($dbms == 'mssql')
				{
					$sql = 'SELECT TOP 1 *
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE lang = \'' . $board_config['default_lang'] . '\' ' . (($ABQ_GDLib_Version < 1) ? 'AND imagequestion = \'\' ' : '') . '
						ORDER BY NEWID()';
				}
				else
				{
					$sql = 'SELECT id 
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE lang = \'' . $board_config['default_lang'] . '\' ' . (($ABQ_GDLib_Version < 1) ? 'AND imagequestion = \'\' ' : '');
					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', __LINE__, __FILE__, $sql);
					}
					$ABQ_IDList = array();
					if ($row = $db->sql_fetchrow($result))
					{
						$ABQ_IDList[] = $row['id'];
					}
					$max = count($ABQ_IDList) - 1;
					$useABQID = 0;
					if ($max >= 0)
					{
						$useABQID = mt_rand(0, $max);
						$useABQID = $ABQ_IDList[$useABQID];
					}
					$sql = 'SELECT * 
						FROM ' . ANTI_BOT_QUEST_TABLE . ' 
						WHERE id = ' . $useABQID;
				}
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not obtain anti bot question information', '', __LINE__, __FILE__, $sql);
				}
			}
			if ($db->sql_numrows($result) > 0)
			{
				// At least one Individual Question is available
				$abqrow = $db->sql_fetchrow($result);

				if ($abqrow['imagequestion'] == 'G')
				{
					// The Individual Question is an image question
					if ($abq_config['multiimages'])
					{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $abqrow['id'], '', '', '', '', $MultiImageFormat, 'I');
					}
					else
					{
						$abq_quest = '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
						$quest_line1 = $abqrow['question'];
					}
				}
				else
				{
					// The Individual Question is a text question
					$abq_quest = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $abqrow['question']);
					if ($abqrow['bbcodeuid'] != '')
					{
						$abq_quest = bbencode_second_pass($abq_quest, $abqrow['bbcodeuid']);
					}
					$abq_quest = str_replace("\n", "\n<br />\n", $abq_quest);

					$abq_image = $abqrow['anti_bot_img'];
					if ($abq_image != '')
					{
						if ($abq_config['IndiQuests_ImagePHP'])
						{
							$abq_image = '<br /><img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" />';
						}
						else
						{
							$abq_image = '<br /><img src="' . $phpbb_root_path . 'images/abq_mod/' . $abq_image . '" />';
						}
						$abq_quest .= $abq_image;
					}
				}
				// Save the Individual Question ID within the answer field
				$confirm_answer = '_' . $abqrow['id'];
			}
			else
			{
				// No Individual Question is available use an Automatic Question
				$QuestionType = 1;
			}
		}

		if ($QuestionType == 'E')
		{
			// Is the answer check of the Individual Question case sensitive?
			$ReturnValue = $abq_config['IndiQuests_CaseSensitive'];
		}
		else
		{
			// Select an Automatic Question if $QuestionType != 'E'
			if ($maximumrand < 1)
			{
				// If no Automatic Question is enabled: Always use the Automatic Question type 5.
				$AutomaticQuestionType = 5;
			}
			else
			{
				// Else: Select randomly an available Automatic Question type
				$AutomaticQuestionType = mt_rand(1, $maximumrand);
				unset($i);
				unset($j);
				$j = 0;
				for ($i=1; $i<=34; $i++)
				{
					unset($k);
					$k = ($i < 10) ? '0' . $i : $i;
					if (($ABQ_GDLib_Version < 1) && (($i == 1) || ($i == 2) || ($i == 3) || ($i == 4) || ($i == 9) || ($i == 10) || ($i == 11) || ($i == 12) || ($i == 17) || ($i == 18) || ($i == 19) || ($i == 20) || ($i == 25) || ($i == 26) || ($i == 27) || ($i == 31) || ($i == 32) || ($i == 34)))
					{
						// Automatic Question type $i is not available because it needs the GD Library and the Library is not installed
					}
					elseif ($abq_config['AutoQuestion_'.$k] == 1)
					{
						$j++;
						if ($j == $AutomaticQuestionType)
						{
							$AutomaticQuestionType = $i;
							break;
						}
					}
				}
			}
			// $maxLines - Number of lines
			// $Line - The line which is importent for the answer
			if (($AutomaticQuestionType>= 9) && ($AutomaticQuestionType <= 16))
			{
				// Create Automatic Question types 9 - 16
				// Which numbers are in the following character sequence (on line %s)?
				if (($AutomaticQuestionType == 10) || ($AutomaticQuestionType == 14))
				{
					$maxLines = 3;
				}
				elseif (($AutomaticQuestionType == 11) || ($AutomaticQuestionType == 15))
				{
					$maxLines = 2;
				}
				elseif (($AutomaticQuestionType == 12) || ($AutomaticQuestionType == 16))
				{
					$maxLines = 1;
				}
				else
				{
					$maxLines = 4;
				}

				$Line = mt_rand(1, $maxLines);
				if ($maxLines > 1)
				{
					$abq_quest = sprintf($lang['ABQ_Form_AutoQuestType03'], $Line) . '<br />';
				}
				else
				{
					$abq_quest = $lang['ABQ_Form_AutoQuestType04'] . '<br />';
				}
				// Create the $maxLines lines
				for ($i=1; $i<=$maxLines; $i++)
				{
					$UseFakeArithmeticProblem = mt_rand(0, 1);
					if ($UseFakeArithmeticProblem)
					{
						$code2 = CreateFakeArithmeticProblem();
					}
					else
					{
						// Create a character set of numbers, alphabetic characters and signs
						$Characters_Numbers = CreateCharacters('1');
						$Characters_Alphabetic = CreateCharacters('a');
						$Characters_Signs = CreateCharacters('#');
						$Characters_NumbersCount = mt_rand(5, 7);
						$Characters_AlphabeticCount = mt_rand((10 - $Characters_NumbersCount), (12 - $Characters_NumbersCount));
						$Characters_SignsCount = mt_rand(0, 2);
						if (strlen($Characters_Numbers) > $Characters_NumbersCount)
						{
							$Characters_Numbers = substr($Characters_Numbers, 0, $Characters_NumbersCount);
						}
						elseif (strlen($Characters_Numbers) < $Characters_NumbersCount)
						{
							for ($j=strlen($Characters_Numbers); $j<$Characters_NumbersCount; $j++)
							{
								$Characters_Numbers .= ($j+1);
							}
						}
						if (strlen($Characters_Alphabetic) > $Characters_AlphabeticCount)
						{
							$Characters_Alphabetic = substr($Characters_Alphabetic, 0, $Characters_AlphabeticCount);
						}
						elseif (strlen($Characters_Alphabetic) < $Characters_AlphabeticCount)
						{
							for ($j=strlen($Characters_Alphabetic); $j<$Characters_AlphabeticCount; $j++)
							{
								$Characters_Alphabetic .= 'A';
							}
						}
						if ($Characters_SignsCount == 0)
						{
							$Characters_Signs = '';
						}
						else
						{
							$Characters_Signs = substr($Characters_Signs, 0, $Characters_SignsCount);
						}
						$code1 = $Characters_Numbers . $Characters_Alphabetic . $Characters_Signs;
						// Create a randomly character set order
						$code2 = '';
						$code1len1 = strlen($code1);
						for ($j=0; $j<$code1len1; $j++)
						{
							$code1len2 = strlen($code1);
							$CharakterPosition = mt_rand(0, ($code1len2-1));
							$code2 .= substr($code1, $CharakterPosition, 1);
							if ($code1len2 > 1)
							{
								if ($CharakterPosition > 0)
								{
									$code1 = substr($code1, 0, $CharakterPosition) . substr($code1, ($CharakterPosition+1));
								}
								else
								{
									$code1 = substr($code1, 1);
								}
							}
						}
					}
					if  ($Line == $i)
					{
						$confirm_answer = preg_replace('/[^0-9]/i', '', $code2);
					}
					${'quest_line'.$i} = $code2;
					if ($AutomaticQuestionType > 12)
					{
						$abq_quest .= $code2 . '<br />';
					}
				}
				if ($AutomaticQuestionType < 13)
				{
					if ($abq_config['multiimages'])
					{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, 'A');
					}
					else
					{
						$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
					}
				}
				$abq_quest .= $lang['ABQ_Form_AutoQuestType03Notice'];
			}
			elseif (($AutomaticQuestionType >= 17) && ($AutomaticQuestionType <= 24))
			{
				// Create Automatic Question types 17 - 24
				// Which alphabetic characters are in the following character sequence (on line %s)?
				if (($AutomaticQuestionType == 18) || ($AutomaticQuestionType == 22))
				{
					$maxLines = 3;
				}
				elseif (($AutomaticQuestionType == 19) || ($AutomaticQuestionType == 23))
				{
					$maxLines = 2;
				}
				elseif (($AutomaticQuestionType == 20) || ($AutomaticQuestionType == 24))
				{
					$maxLines = 1;
				}
				else
				{
					$maxLines = 4;
				}
				$Line = mt_rand(1, $maxLines);
				if ($maxLines > 1)
				{
					$abq_quest = sprintf($lang['ABQ_Form_AutoQuestType05'], $Line) . '<br />';
				}
				else
				{
					$abq_quest = $lang['ABQ_Form_AutoQuestType06'] . '<br />';
				}
				// Create the $maxLines lines
				for ($i=1; $i<=$maxLines; $i++)
				{
					// Create a character set of numbers, alphabetic characters and signs
					$Characters_Numbers = CreateCharacters('1');
					$Characters_Alphabetic = CreateCharacters('a');
					$Characters_Signs = CreateCharacters('#');
					$Characters_AlphabeticCount = mt_rand(5, 7);
					$Characters_NumbersCount = mt_rand((10 - $Characters_AlphabeticCount), (12 - $Characters_AlphabeticCount));
					$Characters_SignsCount = mt_rand(0, 2);
					if (strlen($Characters_Numbers) > $Characters_NumbersCount)
					{
						$Characters_Numbers = substr($Characters_Numbers, 0, $Characters_NumbersCount);
					}
					elseif (strlen($Characters_Numbers) < $Characters_NumbersCount)
					{
						for ($j=strlen($Characters_Numbers); $j<$Characters_NumbersCount; $j++)
						{
							$Characters_Numbers .= ($j+1);
						}
					}
					if (strlen($Characters_Alphabetic) > $Characters_AlphabeticCount)
					{
						$Characters_Alphabetic = substr($Characters_Alphabetic, 0, $Characters_AlphabeticCount);
					}
					elseif (strlen($Characters_Alphabetic) < $Characters_AlphabeticCount)
					{
						for ($j=strlen($Characters_Alphabetic); $j<$Characters_AlphabeticCount; $j++)
						{
							$Characters_Alphabetic .= 'A';
						}
					}
					if ($Characters_SignsCount == 0)
					{
						$Characters_Signs = '';
					}
					else
					{
						$Characters_Signs = substr($Characters_Signs, 0, $Characters_SignsCount);
					}
					$code1 = $Characters_Numbers . $Characters_Alphabetic . $Characters_Signs;
					// Create a randomly character set order
					$code2 = '';
					$code1len1 = strlen($code1);
					for ($j=0; $j<$code1len1; $j++)
					{
						$code1len2 = strlen($code1);
						$CharakterPosition = mt_rand(0, ($code1len2-1));
						$code2 .= substr($code1, $CharakterPosition, 1);
						if ($code1len2 > 1)
						{
							if ($CharakterPosition > 0)
							{
								$code1 = substr($code1, 0, $CharakterPosition) . substr($code1, ($CharakterPosition+1));
							}
							else
							{
								$code1 = substr($code1, 1);
							}
						}
					}
					if  ($Line == $i)
					{
						$confirm_answer = preg_replace('/[^a-z]/i', '', $code2);
					}
					${'quest_line'.$i} = $code2;
					if ($AutomaticQuestionType > 20)
					{
						$abq_quest .= $code2 . '<br />';
					}
				}
				if ($AutomaticQuestionType < 21)
				{
					if ($abq_config['multiimages'])
					{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, 'A');
					}
					else
					{
						$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
					}
				}
				$abq_quest .= $lang['ABQ_Form_AutoQuestType05Notice'];
			}
			elseif (($AutomaticQuestionType >= 25) && ($AutomaticQuestionType <= 30))
			{
				// Create Automatic Question types 25 - 30
				// Which characters are at the %s position in the following character sequence?
				$abq_quest = '';
				$CompleteCharSet = '';
				for ($i=1; $i<=4; $i++)
				{
					// Create a character set of numbers and alphabetic characters
					$Characters_Numbers = CreateCharacters('1');
					$Characters_Alphabetic = CreateCharacters('a');
					$Characters_NumbersCount = mt_rand(4, 7);
					$Characters_AlphabeticCount = mt_rand((10 - $Characters_NumbersCount), (12 - $Characters_NumbersCount));
					if (strlen($Characters_Numbers) > $Characters_NumbersCount)
					{
						$Characters_Numbers = substr($Characters_Numbers, 0, $Characters_NumbersCount);
					}
					elseif (strlen($Characters_Numbers) < $Characters_NumbersCount)
					{
						for ($j=strlen($Characters_Numbers); $j<$Characters_NumbersCount; $j++)
						{
							$Characters_Numbers .= ($j+1);
						}
					}
					if (strlen($Characters_Alphabetic) > $Characters_AlphabeticCount)
					{
						$Characters_Alphabetic = substr($Characters_Alphabetic, 0, $Characters_AlphabeticCount);
					}
					elseif (strlen($Characters_Alphabetic) < $Characters_AlphabeticCount)
					{
						for ($j=strlen($Characters_Alphabetic); $j<$Characters_AlphabeticCount; $j++)
						{
							$Characters_Alphabetic .= 'A';
						}
					}
					$code1 = $Characters_Numbers . $Characters_Alphabetic;
					// Create a randomly character set order
					$code2 = '';
					$code1len1 = strlen($code1);
					for ($j=0; $j<$code1len1; $j++)
					{
						$code1len2 = strlen($code1);
						$CharakterPosition = mt_rand(0, ($code1len2-1));
						$code2 .= substr($code1, $CharakterPosition, 1);
						if ($code1len2 > 1)
						{
							if ($CharakterPosition > 0)
							{
								$code1 = substr($code1, 0, $CharakterPosition) . substr($code1, ($CharakterPosition+1));
							}
							else
							{
								$code1 = substr($code1, 1);
							}
						}
					}
					${'quest_line'.$i} = $code2;
					$CompleteCharSet .= $code2;
					if ($AutomaticQuestionType > 27)
					{
						$abq_quest .= $code2 . '<br />';
					}
				}
				// Select 6, 7 or 8 charakters for the answer
				if (($AutomaticQuestionType == 26) || ($AutomaticQuestionType == 29))
				{
					$NumberOfNeededChars = 7;
				}
				elseif (($AutomaticQuestionType == 27) || ($AutomaticQuestionType == 30))
				{
					$NumberOfNeededChars = 6;
				}
				else
				{
					$NumberOfNeededChars = 8;
				}
				$Positions = '';
				$Position = -1;
				$CompleteLen = strlen($CompleteCharSet);
				for ($i=0; $i<$NumberOfNeededChars; $i++)
				{
					$Position = mt_rand(($Position+1), ($CompleteLen-((2*($NumberOfNeededChars-($i+1)))+1)));
					$confirm_answer .= substr($CompleteCharSet, $Position, 1);
					$Positions .= (($Positions != '') ? ((($i+1) == $NumberOfNeededChars) ? ' ' . $lang['ABQ_and'] . ' ' : ', ') : '' ) . ($Position+1) . '.';
				}
				$abq_quest = sprintf($lang['ABQ_Form_AutoQuestType07'], $Positions) . '<br />' . $abq_quest;
				if ($AutomaticQuestionType < 28)
				{
					if ($abq_config['multiimages'])
					{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, 'A');
					}
					else
					{
						$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
					}
				}
				$abq_quest .= $lang['ABQ_Form_AutoQuestType07Notice'];
			}
			elseif (($AutomaticQuestionType >= 31) && ($AutomaticQuestionType <= 32))
			{
				// Create Automatic Question types 31 and 32
				// Which green/red characters are in the following character sequence?
				if ($AutomaticQuestionType == 31)
				{
					$abq_quest = $lang['ABQ_Color1'];
					$quest_colour = 'G';
				}
				else
				{
					$abq_quest = $lang['ABQ_Color2'];
					$quest_colour = 'R';
				}
				// Create the four lines
				for ($i=1; $i<=4; $i++)
				{
					// Create a character set of numbers and alphabetic characters
					$Characters_Numbers = CreateCharacters('1');
					$Characters_Alphabetic = CreateCharacters('a');
					$Characters_NumbersCount = mt_rand(4, 7);
					$Characters_AlphabeticCount = mt_rand((10 - $Characters_NumbersCount), (12 - $Characters_NumbersCount));
					if (strlen($Characters_Numbers) > $Characters_NumbersCount)
					{
						$Characters_Numbers = substr($Characters_Numbers, 0, $Characters_NumbersCount);
					}
					elseif (strlen($Characters_Numbers) < $Characters_NumbersCount)
					{
						for ($j=strlen($Characters_Numbers); $j<$Characters_NumbersCount; $j++)
						{
							$Characters_Numbers .= ($j+1);
						}
					}
					if (strlen($Characters_Alphabetic) > $Characters_AlphabeticCount)
					{
						$Characters_Alphabetic = substr($Characters_Alphabetic, 0, $Characters_AlphabeticCount);
					}
					elseif (strlen($Characters_Alphabetic) < $Characters_AlphabeticCount)
					{
						for ($j=strlen($Characters_Alphabetic); $j<$Characters_AlphabeticCount; $j++)
						{
							$Characters_Alphabetic .= 'A';
						}
					}
					$code1 = $Characters_Numbers . $Characters_Alphabetic;
					// Create a randomly character set order
					$code2 = '';
					$code1len1 = strlen($code1);
					for ($j=0; $j<$code1len1; $j++)
					{
						$code1len2 = strlen($code1);
						$CharakterPosition = mt_rand(0, ($code1len2-1));
						$code2 .= substr($code1, $CharakterPosition, 1);
						if ($code1len2 > 1)
						{
							if ($CharakterPosition > 0)
							{
								$code1 = substr($code1, 0, $CharakterPosition) . substr($code1, ($CharakterPosition+1));
							}
							else
							{
								$code1 = substr($code1, 1);
							}
						}
					}
					${'quest_line'.$i} = $code2;
				}
				// Select 6, 7 or 8 charakters for the answer
				$NumberOfNeededChars = mt_rand(6, 8);
				$CharaktersInLine1 = mt_rand(0, ($NumberOfNeededChars-3));
				$CharaktersInLine2 = mt_rand(0, ($NumberOfNeededChars-(2+$CharaktersInLine1)));
				$CharaktersInLine3 = mt_rand(0, ($NumberOfNeededChars-(1+$CharaktersInLine1+$CharaktersInLine2)));
				$CharaktersInLine4 = $NumberOfNeededChars - ($CharaktersInLine1 + $CharaktersInLine2 + $CharaktersInLine3);
				for ($i=1; $i<=4; $i++)
				{
					if (${'CharaktersInLine'.$i} > 0)
					{
						$CompleteLen = strlen(${'quest_line'.$i});
						$lastPosition = -1;
						$newLine = '';
						for ($j=0; $j<${'CharaktersInLine'.$i}; $j++)
						{
							$Position = mt_rand(($lastPosition+1), ($CompleteLen-((2*(${'CharaktersInLine'.$i}-($j+1)))+1)));
							$confirm_answer .= substr(${'quest_line'.$i}, $Position, 1);
							if ($Position != 0)
							{
								$newLine .= substr(${'quest_line'.$i}, ($lastPosition + 1), ($Position - ($lastPosition + 1))) . '+' . substr(${'quest_line'.$i}, $Position, 1);
							}
							else
							{
								$newLine .= '+' . substr(${'quest_line'.$i}, $Position, 1);
							}
							$lastPosition = $Position;
						}
						if ($lastPosition != ($CompleteLen - 1))
						{
							$newLine .= substr(${'quest_line'.$i}, ($lastPosition+1));
						}
						${'quest_line'.$i} = $newLine;
					}
				}
				$abq_quest = sprintf($lang['ABQ_Form_AutoQuestType08'], $abq_quest) . '<br />';
				if ($abq_config['multiimages'])
				{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, 'A');
				}
				else
				{
					$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
				}
				$abq_quest .= $lang['ABQ_Form_AutoQuestType08Notice'];
			}
			elseif (($AutomaticQuestionType >= 33) && ($AutomaticQuestionType <= 34))
			{
				// Create Automatic Question types 33 and 34
				// Enter the characters of the first line in the order which is indicated in the second line (Without blanks).
				$abq_quest = $lang['ABQ_Form_AutoQuestType09'] . '<br />';
				$confirm_answer = '';
				$quest_line1 = '';
				$quest_line2 = '';
				ChaosCharacterSet($quest_line1, $quest_line2, $confirm_answer);
				if ($AutomaticQuestionType == 33)
				{
					if ($abq_config['multiimages'])
					{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, 'A');
					}
					else
					{
						$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
					}
				}
				else
				{
					$abq_quest .= $quest_line1 . '<br />' . $quest_line2;
				}
			}
			else
			{
				// Create Automatic Question types 1 - 8
				// What is the result of the arithmetic problem (on line %s)?
				if (($AutomaticQuestionType == 2) || ($AutomaticQuestionType == 6))
				{
					$maxLines = 3;
				}
				elseif (($AutomaticQuestionType == 3) || ($AutomaticQuestionType == 7))
				{
					$maxLines = 2;
				}
				elseif (($AutomaticQuestionType == 4) || ($AutomaticQuestionType == 8))
				{
					$maxLines = 1;
				}
				else
				{
					$maxLines = 4;
				}
				$Line = mt_rand(1, $maxLines);
				if ($maxLines > 1)
				{
					$abq_quest = sprintf($lang['ABQ_Form_AutoQuestType01'], $Line) . '<br />';
				}
				else
				{
					$abq_quest = $lang['ABQ_Form_AutoQuestType02'] . '<br />';
				}
				$AP_BigNumbers = $abq_config['AutoQuests_LargeNumbers'];
				for ($i=1; $i<=$maxLines; $i++)
				{
					$AP_ArithmeticProblem = '';
					$AP_Result = '';
					if ($abq_config['AutoQuests_LargeNumbers'] == 2)
					{
						$AP_BigNumbers = mt_rand(0, 1);
					}
					CreateArithmeticProblem($AP_ArithmeticProblem, $AP_Result, $AP_BigNumbers);
					if  ($Line == $i)
					{
						$confirm_answer = $AP_Result;
					}
					${'quest_line'.$i} = $AP_ArithmeticProblem;
					if ($AutomaticQuestionType > 4)
					{
						$abq_quest .= $AP_ArithmeticProblem . '<br />';
					}
				}
				if ($AutomaticQuestionType < 5)
				{
					if ($abq_config['multiimages'])
					{
						$MultiImageFormat = mt_rand(1, 6);
						ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, 'A');
					}
					else
					{
						$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id) . '" /><br clear="all" />';
					}
				}
				$abq_quest .= $lang['ABQ_Form_AutoQuestType01Notice'];
			}
			$ReturnValue = 1;
		}

		if (!empty($confirm_answer))
		{
			// Create the answer field (text field or multiple choice)
			if (substr($confirm_answer,0,1) == '_')
			{
				if ((isset($abqrow['wronganswer01'])) && ($abqrow['wronganswer01'] != '') && ($abqrow['wronganswer02'] != '') && ($abqrow['wronganswer03'] != '') && ($abqrow['wronganswer04'] != '') && ($abqrow['wronganswer05'] != '') && ($abqrow['wronganswer06'] != '') && ($abqrow['wronganswer07'] != '') && ($abqrow['wronganswer08'] != '') && ($abqrow['wronganswer09'] != '') && ($abqrow['wronganswer10'] != ''))
				{
					// Individual Question: Multiple choise
					$abq_answerfield = '<select name="' . $abq_config['abq_variable_name'] . '">';
					$abq_answerfield .= '<option value="_" selected="selected">---- ' . $lang['ABQ_Form_SelectOption1'] . ' ----</option>';
					unset($AnswerSelectArray);
					$AnswerSelectArray = array($abqrow['answer1'], $abqrow['wronganswer01'], $abqrow['wronganswer02'], $abqrow['wronganswer03'], $abqrow['wronganswer04'], $abqrow['wronganswer05'], $abqrow['wronganswer06'], $abqrow['wronganswer07'], $abqrow['wronganswer08'], $abqrow['wronganswer09'], $abqrow['wronganswer10']);
					shuffle($AnswerSelectArray);
					unset($i);
					for ($i=0; $i<11; $i++)
					{
						$abq_answerfield .= '<option value="' . $AnswerSelectArray[$i] . '">&#160;&#160;' . $AnswerSelectArray[$i] . '</option>';
					}
					$abq_answerfield .= '</select>';
				}
				else
				{
					// Individual Question: Text field
					$abq_answerfield = '<input type="text" class="post" style="width: 200px"  name="' . $abq_config['abq_variable_name'] . '" size="35" maxlength="250" value="" />';
				}
			}
			elseif ($abq_config['AutoQuests_MultipleChoise'])
			{
				// Automatic Question: Multiple choise
				$abq_answerfield = '<select name="' . $abq_config['abq_variable_name'] . '">';
				$abq_answerfield .= '<option value="_" selected="selected">---- ' . $lang['ABQ_Form_SelectOption1'] . ' ----</option>';
				unset($AnswerSelectArray);
				$AnswerSelectArray[0] = $confirm_answer;
				if (($AutomaticQuestionType >= 17) && ($AutomaticQuestionType <= 24))
				// only alphabetic characters
				{
					ABQAutoAnswers(1,$AnswerSelectArray);
				}
				elseif (($AutomaticQuestionType >= 25) && ($AutomaticQuestionType <= 34))
				// mix
				{
					ABQAutoAnswers(2,$AnswerSelectArray);
				}
				elseif (($AutomaticQuestionType >= 9) && ($AutomaticQuestionType <= 16))
				// only numbers
				{
					ABQAutoAnswers(3,$AnswerSelectArray, strlen($confirm_answer));
				}
				else
				// only numbers
				{
					ABQAutoAnswers(4,$AnswerSelectArray);
				}
				shuffle($AnswerSelectArray);
				unset($i);
				for ($i=0; $i<11; $i++)
				{
					$abq_answerfield .= '<option value="' . $AnswerSelectArray[$i] . '">&#160;&#160;' . $AnswerSelectArray[$i] . '</option>';
				}
				$abq_answerfield .= '</select>';
			}
			else
			{
				// Automatic Question: Text field
				$abq_answerfield = '<input type="text" class="post" style="width: 200px"  name="' . $abq_config['abq_variable_name'] . '" size="35" maxlength="250" value="" />';
			}

			// Save the question, the answer and the session
			$sql = 'INSERT INTO ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' (confirm_id, session_id, answer, line1, line2, line3, line4, color, whichform, start_time) 
				VALUES (\'' . $confirm_id . '\', \'' . $userdata['session_id'] . '\', \'' . $confirm_answer . '\', \'' . $quest_line1 . '\', \'' . $quest_line2 . '\', \'' . $quest_line3 . '\', \'' . $quest_line4 . '\', \'' . $quest_colour . '\', \'' . substr($WhichForm,0,1) . '\', ' . time() . ')';
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not insert new anti bot question answer information', '', __LINE__, __FILE__, $sql);
			}

			unset($confirm_answer);

			// Submit the ABQ Confirm ID within the posting or registration form
			if ($WhichForm == 'Posting')
			{
				$hidden_form_fields .= '<input type="hidden" name="idabq" value="' . $confirm_id . '" />';
			}
			elseif ($WhichForm == 'Registration')
			{
				$s_hidden_fields .= '<input type="hidden" name="idabq" value="' . $confirm_id . '" />';
			}
			$template->assign_block_vars('switch_anti_bot_question', array());
		}
	}
	return $ReturnValue;
}

// ABQ_CheckAnswer() checks the Anti Bot Question Answer
// $WhichForm = 'Posting' || 'Registration'
function ABQ_CheckAnswer($WhichForm)
{
	global $abq_aw, $abq_config, $abq_id, $board_config, $db, $error, $error_msg, $lang, $userdata;

	$CheckAnswerYN = 0;
	$BotCounter = 0;
	if ($WhichForm == 'Posting')
	{
		global $userdata, $HTTP_POST_VARS;

		if ($abq_config['abq_guest'] && !$userdata['session_logged_in'])
		{
			$abq_aw = htmlspecialchars(stripslashes($HTTP_POST_VARS[$abq_config['abq_variable_name']]));
			$abq_id = htmlspecialchars($HTTP_POST_VARS['idabq']);
			$CheckAnswerYN = 1;
		}
	}
	elseif ($WhichForm == 'Registration')
	{
		global $idabq, $mode, $phpEx, $user_lang;

		if (($user_lang == '') || ((preg_match('/^[a-z_]+$/i', $user_lang)) && (!file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . htmlspecialchars($user_lang) . '/lang_main.'.$phpEx)))))
		{
			message_die(CRITICAL_ERROR, 'Could not locate valid language pack');
		}

		if (($mode == 'register') && ($abq_config['abq_register']))
		{
			$abq_aw = htmlspecialchars(stripslashes($abq_aw));
			$abq_id = htmlspecialchars($idabq);
			$CheckAnswerYN = 1;
		}
	}

	if ($CheckAnswerYN == 1)
	{
		if (empty($abq_aw))
		{
			// The answer field is empty
			$BotCounter = 1;
		}
		elseif (preg_match('/[^a-z0-9]/i', $abq_id))
		{
			// There is at least one not allowed character in the Anti Bot Question Confirm ID > The ID is faked
			$BotCounter = 1;
		}
		else
		{
			// Load the ANTI_BOT_QUEST_CONFIRM_TABLE entry
			$sql = 'SELECT answer 
				FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
				WHERE confirm_id = \'' . $abq_id . '\' 
					AND session_id = \'' . $userdata['session_id'] . '\'';
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				// The Anti Bot Question Confirm ID is in the table
				if (substr($row['answer'],0,1) == '_')
				{
					// The question is an Individual Question > Load this Individual Question
					$sql = 'SELECT answer1, answer2, answer3, answer4, answer5
						FROM ' . ANTI_BOT_QUEST_TABLE . '
						WHERE id = ' . substr($row['answer'],1);
					if(!$result = $db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', '', __LINE__, __FILE__, $sql);
					}
					if( $db->sql_numrows($result) == 0 )
					{
						// The question ID is not in the ANTI_BOT_QUEST_TABLE table > Are Individual Questions available?
						$sql = 'SELECT answer1, answer2, answer3, answer4, answer5 
							FROM ' . ANTI_BOT_QUEST_TABLE . '
							WHERE lang = \'' . $board_config['default_lang'] . '\' 
							LIMIT 1';
						if(!$result = $db->sql_query($sql))
						{
							message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', '', __LINE__, __FILE__, $sql);
						}
						if( $db->sql_numrows($result) == 0 )
						{
							// no Individual Question is available > ignore the Anti-Bot-Question
							// Delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
							$sql = 'DELETE FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
								WHERE confirm_id = \'' . $abq_id . '\' 
								AND session_id = \'' . $userdata['session_id'] . '\'';
							if (!$db->sql_query($sql))
							{
								message_die(GENERAL_ERROR, 'Could not delete anti bot question answer', __LINE__, __FILE__, $sql);
							}
						}
						else
						{
							// one ore more Individual Question are available > the Anti Bot Question ID was faked
							// Do NOT delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
							$BotCounter = 1;
						}
					}
					else
					{
						// Check the the answer of this Individual Question 
						$abqrow = $db->sql_fetchrow($result);
						if ($abq_config['IndiQuests_CaseSensitive'])
						{
							// The answer check is case sensitive
							if (($abq_aw == $abqrow['answer1']) || (($abqrow['answer2'] != '') && ($abq_aw == $abqrow['answer2'])) || (($abqrow['answer3'] != '') && ($abq_aw == $abqrow['answer3'])) || (($abqrow['answer4'] != '') && ($abq_aw == $abqrow['answer4'])) || (($abqrow['answer5'] != '') && ($abq_aw == $abqrow['answer5'])))
							{
								// The answer is correct
								// Delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
								$sql = 'DELETE FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
									WHERE confirm_id = \'' . $abq_id . '\' 
									AND session_id = \'' . $userdata['session_id'] . '\'';
								if (!$db->sql_query($sql))
								{
									message_die(GENERAL_ERROR, 'Could not delete anti bot question answer', __LINE__, __FILE__, $sql);
								}
							}
							else
							{
								// The answer is wrong
								// Do NOT delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
								$BotCounter = 1;
							}
						}
						else
						{
							// The answer check is not case sensitive
							$abq_aw = strtolower($abq_aw);
							if (($abq_aw == strtolower($abqrow['answer1'])) || (($abqrow['answer2'] != '') && ($abq_aw == strtolower($abqrow['answer2']))) || (($abqrow['answer3'] != '') && ($abq_aw == strtolower($abqrow['answer3']))) || (($abqrow['answer4'] != '') && ($abq_aw == strtolower($abqrow['answer4']))) || (($abqrow['answer5'] != '') && ($abq_aw == strtolower($abqrow['answer5']))))
							{
								// The answer is correct
								// Delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
								$sql = 'DELETE FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
									WHERE confirm_id = \'' . $abq_id . '\' 
									AND session_id = \'' . $userdata['session_id'] . '\'';
								if (!$db->sql_query($sql))
								{
									message_die(GENERAL_ERROR, 'Could not delete anti bot question answer', __LINE__, __FILE__, $sql);
								}
							}
							else
							{
								// The answer is wrong
								// Do NOT delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
								$BotCounter = 1;
							}
						}
					}
				}
				elseif ($row['answer'] != $abq_aw)
				{
					// The question is an Automatic Question and the answer is wrong
					// Do NOT delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
					$BotCounter = 1;
				}
				else
				{
					// The question is an Automatic Question and the answer is correct
					// Delete the entry from the ANTI_BOT_QUEST_CONFIRM_TABLE table
					$sql = 'DELETE FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
						WHERE confirm_id = \'' . $abq_id . '\' 
						AND session_id = \'' . $userdata['session_id'] . '\'';
					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not delete anti bot question answer', __LINE__, __FILE__, $sql);
					}
				}
			}
			else
			{
				// The Anti Bot Question Confirm ID is not in the table > The ID is faked
				$BotCounter = 1;
			}
			$db->sql_freeresult($result);
		}
	}

	if ($BotCounter == 1)
	{
		// Block the posting / registration.
		$error = TRUE;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['ABQ_Form_Incorrect'];

		$BotCounter = 0;
		// How often was the answer wrong?
		$sql = 'SELECT COUNT(session_id) AS attempts 
			FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
			WHERE session_id = \'' . $userdata['session_id'] . '\' AND whichform = \'' . substr($WhichForm,0,1) . '\'';
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain anti bot question answers count', '', __LINE__, __FILE__, $sql);
		}
		if ($row = $db->sql_fetchrow($result))
		{
			// Count the block?
			if ($WhichForm == 'Registration')
			{
				if (($abq_config['lockregister'] > 0) && ($row['attempts'] > $abq_config['lockregister']))
				{
					$BotCounter = 1;
				}
				if (($abq_config['lockregister'] == 0) && ($row['attempts'] > 3))
				{
					$BotCounter = 1;
				}
			}
			elseif ($WhichForm == 'Posting')
			{
				if (($abq_config['lockguestposts'] > 0) && ($row['attempts'] > $abq_config['lockguestposts']))
				{
					$BotCounter = 1;
				}
				elseif (($abq_config['lockguestposts'] == 0) && ($row['attempts'] > 8))
				{
					$BotCounter = 1;
				}
			}
		}
		$db->sql_freeresult($result);

		// Increase the Blocked Spam Counter by one
		if (($WhichForm == 'Posting') && ($BotCounter == 1))
		{
			$sql = 'SELECT *
				FROM ' . ANTI_BOT_QUEST_CONFIG_TABLE . ' 
				WHERE config_name = \'counter_quest_post\'';
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, "Could not query anti bot question mod counter information", "", __LINE__, __FILE__, $sql);
			}
			while ( $row = $db->sql_fetchrow($result) )
			{
				$abq_counter_quest_post = $row['config_value'];
			}
			$abq_counter_quest_post++;

			$sql = 'UPDATE ' . ANTI_BOT_QUEST_CONFIG_TABLE . ' SET 
				config_value = \'' . $abq_counter_quest_post . '\' 
				WHERE config_name = \'counter_quest_post\'';
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update anti bot question mod counter", "", __LINE__, __FILE__, $sql);
			}
		}
		elseif (($WhichForm == 'Registration') && ($BotCounter == 1))
		{
			$sql = 'SELECT *
				FROM ' . ANTI_BOT_QUEST_CONFIG_TABLE . ' 
				WHERE config_name = \'counter_quest_reg\'';
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, "Could not query anti bot question mod counter information", "", __LINE__, __FILE__, $sql);
			}
			while ( $row = $db->sql_fetchrow($result) )
			{
				$abq_counter_quest_reg = $row['config_value'];
			}
			$abq_counter_quest_reg++;

			$sql = 'UPDATE ' . ANTI_BOT_QUEST_CONFIG_TABLE . ' SET 
				config_value = \'' . $abq_counter_quest_reg . '\' 
				WHERE config_name = \'counter_quest_reg\'';
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update anti bot question mod counter", "", __LINE__, __FILE__, $sql);
			}
		}
	}
}

// CreateArithmeticProblem() creates different types of arithmetic problems
// $AP_ArithmeticProblem - arithmetic problem (e.g. 34 - 13 = ?)
// $AP_Resul - the result of the arithmetic problem (e.g. 21)
function CreateArithmeticProblem(&$AP_ArithmeticProblem, &$AP_Result, &$AP_BigNumbers)
{
	global $abq_config;

	mt_srand((double)microtime()*1411410);
	$ArithmeticProblemType = mt_rand(1, 10);
	if ($ArithmeticProblemType == 1)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(500, 75000);
			$maxLimit = 99999 - $Number1;
			$Number2 = mt_rand(500, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(10, 50);
			$minLimit = 100 - $Number1;
			$Number2 = mt_rand($minLimit, 150);
		}
		$AP_ArithmeticProblem = $Number1 . '+' . $Number2;
		$AP_Result = $Number1 + $Number2;
	}
	elseif ($ArithmeticProblemType == 2)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(500, 50000);
			$maxLimit = 99000 - $Number1;
			$Number2 = mt_rand(150, $maxLimit);
			$maxLimit = 99999 - ($Number1 + $Number2);
			$Number3 = mt_rand(350, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(10, 50);
			$Number2 = mt_rand(25, 75);
			$minLimit = 100 - ($Number1 + $Number2);
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$Number3 = mt_rand($minLimit, 100);
		}
		$AP_ArithmeticProblem = $Number1 . '+' . $Number2 . '+' . $Number3;
		$AP_Result = $Number1 + $Number2 + $Number3;
	}
	elseif ($ArithmeticProblemType == 3)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(1100, 1600000);
			$minLimit = $Number1 - 999999;
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = $Number1 - 4000;
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number2 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(111, 250);
			$maxLimit = $Number1 - 100;
			$Number2 = mt_rand(5, $maxLimit);
		}
		$AP_ArithmeticProblem = $Number1 . '-' . $Number2;
		$AP_Result = $Number1 - $Number2;
	}
	elseif ($ArithmeticProblemType == 4)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(12000, 2000000);
			$minLimit = $Number1 - 1400000;
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = $Number1 - 5000;
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number2 = mt_rand($minLimit, $maxLimit);
			$minLimit = ($Number1 - $Number2) - 999999;
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = ($Number1 - $Number2) - 1500;
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(250, 300);
			$Number2 = mt_rand(25, 100);
			$maxLimit = ($Number1 - $Number2) - 100;
			$Number3 = mt_rand(1, $maxLimit);
		}
		$AP_ArithmeticProblem = $Number1 . '-' . $Number2 . '-' . $Number3;
		$AP_Result = $Number1 - $Number2 - $Number3;
	}
	elseif ($ArithmeticProblemType == 5)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(5000, 999995);
			$Number2 = mt_rand(1500, 900300);
			$minLimit = ($Number1 + $Number2) - 999999;
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = ($Number1 + $Number2) - 1490;
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(75, 150);
			$Number2 = mt_rand(50, 100);
			$maxLimit = ($Number1 + $Number2) - 100;
			$Number3 = mt_rand(5, $maxLimit);
		}
		$AP_ArithmeticProblem = $Number1 . '+' . $Number2 . '-' . $Number3;
		$AP_Result = $Number1 + $Number2 - $Number3;
	}
	elseif ($ArithmeticProblemType == 6)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(1, 250);
			$minLimit = ceil(2000/$Number1);
			$maxLimit = floor(999999/$Number1);
			$Number2 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(2, 50);
			$minLimit = ceil(100/$Number1);
			$maxLimit = floor(300/$Number1);
			$Number2 = mt_rand($minLimit, $maxLimit);
		}
		$AP_ArithmeticProblem = $Number1 . $abq_config['AutoQuests_MultiplicationSymbol'] . $Number2;
		$AP_Result = $Number1 * $Number2;
	}
	elseif ($ArithmeticProblemType == 7)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(1, 250);
			$minLimit = ceil(2000/$Number1);
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = floor(999000/$Number1);
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number2 = mt_rand($minLimit, $maxLimit);
			$maxLimit = 999999 - ($Number1 * $Number2);
			if ($maxLimit < 2)
			{
				$maxLimit = 2;
			}
			$Number3 = mt_rand(1, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(2, 50);
			$minLimit = ceil(100/$Number1);
			$maxLimit = floor(300/$Number1);
			$Number2 = mt_rand($minLimit, $maxLimit);
			$maxLimit = 350 - ($Number1 * $Number2);
			$Number3 = mt_rand(1, $maxLimit);
		}
		$AP_ArithmeticProblem = '(' . $Number1 . $abq_config['AutoQuests_MultiplicationSymbol'] . $Number2 . ')+' . $Number3;
		$AP_Result = ($Number1 * $Number2) + $Number3;
	}
	elseif ($ArithmeticProblemType == 8)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(1, 500);
			$minLimit = ceil(10000/$Number1);
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = floor(1500000/$Number1);
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number2 = mt_rand($minLimit, $maxLimit);
			$minLimit = ($Number1 * $Number2) - 999999;
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = ($Number1 * $Number2) - 9000;
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(2, 50);
			$minLimit = ceil(200/$Number1);
			$maxLimit = floor(350/$Number1);
			$Number2 = mt_rand($minLimit, $maxLimit);
			$maxLimit = ($Number1 * $Number2) - 100;
			$Number3 = mt_rand(1, $maxLimit);
		}
		$AP_ArithmeticProblem = '(' . $Number1 . $abq_config['AutoQuests_MultiplicationSymbol'] . $Number2 . ')-' . $Number3;
		$AP_Result = ($Number1 * $Number2) - $Number3;
	}
	elseif ($ArithmeticProblemType == 9)
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(1, 250);
			$maxLimit = 500 - $Number1;
			$Number2 = mt_rand(1, $maxLimit);
			$minLimit = ceil(3450/($Number1+$Number2));
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = floor(999990/($Number1+$Number2));
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(2, 25);
			$Number2 = mt_rand(1, 25);
			$minLimit = ceil(100/($Number1+$Number2));
			$maxLimit = floor(350/($Number1+$Number2));
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		$AP_ArithmeticProblem = '(' . $Number1 . '+' . $Number2 . ') ' . $abq_config['AutoQuests_MultiplicationSymbol'] . ' ' . $Number3;
		$AP_Result = ($Number1 + $Number2) * $Number3;
	}
	else
	{
		if ($AP_BigNumbers)
		{
			$Number1 = mt_rand(25000, 450000);
			$minLimit = $Number1 - 449905;
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = $Number1 - 20000;
			$Number2 = mt_rand($minLimit, $maxLimit);
			$minLimit = ceil(4500/($Number1-$Number2));
			if ($minLimit < 1)
			{
				$minLimit = 1;
			}
			$maxLimit = floor(999990/($Number1-$Number2));
			if ($maxLimit <= $minLimit)
			{
				$maxLimit = $minLimit + 1;
			}
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		else
		{
			$Number1 = mt_rand(100, 250);
			$minLimit = $Number1 - 50;
			$maxLimit = $Number1 - 2;
			$Number2 = mt_rand($minLimit, $maxLimit);
			$minLimit = ceil(100/($Number1-$Number2));
			$maxLimit = floor(350/($Number1-$Number2));
			$Number3 = mt_rand($minLimit, $maxLimit);
		}
		$AP_ArithmeticProblem = '(' . $Number1 . '-' . $Number2 . ') ' . $abq_config['AutoQuests_MultiplicationSymbol'] . ' ' . $Number3;
		$AP_Result = ($Number1 - $Number2) * $Number3;
	}
	$AP_ArithmeticProblem .= '=?';
}

// CreateFakeArithmeticProblem() creates different types of fake arithmetic problems
// $output - fake arithmetic problem (e.g. 34 - 13 = ?; the correct answer is: 3413)
function CreateFakeArithmeticProblem()
{
	global $abq_config;

	mt_srand((double)microtime()*1411410);
	$ArithmeticProblemType = mt_rand(1, 6);
	if ($ArithmeticProblemType == 1)
	{
		$Number1 = mt_rand(111, 9999);
		$Number2 = mt_rand(111, 9999);
		$output = $Number1 . '+' . $Number2;
	}
	elseif ($ArithmeticProblemType == 2)
	{
		$Number1 = mt_rand(1, 999);
		$Number2 = mt_rand(1, 999);
		$NumberLen = strlen($Number1.$Number2);
		$NumberLen = 7 - $NumberLen;
		$minLimit = 1;
		$maxLimit = 99;
		if ($NumberLen > 1)
		{
			for ($i=0; $i<$NumberLen; $i++)
			{
				$minLimit = $minLimit * 10;
				$maxLimit = ($maxLimit * 10) + 9;
			}
		}
		$Number3 = mt_rand($minLimit, $maxLimit);
		$output = $Number1 . '+' . $Number2 . '+' . $Number3;
	}
	elseif ($ArithmeticProblemType == 3)
	{
		$Number1 = mt_rand(111, 9999);
		$Number2 = mt_rand(111, 9999);
		if ($Number1 > $Number2)
		{
			$output = $Number1 . '-' . $Number2;
		}
		else
		{
			$output = $Number2 . '-' . $Number1;
		}
	}
	elseif ($ArithmeticProblemType == 4)
	{
		$Number1 = mt_rand(1000, 9999);
		$Number2 = mt_rand(1, 99);
		$NumberLen = strlen($Number1.$Number2);
		$NumberLen = 7 - $NumberLen;
		$minLimit = 1;
		$maxLimit = 99;
		if ($NumberLen > 1)
		{
			for ($i=0; $i<$NumberLen; $i++)
			{
				$minLimit = $minLimit * 10;
				$maxLimit = ($maxLimit * 10) + 9;
			}
		}
		$Number3 = mt_rand($minLimit, $maxLimit);
		$output = $Number1 . '-' . $Number2 . '-' . $Number3;
	}
	elseif ($ArithmeticProblemType == 5)
	{
		$Number1 = mt_rand(10, 999);
		$Number2 = mt_rand(100, 999);
		$NumberLen = strlen($Number1.$Number2);
		$NumberLen = 7 - $NumberLen;
		$minLimit = 1;
		$maxLimit = 99;
		if ($NumberLen > 1)
		{
			for ($i=0; $i<$NumberLen; $i++)
			{
				$minLimit = $minLimit * 10;
				$maxLimit = ($maxLimit * 10) + 9;
			}
		}
		$Number3 = mt_rand($minLimit, $maxLimit);
		if ($Number1 > $Number3)
		{
			$output = $Number1 . '+' . $Number2 . '-' . $Number3;
		}
		else
		{
			$output = $Number3 . '+' . $Number2 . '-' . $Number1;
		}
	}
	else
	{
		$Number1 = mt_rand(111, 9999);
		$Number2 = mt_rand(111, 9999);
		$output = $Number1 . $abq_config['AutoQuests_MultiplicationSymbol'] . $Number2;
	}
	$output = preg_replace('/0/i', '1', $output);
	$output .= '=?';
	return $output;
}

// CreateCharacters() creates different types of charakter sets
// $WelcherIndex = 'a'  -  alphabetic characters
// $WelcherIndex = '1'  -  numbers
// $WelcherIndex = '#'  -  signs
function CreateCharacters($WhichIndex)
{
	$input = dss_rand();
	$input = base_convert($input, 16, 10);
	if ($WhichIndex == 'a')
	{
		$index = 'abdefghjmnpqrtyABDEFGHJMNPQRTUVWXYZ';
	}
	elseif ($WhichIndex == '#')
	{
		$index = '%=+*()/:;.,!?';
	}
	else
	{
		$index = '123456789';
	}
	$base = strlen($index);
	$output = '';
	for ($i=floor(log10($input)/log10($base)); $i >= 0; $i--)
	{
		$j = floor($input / pow($base, $i));
		$output .= substr($index, $j, 1);
		$input = $input - ($j * pow($base, $i));
	}
	return $output;
}

// ChaosCharacterSet() creates a charakter set with numbers and alphabetic characters
function ChaosCharacterSet(&$quest_line1, &$quest_line2, &$confirm_answer)
{
	mt_srand((double)microtime()*1241240);
	$input = dss_rand();
	$input = base_convert($input, 16, 10);
	$index = 'abdefghjmnpqrtyABDEFGHJMNPQRTUVWXYZ123456789';
	$base = strlen($index);
	$output = '';
	for ($i=floor(log10($input)/log10($base)); $i>=0; $i--)
	{
		$j = floor($input / pow($base, $i));
		$output .= substr($index, $j, 1);
		$input = $input - ($j * pow($base, $i));
	}
	$SLaenge = mt_rand(6, 8);
	$output = substr($output, 0, $SLaenge);
	for ($j=strlen($output); $j<$SLaenge; $j++)
	{
		$output .= 'A';
	}
	$confirm_answer = $output;
	$outputarr = array();
	for ($i=0; $i<$SLaenge; $i++)
	{
		$outputarr[$i] = ($i+1) . substr($output, $i, 1);
	}
	shuffle($outputarr);
	for ($i=0; $i<$SLaenge; $i++)
	{
		$quest_line1 .= substr($outputarr[$i], 1, 1) . ' ';
		$quest_line2 .= substr($outputarr[$i], 0, 1) . ' ';
	}
	$quest_line1 = trim($quest_line1);
	$quest_line2 = trim($quest_line2);
}

// ABQAutoAnswers() creates wrong answers for the Automatic Question multiple choise
// $AnswerType - defines the type of answers (only numbers (two different types), only alphabetic characters, numbers and alphabetic characters)
function ABQAutoAnswers($AnswerType=1, &$AnswerSelectArray, $AnswerLen=0)
{
	global $abq_config;

	unset($i);
	if (($AnswerType == 1) || ($AnswerType == 2))
	{
		if ($AnswerType == 2)
		{
			$index = 'abdefghjmnpqrtyABDEFGHJMNPQRTUVWXYZ123456789';
		}
		else
		{
			$index = 'abdefghjmnpqrtyABDEFGHJMNPQRTUVWXYZ';
		}
		for ($i=1; $i<11; $i++)
		{
			unset($input);
			$input = dss_rand();
			$input = base_convert($input, 16, 10);
			$base = strlen($index);
			$output = '';
			for ($j=floor(log10($input)/log10($base)); $j>=0; $j--)
			{
				$k = floor($input / pow($base, $j));
				$output .= substr($index, $k, 1);
				$input = $input - ($k * pow($base, $j));
			}
			$SLaenge = mt_rand(6, 8);
			$AnswerSelectArray[$i] = substr($output, 0, $SLaenge);
			if ($AnswerSelectArray[0] == $AnswerSelectArray[$i])
			{
				$AnswerSelectArray[$i] .= 'a';
			}
		}
	}
	else
	{
		if ($AnswerType == 4)
		{
			$minLimit = 101;
			if ($abq_config['AutoQuests_LargeNumbers'] == 0)
			{
				$maxLimit = 350;
			}
			else
			{
				$maxLimit = 999999;
			}
		}
		else
		{
			if (($AnswerLen >= 4) && ($AnswerLen <= 9))
			{
				$minLimit = pow(10,($AnswerLen-1));
				$maxLimit = preg_replace('/[0-9]/is', '9', $minLimit);
			}
			else
			{
				$minLimit = 12121;
				$maxLimit = 99999999;
			}
		}
		for ($i=1; $i<11; $i++)
		{
			$AnswerSelectArray[$i] = mt_rand($minLimit, $maxLimit);
			unset($j);
			for ($j=0; $j<$i; $j++)
			{
				if ($AnswerSelectArray[$j] == $AnswerSelectArray[$i])
				{
					$AnswerSelectArray[$i]++;
					$j = 0;
				}
			}
		}
	}
}

// ABQ_MultiImages() creates the "multiimage" images
// $QuestionType - Type of Question: A = Automatic Image Question; I = Individual Question type 2
function ABQ_MultiImages($confirm_id, $quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat, $QuestionType)
{
	global $abq_quest, $phpbb_root_path, $phpEx;

	include($phpbb_root_path . 'includes/functions_abq_image2.' . $phpEx);
	if ($QuestionType == 'I')
	{
		ShowImage('_'.$quest_line1, '', '', '', '', $MultiImageFormat);
	}
	else
	{
		ShowImage($quest_line1, $quest_line2, $quest_line3, $quest_line4, $quest_colour, $MultiImageFormat);
	}
	$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=21') . '" />';
	$abq_quest .= '<br clear="all" />';
	$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=32') . '" />';
	if (($MultiImageFormat == 1) || ($MultiImageFormat == 2))
	{
		$abq_quest .= '<br clear="all" />';
	}
	$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=54') . '" />';
	if (($MultiImageFormat == 1) || ($MultiImageFormat == 2) || ($MultiImageFormat == 5) || ($MultiImageFormat == 6))
	{
		$abq_quest .= '<br clear="all" />';
	}
	$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=1') . '" />';
	if ($MultiImageFormat > 1)
	{
		if (($MultiImageFormat == 2) || ($MultiImageFormat == 3) || ($MultiImageFormat == 4))
		{
			$abq_quest .= '<br clear="all" />';
		}
		$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=17') . '" />';
		if ($MultiImageFormat > 3)
		{
			if ($MultiImageFormat == 5)
			{
				$abq_quest .= '<br clear="all" />';
			}
			$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=9') . '" />';
			if ($MultiImageFormat == 6)
			{
				$abq_quest .= '<br clear="all" />';
			}
			$abq_quest .= '<img src="' . $phpbb_root_path . append_sid('abq_image.'.$phpEx.'?b=' . $confirm_id . '&amp;n=20') . '" />';

		}
	}
	$abq_quest .= '<br clear="all" />';
}

// ABQ_gdVersion() checks the version of PHP, FreeType Library and GD Library
// $ABQ_FTLib_Version: 0 - FreeType Library not installed; 1 - FreeType Library installed
// $ABQ_GDLib_Version: 0 - GD Library not installed; 1 - GD Library Version 1 installed; 2 - GD Library Version 2+ installed
// $ABQ_PHP_Version (array): PHP Version; e.g. PHP Version 4.0.6 > $ABQ_PHP_Version[0] = 4, $ABQ_PHP_Version[1] = 0, $ABQ_PHP_Version[2] = 6
function ABQ_gdVersion()
{
	global $abq_config, $ABQ_FTLib_Version, $ABQ_GDLib_Version, $ABQ_PHP_Version;

	$ABQ_PHP_Version = phpversion();
	$ABQ_PHP_Version = explode('.', $ABQ_PHP_Version);
	if (!is_array($ABQ_PHP_Version))
	{
		$ABQ_PHP_Version[0] = 0;
	}
	for ($i=0; $i<3; $i++)
	{
		if (!isset($ABQ_PHP_Version[$i]))
		{
			$ABQ_PHP_Version[$i] = 0;
		}
		else
		{
			$ABQ_PHP_Version[$i] = intval($ABQ_PHP_Version[$i]);
		}
	}

	if ($abq_config['lib_gd'] == 1)
	{
		$ABQ_GDLib_Version = 1;
	}
	elseif ($abq_config['lib_gd'] == 2)
	{
		$ABQ_GDLib_Version = 2;
	}
	else
	{
		$ABQ_GDLib_Version = 0;
	}
	if ($abq_config['lib_ft'] == 1)
	{
		$ABQ_FTLib_Version = 1;
	}
	else
	{
		$ABQ_FTLib_Version = 0;
	}

	if (($abq_config['lib_gd'] != 3) && ($abq_config['lib_ft'] != 2))
	{
		return;
	}

	if (!extension_loaded('gd'))
	{
		return;
	}

	if ((function_exists('imagettftext')) && ($abq_config['lib_ft'] == 2))
	{
		$ABQ_FTLib_Version = 1;
	}

	// If phpinfo() is enabled use it
	if (!preg_match('/phpinfo/', ini_get('disable_functions')))
	{
		ob_start();
		phpinfo();
		$ABQ_PHPinfo = ob_get_contents();
		ob_end_clean();
		if ((preg_match('/--with-freetype-dir=yes/is', $ABQ_PHPinfo)) && ($ABQ_FTLib_Version == 1))
		{}
		elseif (($abq_config['lib_ft'] == 2) && ($ABQ_FTLib_Version != 1))
		{
			$ABQ_FTLib_Version = 0;
		}
		if ($abq_config['lib_gd'] == 3)
		{
			$info = stristr($ABQ_PHPinfo, 'gd version');
			preg_match('/\d/', $info, $match);
			$ABQ_GDLib_Version = $match[0];
			if ($ABQ_GDLib_Version > 2)
			{
				$ABQ_GDLib_Version = 2;
			}
		}
		return;
	}

	// Use the gd_info() function if possible.
	if (function_exists('gd_info'))
	{
		$ver_info = gd_info();
		if ($abq_config['lib_gd'] == 3)
		{
			preg_match('/\d/', $ver_info['GD Version'], $match);
			$ABQ_GDLib_Version = $match[0];
			if ($ABQ_GDLib_Version > 2)
			{
				$ABQ_GDLib_Version = 2;
			}
		}
		if (($ver_info['FreeType Support']) && (strtolower($ver_info['FreeType Linkage']) == 'with freetype') && ($ABQ_FTLib_Version == 1))
		{}
		elseif (($abq_config['lib_ft'] == 2) && ($ABQ_FTLib_Version != 1))
		{
			$ABQ_FTLib_Version = 0;
		}
		return;
	}
}
?>