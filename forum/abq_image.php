<?php
/***************************************************************************
 *                          abq_image.php
 *                          -------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *
 ***************************************************************************/

define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 

// Read the Anti Bot Question config table
$abq_config = array();
$sql = "SELECT *
	FROM " . ANTI_BOT_QUEST_CONFIG_TABLE;
if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query anti bot question mod config information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$abq_config[$row['config_name']] = $row['config_value'];
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata); 

$ABQ_Image_ID = 0;
$ABQ_Image_No = 0;
$ABQ_Font_ID = 0;
if ((isset($HTTP_GET_VARS['b'])) && (!is_null($HTTP_GET_VARS['b'])) && (preg_match('/^[a-z0-9]+$/i',$HTTP_GET_VARS['b'])))
{
	if ($HTTP_GET_VARS['b'] == 'test')
	{
		$ABQ_Image_ID = -10;
	}
	else
	{
		$ABQ_Image_ID = preg_replace('/[^a-z0-9]/i','',$HTTP_GET_VARS['b']);
	}
}
elseif ((isset($HTTP_GET_VARS['id'])) && (!is_null($HTTP_GET_VARS['id'])) && (preg_match('/^[0-9]+$/i',$HTTP_GET_VARS['id'])))
{
	$ABQ_Font_ID = intval($HTTP_GET_VARS['id']);
}

if ((isset($HTTP_GET_VARS['n'])) && (!is_null($HTTP_GET_VARS['n'])) && (preg_match('/^[0-9]+$/i',$HTTP_GET_VARS['n'])))
{
	$ABQ_Image_No = intval($HTTP_GET_VARS['n']);
}

if (!empty($ABQ_Image_ID))
{
	if ($ABQ_Image_ID == -10)
	{
		// Show the test image (ABQ option: Use the file abq_image.php to show images)
		include($phpbb_root_path . 'includes/functions_abq_image1.' . $phpEx);
		ShowImage($ABQ_Image_ID);
	}
	elseif ($ABQ_Image_No > 0)
	{
		// Show a "multiimage" image
		include($phpbb_root_path . 'includes/functions_abq_image4.' . $phpEx);
		ShowImage($ABQ_Image_No);
	}
	else
	{
		$sql = 'SELECT answer, line1, line2, line3, line4, color  
			FROM ' . ANTI_BOT_QUEST_CONFIRM_TABLE . ' 
			WHERE confirm_id = \'' . $ABQ_Image_ID . '\' 
				AND session_id = \'' . $userdata['session_id'] . '\'';
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain anti bot question answer', __LINE__, __FILE__, $sql);
		}
		if ($db->sql_numrows($result) > 0)
		{
			$row = $db->sql_fetchrow($result);
			if ((substr($row['answer'],0,1) == '_') && ($row['line1'] == ''))
			{
				// Show an image of an Individual Text Question
				include($phpbb_root_path . 'includes/functions_abq_image1.' . $phpEx);
				ShowImage(substr($row['answer'],1));
			}
			elseif (substr($row['answer'],0,1) == '_')
			{
				// Show the Individual Image Question
				include($phpbb_root_path . 'includes/functions_abq.' . $phpEx);
				include($phpbb_root_path . 'includes/functions_abq_image2.' . $phpEx);
				ShowImage($row['answer'],'','','','',0);
			}
			else
			{
				// Show the Automatic Image Question
				include($phpbb_root_path . 'includes/functions_abq.' . $phpEx);
				include($phpbb_root_path . 'includes/functions_abq_image2.' . $phpEx);
				ShowImage($row['line1'], $row['line2'], $row['line3'], $row['line4'], $row['color'], 0);
			}
		}
		else
		{
			exit;
		}
	}
}
elseif (!empty($ABQ_Font_ID))
{
	// Show a font test image
	include($phpbb_root_path . 'includes/functions_abq.' . $phpEx);
	include($phpbb_root_path . 'includes/functions_abq_image3.' . $phpEx);
	ShowImage($ABQ_Font_ID);
}
?>