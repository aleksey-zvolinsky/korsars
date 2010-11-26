<?php
/***************************************************************************
 *                          functions_abq_image1.php
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

function ShowImage($QuestionID)
{
	global $db, $phpbb_root_path;
	$ABQ_Row = array();

	if ($QuestionID == -10)
	{
		$ABQ_Row['anti_bot_img'] = 'admin/_test_.gif';
		$ABQ_FileFormat = 'gif';
	}
	else
	{
		$sql = 'SELECT anti_bot_img 
			FROM ' . ANTI_BOT_QUEST_TABLE . '
			WHERE id = \'' . $QuestionID . '\' 
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
		$ABQ_FileFormat = strtolower(preg_replace('/.*\.([a-z]+)$/','\1',$ABQ_Row['anti_bot_img']));
	}

	if ($ABQ_FileFormat == 'gif')
	{
	    $mime = "image/gif";
	}
	elseif ($ABQ_FileFormat == 'png')
	{
	    $mime = "image/png";
	}
	else
	{
	    $mime = "image/jpeg";
	}

	header("Content-Type: $mime");
	header("Expires: Mon, 20 Jul 1995 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Pragma: no-cache");
	header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
	readfile($phpbb_root_path . 'images/abq_mod/' . $ABQ_Row['anti_bot_img']);
}
?>