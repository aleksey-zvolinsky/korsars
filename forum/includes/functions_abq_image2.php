<?php
/***************************************************************************
 *                          functions_abq_image2.php
 *                          ------------------------
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

function ShowImage($Line1, $Line2, $Line3, $Line4, $ColoredCharacter, $CacheImage)
{
	global $abq_config, $db, $ABQ_FTLib_Version, $ABQ_GDLib_Version, $phpbb_root_path, $userdata;

	unset($ABQ_Text);
	if (substr($Line1,0,1) == '_')
	{
		$sql = 'SELECT question 
			FROM ' . ANTI_BOT_QUEST_TABLE . '
			WHERE id = \'' . substr($Line1,1) . '\' 
			ORDER BY id 
			LIMIT 1';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain anti-bot-question information', '', __LINE__, __FILE__, $sql);
		}
		if ($db->sql_numrows($result) > 0)
		{
			$ABQ_Row = $db->sql_fetchrow($result);
		}
		else
		{
			exit;
		}
		$ABQ_Text = explode(' ', $ABQ_Row['question']);
		if ((!isset($ABQ_Text)) || (!is_array($ABQ_Text)))
		{
			exit;
		}
	}

	mt_srand((double)microtime()*2123435);

	$ABQ_PHP_Version = array();
	$ABQ_FTLib_Version = 0;
	$ABQ_GDLib_Version = 0;
	ABQ_gdVersion();

	if ((!isset($ColoredCharacter)) || (($ColoredCharacter != 'G') && ($ColoredCharacter != 'R')))
	{
		$ColoredCharacter = '';
	}

	// Load the Image Configuration
	$ABQConf_ImageJPG = intval($abq_config['ImageFormat']);
	$ABQConf_ImageQuality = intval($abq_config['JPG_Quality']);
	$ABQConf_MaxEffects = intval($abq_config['max_Effects']);
	$ABQConf_GridWidth = intval($abq_config['Effect_GridWidth']);
	$ABQConf_GridHeight = intval($abq_config['Effect_GridHeight']);
	$ABQConf_SeparatingLines = intval($abq_config['Effect_SeparatingLines']);
	$ABQConf_BackgroundText = intval($abq_config['Effect_BGText']);
	$ABQConf_Grid = intval($abq_config['Effect_Grid']);
	$ABQConf_GridFilled = intval($abq_config['Effect_FilledGrid']);
	$ABQConf_Ellipses = intval($abq_config['Effect_Ellipses']);
	$ABQConf_Arcs = intval($abq_config['Effect_Arcs']);
	$ABQConf_Lines = intval($abq_config['Effect_Lines']);
	$ABQConf_FontSize = intval($abq_config['fontsize']);
	$Color_BG_Red1 = intval($abq_config['Color_BG_R1']);
	$Color_BG_Red2 = intval($abq_config['Color_BG_R2']);
	$Color_BG_Green1 = intval($abq_config['Color_BG_G1']);
	$Color_BG_Green2 = intval($abq_config['Color_BG_G2']);
	$Color_BG_Blue1 = intval($abq_config['Color_BG_B1']);
	$Color_BG_Blue2 = intval($abq_config['Color_BG_B2']);
	$Color_ColoredCharacter1_Red = intval($abq_config['Color_Text_Question1_R']);
	$Color_ColoredCharacter1_Green = intval($abq_config['Color_Text_Question1_G']);
	$Color_ColoredCharacter1_Blue = intval($abq_config['Color_Text_Question1_B']);
	$Color_ColoredCharacter2_Red = intval($abq_config['Color_Text_Question2_R']);
	$Color_ColoredCharacter2_Green = intval($abq_config['Color_Text_Question2_G']);
	$Color_ColoredCharacter2_Blue = intval($abq_config['Color_Text_Question2_B']);
	$Color_Grid1_Red1 = intval($abq_config['Color_Grid1_R1']);
	$Color_Grid1_Red2 = intval($abq_config['Color_Grid1_R2']);
	$Color_Grid1_Green1 = intval($abq_config['Color_Grid1_G1']);
	$Color_Grid1_Green2 = intval($abq_config['Color_Grid1_G2']);
	$Color_Grid1_Blue1 = intval($abq_config['Color_Grid1_B1']);
	$Color_Grid1_Blue2 = intval($abq_config['Color_Grid1_B2']);
	$Color_Grid2_Red1 = intval($abq_config['Color_Grid2_R1']);
	$Color_Grid2_Red2 = intval($abq_config['Color_Grid2_R2']);
	$Color_Grid2_Green1 = intval($abq_config['Color_Grid2_G1']);
	$Color_Grid2_Green2 = intval($abq_config['Color_Grid2_G2']);
	$Color_Grid2_Blue1 = intval($abq_config['Color_Grid2_B1']);
	$Color_Grid2_Blue2 = intval($abq_config['Color_Grid2_B2']);
	$Color_Grid3_Red1 = intval($abq_config['Color_Grid3_R1']);
	$Color_Grid3_Red2 = intval($abq_config['Color_Grid3_R2']);
	$Color_Grid3_Green1 = intval($abq_config['Color_Grid3_G1']);
	$Color_Grid3_Green2 = intval($abq_config['Color_Grid3_G2']);
	$Color_Grid3_Blue1 = intval($abq_config['Color_Grid3_B1']);
	$Color_Grid3_Blue2 = intval($abq_config['Color_Grid3_B2']);
	$Color_Grid4_Red1 = intval($abq_config['Color_Grid4_R1']);
	$Color_Grid4_Red2 = intval($abq_config['Color_Grid4_R2']);
	$Color_Grid4_Green1 = intval($abq_config['Color_Grid4_G1']);
	$Color_Grid4_Green2 = intval($abq_config['Color_Grid4_G2']);
	$Color_Grid4_Blue1 = intval($abq_config['Color_Grid4_B1']);
	$Color_Grid4_Blue2 = intval($abq_config['Color_Grid4_B2']);
	$Color_GridFilled_Red1 = intval($abq_config['Color_FilledGrid_R1']);
	$Color_GridFilled_Red2 = intval($abq_config['Color_FilledGrid_R2']);
	$Color_GridFilled_Green1 = intval($abq_config['Color_FilledGrid_G1']);
	$Color_GridFilled_Green2 = intval($abq_config['Color_FilledGrid_G2']);
	$Color_GridFilled_Blue1 = intval($abq_config['Color_FilledGrid_B1']);
	$Color_GridFilled_Blue2 = intval($abq_config['Color_FilledGrid_B2']);
	$Color_Ellipses_Red1 = intval($abq_config['Color_Ellipses_R1']);
	$Color_Ellipses_Red2 = intval($abq_config['Color_Ellipses_R2']);
	$Color_Ellipses_Green1 = intval($abq_config['Color_Ellipses_G1']);
	$Color_Ellipses_Green2 = intval($abq_config['Color_Ellipses_G2']);
	$Color_Ellipses_Blue1 = intval($abq_config['Color_Ellipses_B1']);
	$Color_Ellipses_Blue2 = intval($abq_config['Color_Ellipses_B2']);
	$Color_PartialEllipses_Red1 = intval($abq_config['Color_PartialEllipses_R1']);
	$Color_PartialEllipses_Red2 = intval($abq_config['Color_PartialEllipses_R2']);
	$Color_PartialEllipses_Green1 = intval($abq_config['Color_PartialEllipses_G1']);
	$Color_PartialEllipses_Green2 = intval($abq_config['Color_PartialEllipses_G2']);
	$Color_PartialEllipses_Blue1 = intval($abq_config['Color_PartialEllipses_B1']);
	$Color_PartialEllipses_Blue2 = intval($abq_config['Color_PartialEllipses_B2']);
	$Color_Lines_Red1 = intval($abq_config['Color_Lines_R1']);
	$Color_Lines_Red2 = intval($abq_config['Color_Lines_R2']);
	$Color_Lines_Green1 = intval($abq_config['Color_Lines_G1']);
	$Color_Lines_Green2 = intval($abq_config['Color_Lines_G2']);
	$Color_Lines_Blue1 = intval($abq_config['Color_Lines_B1']);
	$Color_Lines_Blue2 = intval($abq_config['Color_Lines_B2']);
	$Color_Arcs_Red1 = intval($abq_config['Color_Arcs_R1']);
	$Color_Arcs_Red2 = intval($abq_config['Color_Arcs_R2']);
	$Color_Arcs_Green1 = intval($abq_config['Color_Arcs_G1']);
	$Color_Arcs_Green2 = intval($abq_config['Color_Arcs_G2']);
	$Color_Arcs_Blue1 = intval($abq_config['Color_Arcs_B1']);
	$Color_Arcs_Blue2 = intval($abq_config['Color_Arcs_B2']);
	$Color_BGText_Red1 = intval($abq_config['Color_BGText_R1']);
	$Color_BGText_Red2 = intval($abq_config['Color_BGText_R2']);
	$Color_BGText_Green1 = intval($abq_config['Color_BGText_G1']);
	$Color_BGText_Green2 = intval($abq_config['Color_BGText_G2']);
	$Color_BGText_Blue1 = intval($abq_config['Color_BGText_B1']);
	$Color_BGText_Blue2 = intval($abq_config['Color_BGText_B2']);
	$Color_Text_Red1 = intval($abq_config['Color_Text_R1']);
	$Color_Text_Red2 = intval($abq_config['Color_Text_R2']);
	$Color_Text_Green1 = intval($abq_config['Color_Text_G1']);
	$Color_Text_Green2 = intval($abq_config['Color_Text_G2']);
	$Color_Text_Blue1 = intval($abq_config['Color_Text_B1']);
	$Color_Text_Blue2 = intval($abq_config['Color_Text_B2']);
	$Color_SeparatingLines_Red1 = intval($abq_config['Color_SeparatingLines_R1']);
	$Color_SeparatingLines_Red2 = intval($abq_config['Color_SeparatingLines_R2']);
	$Color_SeparatingLines_Green1 = intval($abq_config['Color_SeparatingLines_G1']);
	$Color_SeparatingLines_Green2 = intval($abq_config['Color_SeparatingLines_G2']);
	$Color_SeparatingLines_Blue1 = intval($abq_config['Color_SeparatingLines_B1']);
	$Color_SeparatingLines_Blue2 = intval($abq_config['Color_SeparatingLines_B2']);

	// Count the active effects and activate/deactivate random effects
	$activeEffects = 0;
	if ($ABQConf_BackgroundText == 1)
	{
		$activeEffects++;
	}
	if ($ABQConf_Grid == 1)
	{
		$activeEffects++;
	}
	if ($ABQConf_Ellipses == 1)
	{
		if (($ABQ_PHP_Version[0] > 4) || (($ABQ_PHP_Version[0] == 4) && ($ABQ_PHP_Version[1] > 0)) || (($ABQ_PHP_Version[0] == 4) && ($ABQ_PHP_Version[1] == 0) && ($ABQ_PHP_Version[2] >= 6)))
		{
			$activeEffects++;
		}
		else
		{
			$ABQConf_Ellipses = 0;
		}
	}
	if ($ABQConf_Arcs == 1)
	{
		$activeEffects++;
	}
	if ($ABQConf_Lines == 1)
	{
		$activeEffects++;
	}

	if ($ABQConf_BackgroundText == 2)
	{
		if (($ABQConf_MaxEffects == 0) || ($ABQConf_MaxEffects > $activeEffects))
		{
			$ABQConf_BackgroundText = mt_rand(0, 1);
			if ($ABQConf_MaxEffects != 0)
			{
				$activeEffects += $ABQConf_BackgroundText;
			}
		}
		else
		{
			$ABQConf_BackgroundText = 0;
		}
	}
	if ($ABQConf_Grid == 2)
	{
		if (($ABQConf_MaxEffects == 0) || ($ABQConf_MaxEffects > $activeEffects))
		{
			$ABQConf_Grid = mt_rand(0, 1);
			if ($ABQConf_MaxEffects != 0)
			{
				$activeEffects += $ABQConf_Grid;
			}
		}
		else
		{
			$ABQConf_Grid = 0;
		}
	}
	if ($ABQConf_GridFilled == 2)
	{
		$ABQConf_GridFilled = mt_rand(0, 1);
	}
	if ($ABQConf_Ellipses == 2)
	{
		if ((($ABQ_PHP_Version[0] > 4) || (($ABQ_PHP_Version[0] == 4) && ($ABQ_PHP_Version[1] > 0)) || (($ABQ_PHP_Version[0] == 4) && ($ABQ_PHP_Version[1] == 0) && ($ABQ_PHP_Version[2] >= 6))) && (($ABQConf_MaxEffects == 0) || ($ABQConf_MaxEffects > $activeEffects)))
		{
			$ABQConf_Ellipses = mt_rand(0, 1);
			if ($ABQConf_MaxEffects != 0)
			{
				$activeEffects += $ABQConf_Ellipses;
			}
		}
		else
		{
			$ABQConf_Ellipses = 0;
		}
	}
	if ($ABQConf_Arcs == 2)
	{
		if (($ABQConf_MaxEffects == 0) || ($ABQConf_MaxEffects > $activeEffects))
		{
			$ABQConf_Arcs = mt_rand(0, 1);
			if ($ABQConf_MaxEffects != 0)
			{
				$activeEffects += $ABQConf_Arcs;
			}
		}
		else
		{
			$ABQConf_Arcs = 0;
		}
	}
	if ($ABQConf_Lines == 2)
	{
		if (($ABQConf_MaxEffects == 0) || ($ABQConf_MaxEffects > $activeEffects))
		{
			$ABQConf_Lines = mt_rand(0, 1);
			if ($ABQConf_MaxEffects != 0)
			{
				$activeEffects += $ABQConf_Lines;
			}
		}
		else
		{
			$ABQConf_Lines = 0;
		}
	}

	if ($ABQConf_GridWidth == 0)
	{
		$ABQConf_GridWidth = mt_rand(10, 90);
	}
	if ($ABQConf_GridHeight == 0)
	{
		$ABQConf_GridHeight = mt_rand(10, 40);
	}

	// Image-Type? JPG or PNG
	if ($ABQConf_ImageJPG)
	{
		$mimeTyp = 'image/jpeg';
		if (($ABQConf_ImageQuality < 50) || ($ABQConf_ImageQuality > 90))
		{
			$ABQConf_ImageQuality = 80;
		}
	}
	else
	{
		$mimeTyp = 'image/png';
	}

	$phpbb_root_realpath = str_replace('index.'.$phpEx, '', realpath($phpbb_root_path.'index.'.$phpEx));

	$LineSpacing = 10;
	$ImageMinWidth = 25;
	$ImageMinHeight = 10;

	if (($ABQConf_FontSize < 15) || ($ABQConf_FontSize > 40))
	{
		$ABQConf_FontSize = 20;
	}

	if (substr($Line1,0,1) == '_')
	{
		// Individual Image Question > Create the text lines
		$Text_Textlength = strlen($ABQ_Row['question']);
		unset($i);
		unset($j);
		unset($Text_longestWord);
		$j = count($ABQ_Text);
		for ($i=0; $i<$j; $i++)
		{
			if (strlen($ABQ_Text[$i]) > $Text_longestWord)
			{
				$Text_longestWord = strlen($ABQ_Text[$i]);
			}
		}
		$Text_CharactersPerLine = ceil($Text_Textlength / 4);
		if ($Text_CharactersPerLine < $Text_longestWord)
		{
			$Text_CharactersPerLine = $Text_longestWord;
		}
		if (($ABQ_FTLib_Version) && ($Text_CharactersPerLine < 10))
		{
			$Text_CharactersPerLine = 10;
		}
		elseif ((!$ABQ_FTLib_Version) && ($Text_CharactersPerLine < 20))
		{
			$Text_CharactersPerLine = 20;
		}

		unset($i);
		$Line1 = '';
		$Line2 = '';
		$Line3 = '';
		$Line4 = '';
		$Line = 1;
		$CharactersInLine = 0;
		$LineCreationFinished = 1;
		for ($i=0; $i<$j; $i++)
		{
			if (($CharactersInLine > 0) && (($CharactersInLine + 1 + strlen($ABQ_Text[$i])) > $Text_CharactersPerLine))
			{
				$Line++;
				$CharactersInLine = 0;
				if ($Line > 4)
				{
					$LineCreationFinished = 0;
					break;
				}
			}
			$CharactersInLine = $CharactersInLine + strlen($ABQ_Text[$i]);
			if (${'Line'.$Line} != '')
			{
				$CharactersInLine++;
				${'Line'.$Line} .= ' ';
			}
			${'Line'.$Line} .= $ABQ_Text[$i];
		}

		if ($LineCreationFinished == 0)
		{
			$LineCreationFinished = 1;
			$Text_CharactersPerLine = ceil($Text_Textlength / 3);
			if ($Text_CharactersPerLine < $Text_longestWord)
			{
				$LineCreationFinished = 0;
			}
			elseif (($ABQ_FTLib_Version) && ($Text_CharactersPerLine < 10))
			{
				$LineCreationFinished = 0;
			}
			elseif ((!$ABQ_FTLib_Version) && ($Text_CharactersPerLine < 20))
			{
				$LineCreationFinished = 0;
			}

			if ($LineCreationFinished)
			{
				unset($i);
				$Line1 = '';
				$Line2 = '';
				$Line3 = '';
				$Line4 = '';
				$Line = 1;
				$CharactersInLine = 0;
				for ($i=0; $i<$j; $i++)
				{
					if (($CharactersInLine > 0) && (($CharactersInLine + 1 + strlen($ABQ_Text[$i])) > $Text_CharactersPerLine))
					{
						$Line++;
						$CharactersInLine = 0;
						if ($Line > 4)
						{
							$LineCreationFinished = 0;
							break;
						}
					}
					$CharactersInLine = $CharactersInLine + strlen($ABQ_Text[$i]);
					if (${'Line'.$Line} != '')
					{
						$CharactersInLine++;
						${'Line'.$Line} .= ' ';
					}
					${'Line'.$Line} .= $ABQ_Text[$i];
				}
			}
		}

		if ($LineCreationFinished == 0)
		{
			$LineCreationFinished = 1;
			$Text_CharactersPerLine = ceil($Text_Textlength / 2);
			if ($Text_CharactersPerLine < $Text_longestWord)
			{
				$LineCreationFinished = 0;
			}
			elseif (($ABQ_FTLib_Version) && ($Text_CharactersPerLine < 10))
			{
				$LineCreationFinished = 0;
			}
			elseif ((!$ABQ_FTLib_Version) && ($Text_CharactersPerLine < 20))
			{
				$LineCreationFinished = 0;
			}

			if ($LineCreationFinished)
			{
				unset($i);
				$Line1 = '';
				$Line2 = '';
				$Line3 = '';
				$Line4 = '';
				$Line = 1;
				$CharactersInLine = 0;
				for ($i=0; $i<$j; $i++)
				{
					if (($CharactersInLine > 0) && (($CharactersInLine + 1 + strlen($ABQ_Text[$i])) > $Text_CharactersPerLine))
					{
						$Line++;
						$CharactersInLine = 0;
						if ($Line > 4)
						{
							$LineCreationFinished = 0;
							break;
						}
					}
					$CharactersInLine = $CharactersInLine + strlen($ABQ_Text[$i]);
					if (${'Line'.$Line} != '')
					{
						$CharactersInLine++;
						${'Line'.$Line} .= ' ';
					}
					${'Line'.$Line} .= $ABQ_Text[$i];
				}
			}
		}

		if ($LineCreationFinished == 0)
		{
			$Line1 = $ABQ_Row['question'];
			$Line2 = '';
			$Line3 = '';
			$Line4 = '';
		}
	}

	$NumberOfTextlines = 0;
	for ($i=1; $i<5; $i++)
	{
		if (${'Line'.$i} != '')
		{
			$NumberOfTextlines++;
			unset($j);
			unset($k);
			$k = strlen(${'Line'.$i});
			for ($j=0; $j<$k; $j++)
			{
				${'LineChars'.$i}[$j]['Character'] = ${'Line'.$i}{$j};
			}
		}
		else
		{
			break;
		}
	}

	// The following check is necessary for Automatic Image Question
	if ($NumberOfTextlines < 1)
	{
		exit;
	}
	elseif ($NumberOfTextlines == 1)
	{
		$Line2 = '';
		$Line3 = '';
		$Line4 = '';
	}
	elseif ($NumberOfTextlines == 2)
	{
		$Line3 = '';
		$Line4 = '';
	}
	elseif ($NumberOfTextlines == 3)
	{
		$Line4 = '';
	}

	$Fonts = array();
	$FontsCount = 0;
	if ($FontsFolder = @opendir($phpbb_root_realpath.'abq_mod/fonts/'))
	{
		while (true == ($Files = @readdir($FontsFolder)))
		{
			if ((substr(strtolower($Files), -4) == '.ttf'))
			{
				$Fonts[] = $phpbb_root_realpath . 'abq_mod/fonts/' . $Files;
			}
		}
		closedir($FontsFolder);
		$FontsCount = count($Fonts) - 1;
	}

	if ($ABQ_FTLib_Version)
	{
		if ($Line4 != '')
		{
			$ABQConf_FontSize -= 6;
		}
		elseif ($Line3 != '')
		{
			$ABQConf_FontSize -= 4;
		}
		elseif ($Line2 != '')
		{
			$ABQConf_FontSize -= 2;
		}
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			if ((!empty(${'LineChars'.$i})) && (is_array(${'LineChars'.$i})))
			{
				unset($j);
				unset($k);
				unset($l);
				$k = count(${'LineChars'.$i});
				$l = 0;
				for ($j=0; $j<$k; $j++)
				{
					if (($ColoredCharacter != '') && (${'LineChars'.$i}[$j]['Character'] == '+'))
					{
						$j++;
						if ($j >= $k)
						{
							break;
						}
						${'LinePrintChar'.$i}[$l]['Color'] = $ColoredCharacter;
					}
					else
					{
						${'LinePrintChar'.$i}[$l]['Color'] = '';
					}
					${'LinePrintChar'.$i}[$l]['Character'] = ${'LineChars'.$i}[$j]['Character'];
					${'LinePrintChar'.$i}[$l]['Font'] = $Fonts[rand(0, $FontsCount)];
					${'LinePrintChar'.$i}[$l]['FontSize'] = $ABQConf_FontSize + mt_rand(-1, 1);
					${'LinePrintChar'.$i}[$l]['Angle'] = mt_rand(-20, 20);
					${'LinePrintChar'.$i}[$l]['ChangeX'] = 0;
					if (abs(${'LinePrintChar'.$i}[$l]['Angle']) > 5)
					{
						${'LinePrintChar'.$i}[$l]['ChangeX'] += 3;
					}
					elseif (abs(${'LinePrintChar'.$i}[$l]['Angle']) > 15)
					{
						${'LinePrintChar'.$i}[$l]['ChangeX'] += 6;
					}
					if (${'LinePrintChar'.$i}[$l]['Angle'] < 0)
					{
						${'LinePrintChar'.$i}[$l]['Angle'] += 360;
					}
					${'LinePrintChar'.$i}[$l]['ChangeX'] += 5 + mt_rand(-2, 7);
					${'LinePrintChar'.$i}[$l]['ChangeY'] = mt_rand(-9, 10);
					$l++;
				}
				unset(${'LineChars'.$i});
			}
		}
	}
	else
	{
		$ABQConf_FontSize = 5;
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			${'ImagewidthLine'.$i} = 0;
			unset($j);
			unset($k);
			unset($l);
			$k = count(${'LineChars'.$i});
			$l = 0;
			for ($j=0; $j<$k; $j++)
			{
				if (($ColoredCharacter != '') && (${'LineChars'.$i}[$j]['Character'] == '+'))
				{
					$j++;
					if ($j >= $k)
					{
						break;
					}
					${'LinePrintChar'.$i}[$l]['Color'] = $ColoredCharacter;
				}
				else
				{
					${'LinePrintChar'.$i}[$l]['Color'] = '';
				}
				${'LinePrintChar'.$i}[$l]['Character'] = ${'LineChars'.$i}[$j]['Character'];
				${'LinePrintChar'.$i}[$l]['ChangeX'] = mt_rand(1, 3);
				${'LinePrintChar'.$i}[$l]['ChangeY'] = mt_rand(-5, 5);
				${'ImagewidthLine'.$i} += ${'LinePrintChar'.$i}[$l]['ChangeX'];
				$l++;
			}
			unset(${'LineChars'.$i});
		}
	}

	if ($ABQ_FTLib_Version)
	{
		unset ($i);
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			${'ImageheightLine'.$i} = 0;
			${'ImagewidthLine'.$i} = 0;
			${'LineBottomY'.$i} = 0;
			if ((!empty(${'LinePrintChar'.$i})) && (is_array(${'LinePrintChar'.$i})))
			{
				unset($j);
				unset($k);
				$k = count(${'LinePrintChar'.$i});
				for ($j=0; $j<$k; $j++)
				{
					unset($CharacterSize);
					$CharacterSize = imagettfbbox(${'LinePrintChar'.$i}[$j]['FontSize'], ${'LinePrintChar'.$i}[$j]['Angle'], ${'LinePrintChar'.$i}[$j]['Font'], ${'LinePrintChar'.$i}[$j]['Character']);
					$CharacterHeight = abs($CharacterSize[5]);
					if (${'ImageheightLine'.$i} < $CharacterHeight)
					{
						${'ImageheightLine'.$i} = $CharacterHeight;
					}
					${'ImagewidthLine'.$i} += ${'LinePrintChar'.$i}[$j]['ChangeX'] + $CharacterSize[2];
					${'LinePrintChar'.$i}[$j]['CharacterWidth'] = $CharacterSize[2];
				}
				${'LineBottomY'.$i} = ${'ImageheightLine'.$i} + 9;
				${'ImageheightLine'.$i} += 20;
			}
		}
		$Image_Width = 0;
		$Image_Height = 0;
		unset ($i);
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			if (${'ImageheightLine'.$i} > 0)
			{
				if (${'ImagewidthLine'.$i} > $Image_Width)
				{
					$Image_Width = ${'ImagewidthLine'.$i};
				}
				if ($Image_Height > 0)
				{
					$Image_Height += $LineSpacing;
				}
				$Image_Height += ${'ImageheightLine'.$i};
			}
		}
	}
	else
	{
		$Textfont_Width = imagefontwidth($ABQConf_FontSize);
		$Textfont_Height = imagefontheight($ABQConf_FontSize);
		$Image_Width = 0;
		$Image_Height = 0;
		unset ($i);
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			if (((strlen(${'Line'.$i}) * $Textfont_Width) + ${'ImagewidthLine'.$i}) > $Image_Width)
			{
				$Image_Width = (strlen(${'Line'.$i}) * $Textfont_Width) + ${'ImagewidthLine'.$i};
			}
			if ($Image_Height > 0)
			{
				$Image_Height += $LineSpacing;
			}
			${'LineBottomY'.$i} = $Image_Height + 5;
			$Image_Height += $Textfont_Height + 10;
		}
	}
 	$Image_Height += (2 * $LineSpacing);
	$Image_Width += 20;

	if ($Image_Width < $ImageMinWidth)
	{
		$Image_Width = $ImageMinWidth;
	}
	if ($Image_Height < $ImageMinHeight)
	{
		$Image_Height = $ImageMinHeight;
	}

	$Image = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image_Width, $Image_Height) : imagecreate($Image_Width, $Image_Height);
	$Image_Backgroundcolor = imagecolorallocate($Image, mt_rand($Color_BG_Red1, $Color_BG_Red2), mt_rand($Color_BG_Green1, $Color_BG_Green2), mt_rand($Color_BG_Blue1, $Color_BG_Blue2));
	imagefill($Image, 0, 0, $Image_Backgroundcolor);
	$FontColor1 = imagecolorallocate($Image, $Color_ColoredCharacter1_Red, $Color_ColoredCharacter1_Green, $Color_ColoredCharacter1_Blue);
	$FontColor2 = imagecolorallocate($Image, $Color_ColoredCharacter2_Red, $Color_ColoredCharacter2_Green, $Color_ColoredCharacter2_Blue);

	if ($ABQConf_Grid)
	{
		if ($ABQConf_GridWidth < 10)
		{
			$ABQConf_GridWidth = 10;
		}
		elseif ($ABQConf_GridWidth > 100)
		{
			$ABQConf_GridWidth = 100;
		}
		if ($ABQConf_GridHeight < 10)
		{
			$ABQConf_GridHeight = 10;
		}
		elseif ($ABQConf_GridHeight > 50)
		{
			$ABQConf_GridHeight = 50;
		}
		unset($i);
		unset($j);
		$GridXValue = 0;
		$j = ceil($Image_Width / $ABQConf_GridWidth);
		for ($i=0; $i<$j; $i++)
		{
			$WhichColor = mt_rand(1, 4);
			if ($WhichColor == 1)
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid1_Red1, $Color_Grid1_Red2), mt_rand($Color_Grid1_Green1, $Color_Grid1_Green2), mt_rand($Color_Grid1_Blue1, $Color_Grid1_Blue2));
			}
			elseif ($WhichColor == 2)
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid2_Red1, $Color_Grid2_Red2), mt_rand($Color_Grid2_Green1, $Color_Grid2_Green2), mt_rand($Color_Grid2_Blue1, $Color_Grid2_Blue2));
			}
			elseif ($WhichColor == 3)
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid3_Red1, $Color_Grid3_Red2), mt_rand($Color_Grid3_Green1, $Color_Grid3_Green2), mt_rand($Color_Grid3_Blue1, $Color_Grid3_Blue2));
			}
			else
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid4_Red1, $Color_Grid4_Red2), mt_rand($Color_Grid4_Green1, $Color_Grid4_Green2), mt_rand($Color_Grid4_Blue1, $Color_Grid4_Blue2));
			}
			imageline($Image, $GridXValue, 0, $GridXValue, $Image_Height, $GridColor);
			$GridXValue += $ABQConf_GridWidth;
		}
		unset($i);
		unset($j);
		$GridYValue = 0;
		$j = ceil($Image_Height / $ABQConf_GridHeight);
		for ($i=0; $i<$j; $i++)
		{
			$WhichColor = mt_rand(1, 4);
			if ($WhichColor == 1)
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid1_Red1, $Color_Grid1_Red2), mt_rand($Color_Grid1_Green1, $Color_Grid1_Green2), mt_rand($Color_Grid1_Blue1, $Color_Grid1_Blue2));
			}
			elseif ($WhichColor == 2)
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid2_Red1, $Color_Grid2_Red2), mt_rand($Color_Grid2_Green1, $Color_Grid2_Green2), mt_rand($Color_Grid2_Blue1, $Color_Grid2_Blue2));
			}
			elseif ($WhichColor == 3)
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid3_Red1, $Color_Grid3_Red2), mt_rand($Color_Grid3_Green1, $Color_Grid3_Green2), mt_rand($Color_Grid3_Blue1, $Color_Grid3_Blue2));
			}
			else
			{
				$GridColor = imagecolorallocate($Image, mt_rand($Color_Grid4_Red1, $Color_Grid4_Red2), mt_rand($Color_Grid4_Green1, $Color_Grid4_Green2), mt_rand($Color_Grid4_Blue1, $Color_Grid4_Blue2));
			}
			imageline($Image, 0, $GridYValue, $Image_Width, $GridYValue, $GridColor);
			$GridYValue += $ABQConf_GridHeight;
		}
		if ($ABQConf_GridFilled)
		{
			unset($i);
			unset($j);
			unset($k);
			unset($l);
			$l = ceil($Image_Width / $ABQConf_GridWidth);
			$j = ceil($Image_Height / $ABQConf_GridHeight);
			$GridYValue = 1;
			for ($i=0; $i<$j; $i++)
			{
				$GridXValue = 1;
				for ($k=0; $k<$l; $k++)
				{
					$GridColor = imagecolorallocate($Image, mt_rand($Color_GridFilled_Red1, $Color_GridFilled_Red2), mt_rand($Color_GridFilled_Green1, $Color_GridFilled_Green2), mt_rand($Color_GridFilled_Blue1, $Color_GridFilled_Blue2));
					imagefill($Image, $GridXValue, $GridYValue, $GridColor);
					$GridXValue += $ABQConf_GridWidth;
				}
				$GridYValue += $ABQConf_GridHeight;
			}
		}
	}

	if ($ABQConf_Ellipses)
	{
		$EllipsesCounter = mt_rand(15, 25);
		$PartialEllipsesCounter = mt_rand(15, 25);
		$Ellipses_MinX = 3;
		$Ellipses_MaxX = $Image_Width - 3;
		$Ellipses_MinY = 3;
		$Ellipses_MaxY = $Image_Height - 3;
		$Ellipses_MinWidth = 3;
		$Ellipses_MaxWidth = ceil($Image_Width / 6);
		if ($Ellipses_MinWidth >= $Ellipses_MaxWidth)
		{
			$Ellipses_MinWidth = 1;
			$Ellipses_MaxWidth = 2;
		}
		$Ellipses_MinHeight = 3;
		$Ellipses_MaxHeight = ceil($Image_Height / 6);
		if ($Ellipses_MinHeight >= $Ellipses_MaxHeight)
		{
			$Ellipses_MinHeight = 1;
			$Ellipses_MaxHeight = 2;
		}
		unset($i);
		for ($i=0; $i<$EllipsesCounter; $i++)
		{
			$EllipsesColor = imagecolorallocate($Image, mt_rand($Color_Ellipses_Red1, $Color_Ellipses_Red2), mt_rand($Color_Ellipses_Green1, $Color_Ellipses_Green2), mt_rand($Color_Ellipses_Blue1, $Color_Ellipses_Blue2));
			imagefilledellipse($Image, mt_rand($Ellipses_MinX, $Ellipses_MaxX), mt_rand($Ellipses_MinY, $Ellipses_MaxY), mt_rand($Ellipses_MinWidth, $Ellipses_MaxWidth), mt_rand($Ellipses_MinHeight, $Ellipses_MaxHeight), $EllipsesColor);	
		}
		unset($i);
		for ($i=0; $i<$PartialEllipsesCounter; $i++)
		{
			$Ellipses_AngleStart = mt_rand(0, 350);
			$Ellipses_OpenAngle = mt_rand(45, 315);
			$Ellipses_AngleEnd = $Ellipses_AngleStart + $Ellipses_OpenAngle;
			if ($Ellipses_AngleEnd > 360)
			{
				$Ellipses_AngleEnd -= 360;
			}
			$EllipsesColor = imagecolorallocate($Image, mt_rand($Color_PartialEllipses_Red1, $Color_PartialEllipses_Red2), mt_rand($Color_PartialEllipses_Green1, $Color_PartialEllipses_Green2), mt_rand($Color_PartialEllipses_Blue1, $Color_PartialEllipses_Blue2));
			imagefilledarc ($Image, mt_rand($Ellipses_MinX, $Ellipses_MaxX), mt_rand($Ellipses_MinY, $Ellipses_MaxY), mt_rand($Ellipses_MinWidth, $Ellipses_MaxWidth), mt_rand($Ellipses_MinHeight, $Ellipses_MaxHeight), $Ellipses_AngleStart, $Ellipses_AngleEnd, $EllipsesColor, IMG_ARC_EDGED);
		}
	}

	if ($ABQConf_Lines)
	{
		$LineCounter = mt_rand(20, 60);
		$Lines_MinX1 = 0;
		$Lines_MaxX1 = ceil($Image_Width * 0.45);
		$Lines_MinY1 = 0;
		$Lines_MaxY1 = $Image_Height - 1;
		$Lines_MinX2 = ceil($Image_Width * 0.55);
		$Lines_MaxX2 = $Image_Width;
		$Lines_MinY2 = 1;
		$Lines_MaxY2 = $Image_Height;
		unset($i);
		for ($i=0; $i<$LineCounter; $i++)
		{
			$F_Linie = imagecolorallocate($Image, mt_rand($Color_Lines_Red1, $Color_Lines_Red2), mt_rand($Color_Lines_Green1, $Color_Lines_Green2), mt_rand($Color_Lines_Blue1, $Color_Lines_Blue2));
			imageline($Image, mt_rand($Lines_MinX1, $Lines_MaxX1), mt_rand($Lines_MinY1, $Lines_MaxY1), mt_rand($Lines_MinX2, $Lines_MaxX2), mt_rand($Lines_MinY2, $Lines_MaxY2), $F_Linie);
		}
	}

	if ($ABQConf_Arcs)
	{
		$ArcsCounter = mt_rand(25, 35);
		$Arcs_MinX = 3;
		$Arcs_MaxX = $Image_Width - 3;
		$Arcs_MinY = 3;
		$Arcs_MaxY = $Image_Height - 3;
		$Arcs_MinWidth = 3;
		$Arcs_MaxWidth = ceil($Image_Width / 2);
		if ($Arcs_MinWidth >= $Arcs_MaxWidth)
		{
			$Arcs_MinWidth = 1;
			$Arcs_MaxWidth = 2;
		}
		$Arcs_MinHeight = 3;
		$Arcs_MaxHeight = ceil($Image_Height / 1.5);
		if ($Arcs_MinHeight >= $Arcs_MaxHeight)
		{
			$Arcs_MinHeight = 1;
			$Arcs_MaxHeight = 2;
		}
		unset($i);
		for ($i=0; $i<$ArcsCounter; $i++)
		{
			$Arcs_Color = imagecolorallocate($Image, mt_rand($Color_Arcs_Red1, $Color_Arcs_Red2), mt_rand($Color_Arcs_Green1, $Color_Arcs_Green2), mt_rand($Color_Arcs_Blue1, $Color_Arcs_Blue2));
			$Arcs_XPosition = mt_rand(0, $Arcs_MaxX);
			$Arcs_YPosition = mt_rand(0, $Arcs_MaxY);
			$Arcs_Width = mt_rand($Arcs_MinWidth, $Arcs_MaxWidth);
			$Arcs_Height = mt_rand($Arcs_MinHeight, $Arcs_MaxHeight);
			$Arcs_NumberOfDoubles = mt_rand(0, 5);
			imagearc($Image, $Arcs_XPosition, $Arcs_YPosition, $Arcs_Width, $Arcs_Height, mt_rand(0, 190), mt_rand(191, 360), $Arcs_Color);
			if ($Arcs_NumberOfDoubles > 0)
			{
				unset($j);
				for ($j=1; $j<=$Arcs_NumberOfDoubles; $j++)
				{
					imagearc($Image, ($Arcs_XPosition + $j), ($Arcs_YPosition + $j), ($Arcs_Width - $j), ($Arcs_Height - $j), mt_rand(0, 190), mt_rand(191, 360), $Arcs_Color);
				}
			}
		}
	}

	if ($ABQConf_BackgroundText)
	{
		unset($i);
		$BGNumberOfChars = 0;
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			if (count(${'LinePrintChar'.$i}) > $BGNumberOfChars)
			{
				$BGNumberOfChars = count(${'LinePrintChar'.$i});
			}
		}
		if ($BGNumberOfChars > 0)
		{
			if ($ABQ_FTLib_Version)
			{
				$Textline = $LineBottomY1 / 2;
				unset($i);
				for ($i=0; $i<=$NumberOfTextlines; $i++)
				{
					$LastPositionX = 0;
					if ($i > 0)
					{
						$Textline += ${'LineBottomY'.$i} + $LineSpacing;
					}
					unset($j);
					for ($j=0; $j<$BGNumberOfChars; $j++)
					{
						$BGT_Font = $Fonts[rand(0, $FontsCount)];
						$BGT_FontSize = $ABQConf_FontSize + mt_rand(-1, 1);
						$BGT_Angle = mt_rand(-20, 20);
						$PositionX = 0;
						if (abs($BGT_Angle) > 5)
						{
							$PositionX += 3;
						}
						elseif (abs($BGT_Angle) > 15)
						{
							$PositionX += 6;
						}
						if ($BGT_Angle < 0)
						{
							$BGT_Angle += 360;
						}
						$PositionX += $LastPositionX + 5 + mt_rand(-2, 7);
						$PositionY = $Textline + mt_rand(-9, 10);
						$BGT_Color = imagecolorallocate($Image, mt_rand($Color_BGText_Red1, $Color_BGText_Red2), mt_rand($Color_BGText_Green1, $Color_BGText_Green2), mt_rand($Color_BGText_Blue1, $Color_BGText_Blue2));
						$BGT_Character = mt_rand(0, 61);
						if ($BGT_Character < 10)
						{}
						elseif ($BGT_Character > 35)
						{
							$BGT_Character = chr($BGT_Character+61);
						}
						else
						{
							$BGT_Character = chr($BGT_Character+55);
						}


						$BGT_CharacterSize = imagettfbbox($BGT_FontSize, $BGT_Angle, $BGT_Font, $BGT_Character);
						$BGT_CharacterWidth = $BGT_CharacterSize[2];

						imagettftext($Image, $BGT_FontSize, $BGT_Angle, $PositionX, $PositionY, $BGT_Color, $BGT_Font, $BGT_Character);
						$LastPositionX = $PositionX + $BGT_CharacterWidth;
					}
					$Textline += 11;
				}
			}
			else
			{
				$Textline = -($LineSpacing / 2);
				unset($i);
				for ($i=0; $i<=$NumberOfTextlines; $i++)
				{
					$LastPositionX = 0;
					if ($i > 0)
					{
						$Textline += $Textfont_Height + 10 + $LineSpacing;
					}
					unset($j);
					for ($j=0; $j<$BGNumberOfChars; $j++)
					{
						$PositionX = $LastPositionX + mt_rand(1, 3);
						$PositionY = $Textline + mt_rand(-5, 5);
						$BGT_Color = imagecolorallocate($Image, mt_rand($Color_BGText_Red1, $Color_BGText_Red2), mt_rand($Color_BGText_Green1, $Color_BGText_Green2), mt_rand($Color_BGText_Blue1, $Color_BGText_Blue2));
						$BGT_Character = mt_rand(0, 61);
						if ($BGT_Character < 10)
						{}
						elseif ($BGT_Character > 35)
						{
							$BGT_Character = chr($BGT_Character+61);
						}
						else
						{
							$BGT_Character = chr($BGT_Character+55);
						}

						imagestring($Image, $ABQConf_FontSize, $PositionX, $PositionY, $BGT_Character, $BGT_Color);

						$LastPositionX = $PositionX + $Textfont_Width;
					}
				}

			}
		}
	}

	$Textline = $LineSpacing;
	if ($ABQ_FTLib_Version)
	{
		unset($i);
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			$LastPositionX = 10;
			unset($k);
			$k = count(${'LinePrintChar'.$i});
			if ($k > 0)
			{
				if ($Textline != $LineSpacing)
				{
					$Textline += $LineSpacing;
				}
				$Textline += ${'LineBottomY'.$i};
				unset($j);
				for ($j=0; $j<$k; $j++)
				{
					$PositionX = $LastPositionX + ${'LinePrintChar'.$i}[$j]['ChangeX'];
					$PositionY = $Textline + ${'LinePrintChar'.$i}[$j]['ChangeY'];
					if (${'LinePrintChar'.$i}[$j]['Color'] == 'R')
					{
						$CharacterColor = $FontColor1;
					}
					elseif (${'LinePrintChar'.$i}[$j]['Color'] == 'G')
					{
						$CharacterColor = $FontColor2;
					}
					else
					{
						$CharacterColor = imagecolorallocate($Image, mt_rand($Color_Text_Red1, $Color_Text_Red2), mt_rand($Color_Text_Green1, $Color_Text_Green2), mt_rand($Color_Text_Blue1, $Color_Text_Blue2));
					}
					imagettftext($Image, ${'LinePrintChar'.$i}[$j]['FontSize'], ${'LinePrintChar'.$i}[$j]['Angle'], $PositionX, $PositionY, $CharacterColor, ${'LinePrintChar'.$i}[$j]['Font'], ${'LinePrintChar'.$i}[$j]['Character']);
					$LastPositionX = $PositionX + ${'LinePrintChar'.$i}[$j]['CharacterWidth'];
				}
				$Textline += 11;
				${'LineY'.$i} = $Textline + floor($LineSpacing/2);
			}
		}
	}
	else
	{
		$Textline += 2;
		unset($i);
		for ($i=1; $i<=$NumberOfTextlines; $i++)
		{
			unset($k);
			$k = count(${'LinePrintChar'.$i});
			if ($k > 0)
			{
				$PositionX = 10;
				unset($j);
				for ($j=0; $j<$k; $j++)
				{
					if (${'LinePrintChar'.$i}[$j]['Color'] == 'R')
					{
						$CharacterColor = $FontColor1;
					}
					elseif (${'LinePrintChar'.$i}[$j]['Color'] == 'G')
					{
						$CharacterColor = $FontColor2;
					}
					else
					{
						$CharacterColor = imagecolorallocate($Image, mt_rand($Color_Text_Red1, $Color_Text_Red2), mt_rand($Color_Text_Green1, $Color_Text_Green2), mt_rand($Color_Text_Blue1, $Color_Text_Blue2));
					}
					$PositionY = $Textline + ${'LinePrintChar'.$i}[$j]['ChangeY'];
					imagestring($Image, $ABQConf_FontSize, $PositionX, $PositionY, ${'LinePrintChar'.$i}[$j]['Character'], $CharacterColor);
					$PositionX += $Textfont_Width + ${'LinePrintChar'.$i}[$j]['ChangeX'];
				}
				$Textline += $Textfont_Height + 10 + $LineSpacing;
				${'LineY'.$i} = $Textline - floor($LineSpacing/2);
			}
		}
	}

	if (($ABQConf_SeparatingLines) && ($NumberOfTextlines > 1))
	{
		$LineBasevalue = floor($Image_Width/8);
		unset($i);
		for ($i=1; $i<$NumberOfTextlines; $i++)
		{
			if ((${'LineY'.$i} > 0) && (${'LineY'.$i} < $Image_Height))
			{
				$LineStartX1 = floor(($LineBasevalue * mt_rand(5, 15)) / 10);
				$LineStartX2 = floor(($LineBasevalue * mt_rand(25, 35)) / 10);
				$LineStartX3 = floor(($LineBasevalue * mt_rand(45, 55)) / 10);
				$LineStartX4 = floor(($LineBasevalue * mt_rand(65, 75)) / 10);
				$SeparatingLinesColor = imagecolorallocate($Image, mt_rand($Color_SeparatingLines_Red1, $Color_SeparatingLines_Red2), mt_rand($Color_SeparatingLines_Green1, $Color_SeparatingLines_Green2), mt_rand($Color_SeparatingLines_Blue1, $Color_SeparatingLines_Blue2));
				imageline($Image, $LineStartX1, ${'LineY'.$i}, $LineStartX2, ${'LineY'.$i}, $SeparatingLinesColor);
				$SeparatingLinesColor = imagecolorallocate($Image, mt_rand($Color_SeparatingLines_Red1, $Color_SeparatingLines_Red2), mt_rand($Color_SeparatingLines_Green1, $Color_SeparatingLines_Green2), mt_rand($Color_SeparatingLines_Blue1, $Color_SeparatingLines_Blue2));
				imageline($Image, $LineStartX3, ${'LineY'.$i}, $LineStartX4, ${'LineY'.$i}, $SeparatingLinesColor);
			}
		}
	}

	if (($CacheImage >= 1) && ($CacheImage <= 6))
	{
		if ($CacheImage == 2)
		{
			$ImageSizeFactor = mt_rand(15, 22);
			$Image1_Width = $Image_Width;
			$Image1_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(15, 22);
			$Image3_Width = $Image_Width;
			$Image3_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(15, 22);
			$Image4_Width = $Image_Width;
			$Image4_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(15, 22);
			$Image5_Width = $Image_Width;
			$Image5_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			$Image2_Width = $Image_Width;
			$Image2_Height = $Image_Height - ($Image1_Height + $Image3_Height + $Image4_Height + $Image5_Height);

			$Image1 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image1_Width, $Image1_Height) : imagecreate($Image1_Width, $Image1_Height);
			$Image2 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image2_Width, $Image2_Height) : imagecreate($Image2_Width, $Image2_Height);
			$Image3 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image3_Width, $Image3_Height) : imagecreate($Image3_Width, $Image3_Height);
			$Image4 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image4_Width, $Image4_Height) : imagecreate($Image4_Width, $Image4_Height);
			$Image5 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image5_Width, $Image5_Height) : imagecreate($Image5_Width, $Image5_Height);

			imagecopy($Image1, $Image, 0, 0, 0, 0, $Image1_Width, $Image1_Height);
			imagecopy($Image2, $Image, 0, 0, 0, $Image1_Height, $Image2_Width, $Image2_Height);
			imagecopy($Image3, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height), $Image3_Width, $Image3_Height);
			imagecopy($Image4, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height + $Image3_Height), $Image4_Width, $Image4_Height);
			imagecopy($Image5, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height + $Image3_Height + $Image4_Height), $Image5_Width, $Image5_Height);

			($mimeTyp == 'image/png') ? imagepng($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.png') : imagejpeg($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.png') : imagejpeg($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.png') : imagejpeg($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.png') : imagejpeg($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.png') : imagejpeg($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.jpg', $ABQConf_ImageQuality);

			imagedestroy($Image);
			imagedestroy($Image1);
			imagedestroy($Image2);
			imagedestroy($Image3);
			imagedestroy($Image4);
			imagedestroy($Image5);
		}
		elseif ($CacheImage == 3)
		{
			$ImageSizeFactor = mt_rand(20, 30);
			$Image1_Width = $Image_Width;
			$Image1_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(20, 30);
			$Image5_Width = $Image_Width;
			$Image5_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(30, 35);
			$Image2_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image2_Height = $Image_Height - ($Image1_Height + $Image5_Height);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(30, 35);
			$Image4_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image4_Height = $Image2_Height;
			$Image3_Width = $Image_Width - ($Image2_Width + $Image4_Width);
			$Image3_Height = $Image2_Height;

			$Image1 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image1_Width, $Image1_Height) : imagecreate($Image1_Width, $Image1_Height);
			$Image2 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image2_Width, $Image2_Height) : imagecreate($Image2_Width, $Image2_Height);
			$Image3 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image3_Width, $Image3_Height) : imagecreate($Image3_Width, $Image3_Height);
			$Image4 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image4_Width, $Image4_Height) : imagecreate($Image4_Width, $Image4_Height);
			$Image5 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image5_Width, $Image5_Height) : imagecreate($Image5_Width, $Image5_Height);

			imagecopy($Image1, $Image, 0, 0, 0, 0, $Image1_Width, $Image1_Height);
			imagecopy($Image2, $Image, 0, 0, 0, $Image1_Height, $Image2_Width, $Image2_Height);
			imagecopy($Image3, $Image, 0, 0, $Image2_Width, $Image1_Height, $Image3_Width, $Image3_Height);
			imagecopy($Image4, $Image, 0, 0, ($Image2_Width + $Image3_Width), $Image1_Height, $Image4_Width, $Image4_Height);
			imagecopy($Image5, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height), $Image5_Width, $Image5_Height);

			($mimeTyp == 'image/png') ? imagepng($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.png') : imagejpeg($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.png') : imagejpeg($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.png') : imagejpeg($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.png') : imagejpeg($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.png') : imagejpeg($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.jpg', $ABQConf_ImageQuality);

			imagedestroy($Image);
			imagedestroy($Image1);
			imagedestroy($Image2);
			imagedestroy($Image3);
			imagedestroy($Image4);
			imagedestroy($Image5);
		}
		elseif ($CacheImage == 4)
		{
			$ImageSizeFactor = mt_rand(30, 40);
			$Image2_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(20, 30);
			$Image2_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(25, 35);
			$Image4_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image4_Height = $Image2_Height;
			$Image3_Width = $Image_Width - ($Image2_Width + $Image4_Width);
			$Image3_Height = $Image2_Height;
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(25, 35);
			$Image5_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(22, 32);
			$Image5_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(28, 38);
			$Image7_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image7_Height = $Image5_Height;
			$Image6_Width = $Image_Width - ($Image5_Width + $Image7_Width);
			$Image6_Height = $Image5_Height;
			$Image1_Width = $Image_Width;
			$Image1_Height = $Image_Height - ($Image2_Height + $Image5_Height);

			$Image1 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image1_Width, $Image1_Height) : imagecreate($Image1_Width, $Image1_Height);
			$Image2 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image2_Width, $Image2_Height) : imagecreate($Image2_Width, $Image2_Height);
			$Image3 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image3_Width, $Image3_Height) : imagecreate($Image3_Width, $Image3_Height);
			$Image4 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image4_Width, $Image4_Height) : imagecreate($Image4_Width, $Image4_Height);
			$Image5 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image5_Width, $Image5_Height) : imagecreate($Image5_Width, $Image5_Height);
			$Image6 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image6_Width, $Image6_Height) : imagecreate($Image6_Width, $Image6_Height);
			$Image7 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image7_Width, $Image7_Height) : imagecreate($Image7_Width, $Image7_Height);

			imagecopy($Image1, $Image, 0, 0, 0, 0, $Image1_Width, $Image1_Height);
			imagecopy($Image2, $Image, 0, 0, 0, $Image1_Height, $Image2_Width, $Image2_Height);
			imagecopy($Image3, $Image, 0, 0, $Image2_Width, $Image1_Height, $Image3_Width, $Image3_Height);
			imagecopy($Image4, $Image, 0, 0, ($Image2_Width + $Image3_Width), $Image1_Height, $Image4_Width, $Image4_Height);
			imagecopy($Image5, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height), $Image5_Width, $Image5_Height);
			imagecopy($Image6, $Image, 0, 0, $Image5_Width, ($Image1_Height + $Image2_Height), $Image6_Width, $Image6_Height);
			imagecopy($Image7, $Image, 0, 0, ($Image5_Width + $Image6_Width), ($Image1_Height + $Image2_Height), $Image7_Width, $Image7_Height);

			($mimeTyp == 'image/png') ? imagepng($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.png') : imagejpeg($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.png') : imagejpeg($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.png') : imagejpeg($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.png') : imagejpeg($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.png') : imagejpeg($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image6, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_6.png') : imagejpeg($Image6, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_6.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image7, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_7.png') : imagejpeg($Image7, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_7.jpg', $ABQConf_ImageQuality);

			imagedestroy($Image);
			imagedestroy($Image1);
			imagedestroy($Image2);
			imagedestroy($Image3);
			imagedestroy($Image4);
			imagedestroy($Image5);
			imagedestroy($Image6);
			imagedestroy($Image7);
		}
		elseif ($CacheImage == 5)
		{
			$ImageSizeFactor = mt_rand(5, 15);
			$Image1_Width = $Image_Width;
			$Image1_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(40, 60);
			$Image2_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(25, 30);
			$Image2_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			$Image3_Width = $Image_Width - $Image2_Width;
			$Image3_Height = $Image2_Height;
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(33, 67);
			$Image6_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(30, 35);
			$Image6_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			$Image7_Width = $Image_Width - $Image6_Width;
			$Image7_Height = $Image6_Height;
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(30, 50);
			$Image4_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image4_Height = $Image_Height - ($Image1_Height + $Image2_Height + $Image6_Height);
			$Image5_Width = $Image_Width - $Image4_Width;
			$Image5_Height = $Image4_Height;

			$Image1 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image1_Width, $Image1_Height) : imagecreate($Image1_Width, $Image1_Height);
			$Image2 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image2_Width, $Image2_Height) : imagecreate($Image2_Width, $Image2_Height);
			$Image3 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image3_Width, $Image3_Height) : imagecreate($Image3_Width, $Image3_Height);
			$Image4 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image4_Width, $Image4_Height) : imagecreate($Image4_Width, $Image4_Height);
			$Image5 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image5_Width, $Image5_Height) : imagecreate($Image5_Width, $Image5_Height);
			$Image6 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image6_Width, $Image6_Height) : imagecreate($Image6_Width, $Image6_Height);
			$Image7 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image7_Width, $Image7_Height) : imagecreate($Image7_Width, $Image7_Height);

			imagecopy($Image1, $Image, 0, 0, 0, 0, $Image1_Width, $Image1_Height);
			imagecopy($Image2, $Image, 0, 0, 0, $Image1_Height, $Image2_Width, $Image2_Height);
			imagecopy($Image3, $Image, 0, 0, $Image2_Width, $Image1_Height, $Image3_Width, $Image3_Height);
			imagecopy($Image4, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height), $Image4_Width, $Image4_Height);
			imagecopy($Image5, $Image, 0, 0, $Image4_Width, ($Image1_Height + $Image2_Height), $Image5_Width, $Image5_Height);
			imagecopy($Image6, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height + $Image4_Height), $Image6_Width, $Image6_Height);
			imagecopy($Image7, $Image, 0, 0, $Image6_Width, ($Image1_Height + $Image2_Height + $Image4_Height), $Image7_Width, $Image7_Height);

			($mimeTyp == 'image/png') ? imagepng($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.png') : imagejpeg($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.png') : imagejpeg($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.png') : imagejpeg($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.png') : imagejpeg($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.png') : imagejpeg($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image6, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_6.png') : imagejpeg($Image6, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_6.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image7, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_7.png') : imagejpeg($Image7, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_7.jpg', $ABQConf_ImageQuality);

			imagedestroy($Image);
			imagedestroy($Image1);
			imagedestroy($Image2);
			imagedestroy($Image3);
			imagedestroy($Image4);
			imagedestroy($Image5);
			imagedestroy($Image6);
			imagedestroy($Image7);
		}
		elseif ($CacheImage == 6)
		{
			$ImageSizeFactor = mt_rand(5, 15);
			$ImageSizeFactor1 = $ImageSizeFactor;
			$Image1_Width = $Image_Width;
			$Image1_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(5, 15);
			$ImageSizeFactor1 += $ImageSizeFactor;
			$Image7_Width = $Image_Width;
			$Image7_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(40, 60);
			$Image2_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor1 = ceil((100 - $ImageSizeFactor1) / 2);
			$ImageSizeFactor = mt_rand(($ImageSizeFactor1 - 8), ($ImageSizeFactor1 + 8));
			$Image2_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			$Image3_Width = $Image_Width - $Image2_Width;
			$Image3_Height = $Image2_Height;
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(20, 30);
			$Image4_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image4_Height = $Image_Height - ($Image1_Height + $Image2_Height + $Image7_Height);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(30, 45);
			$Image6_Width = ceil(($Image_Width / 100) * $ImageSizeFactor);
			$Image6_Height = $Image4_Height;
			$Image5_Width = $Image_Width - ($Image4_Width + $Image6_Width);
			$Image5_Height = $Image4_Height;

			$Image1 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image1_Width, $Image1_Height) : imagecreate($Image1_Width, $Image1_Height);
			$Image2 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image2_Width, $Image2_Height) : imagecreate($Image2_Width, $Image2_Height);
			$Image3 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image3_Width, $Image3_Height) : imagecreate($Image3_Width, $Image3_Height);
			$Image4 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image4_Width, $Image4_Height) : imagecreate($Image4_Width, $Image4_Height);
			$Image5 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image5_Width, $Image5_Height) : imagecreate($Image5_Width, $Image5_Height);
			$Image6 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image6_Width, $Image6_Height) : imagecreate($Image6_Width, $Image6_Height);
			$Image7 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image7_Width, $Image7_Height) : imagecreate($Image7_Width, $Image7_Height);

			imagecopy($Image1, $Image, 0, 0, 0, 0, $Image1_Width, $Image1_Height);
			imagecopy($Image2, $Image, 0, 0, 0, $Image1_Height, $Image2_Width, $Image2_Height);
			imagecopy($Image3, $Image, 0, 0, $Image2_Width, $Image1_Height, $Image3_Width, $Image3_Height);
			imagecopy($Image4, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height), $Image4_Width, $Image4_Height);
			imagecopy($Image5, $Image, 0, 0, $Image4_Width, ($Image1_Height + $Image2_Height), $Image5_Width, $Image5_Height);
			imagecopy($Image6, $Image, 0, 0, ($Image4_Width + $Image5_Width), ($Image1_Height + $Image2_Height), $Image6_Width, $Image6_Height);
			imagecopy($Image7, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height + $Image4_Height), $Image7_Width, $Image7_Height);

			($mimeTyp == 'image/png') ? imagepng($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.png') : imagejpeg($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.png') : imagejpeg($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.png') : imagejpeg($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.png') : imagejpeg($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.png') : imagejpeg($Image5, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_5.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image6, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_6.png') : imagejpeg($Image6, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_6.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image7, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_7.png') : imagejpeg($Image7, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_7.jpg', $ABQConf_ImageQuality);

			imagedestroy($Image);
			imagedestroy($Image1);
			imagedestroy($Image2);
			imagedestroy($Image3);
			imagedestroy($Image4);
			imagedestroy($Image5);
			imagedestroy($Image6);
			imagedestroy($Image7);
		}
		else
		{
			$ImageSizeFactor = mt_rand(15, 30);
			$Image1_Width = $Image_Width;
			$Image1_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(20, 30);
			$Image3_Width = $Image_Width;
			$Image3_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			unset($ImageSizeFactor);
			$ImageSizeFactor = mt_rand(20, 30);
			$Image4_Width = $Image_Width;
			$Image4_Height = ceil(($Image_Height / 100) * $ImageSizeFactor);
			$Image2_Width = $Image_Width;
			$Image2_Height = $Image_Height - ($Image1_Height + $Image3_Height + $Image4_Height);

			$Image1 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image1_Width, $Image1_Height) : imagecreate($Image1_Width, $Image1_Height);
			$Image2 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image2_Width, $Image2_Height) : imagecreate($Image2_Width, $Image2_Height);
			$Image3 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image3_Width, $Image3_Height) : imagecreate($Image3_Width, $Image3_Height);
			$Image4 = ($ABQ_GDLib_Version >= 2) ? imagecreatetruecolor($Image4_Width, $Image4_Height) : imagecreate($Image4_Width, $Image4_Height);

			imagecopy($Image1, $Image, 0, 0, 0, 0, $Image1_Width, $Image1_Height);
			imagecopy($Image2, $Image, 0, 0, 0, $Image1_Height, $Image2_Width, $Image2_Height);
			imagecopy($Image3, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height), $Image3_Width, $Image3_Height);
			imagecopy($Image4, $Image, 0, 0, 0, ($Image1_Height + $Image2_Height + $Image3_Height), $Image4_Width, $Image4_Height);

			($mimeTyp == 'image/png') ? imagepng($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.png') : imagejpeg($Image1, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_1.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.png') : imagejpeg($Image2, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_2.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.png') : imagejpeg($Image3, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_3.jpg', $ABQConf_ImageQuality);
			($mimeTyp == 'image/png') ? imagepng($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.png') : imagejpeg($Image4, $phpbb_root_path . 'images/abq_mod/cache/' . $userdata['session_id'] . '_4.jpg', $ABQConf_ImageQuality);

			imagedestroy($Image);
			imagedestroy($Image1);
			imagedestroy($Image2);
			imagedestroy($Image3);
			imagedestroy($Image4);
		}
	}
	else
	{
		header("Content-Type: $mimeTyp");
		header("Expires: Mon, 20 Jul 1995 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Pragma: no-cache");
		header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");

		($mimeTyp == 'image/png') ? imagepng($Image) : imagejpeg($Image, '', $ABQConf_ImageQuality);
		imagedestroy($Image);
	}
}
?>