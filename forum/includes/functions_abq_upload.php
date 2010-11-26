<?php
/***************************************************************************
 *                          functions_abq_upload.php
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

// abq_upload() loads a file up and checks the file
// $UF_Modus:
//            IQT1Image   - Individual Question type 1 image file
//            Font        - TTF Font file
function abq_upload($UF_Modus, $UF_TmpName, $UF_Name, $UF_Size, $UF_Filetype)
{
	global $lang, $phpbb_root_path, $phpEx;

	if (($UF_Modus != 'IQT1Image') && ($UF_Modus != 'Font'))
	{
		exit;
	}

	$UploadOK = 0;
	$UploadFolder = '';

	$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';

	// Check the filename and the file type
	if (!preg_match('/^[a-z0-9_-]+\.[a-z]{3,4}$/i', $UF_Name))
	{}
	elseif (($UF_Modus == 'Font') && (file_exists(@phpbb_realpath($UF_TmpName))) && (preg_match('/\.(ttf)$/i', $UF_Name)))
	{
		if ($UF_Filetype == 'application/octet-stream')
		{
			$UploadOK = 1;
		}
	}
	elseif (($UF_Modus == 'IQT1Image') && (file_exists(@phpbb_realpath($UF_TmpName))) && (preg_match('/\.(jpg|jpeg|gif|png)$/i', $UF_Name)))
	{
		$FilenameType = '';
		preg_match('#image\/[x\-]*([a-z]+)#', $UF_Filetype, $UF_Filetype);
		$UF_Filetype = $UF_Filetype[1];
		if (($UF_Filetype == 'jpeg') || ($UF_Filetype == 'pjpeg') || ($UF_Filetype == 'jpg'))
		{
			$FilenameType = '.jpg';
		}
		elseif ($UF_Filetype == 'gif')
		{
			$FilenameType = '.gif';
		}
		elseif ($UF_Filetype == 'png')
		{
			$FilenameType = '.png';
		}
		if ($FilenameType == '')
		{
			$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . $lang['ABQ_Error_upload_invalid_Image'];
			message_die(GENERAL_MESSAGE, $message);
		}

		// If getimagesize() is enabled use it to check the image format
		if (function_exists(getimagesize))
		{
			$UploadImageInfo =  @getimagesize($UF_TmpName);
			if ((isset($UploadImageInfo)) && (is_array($UploadImageInfo)) && (count($UploadImageInfo) > 2))
			{
				list($BildBreite, $BildHoehe, $BildTyp) = $UploadImageInfo;

				if ($BildTyp == 1)
				{
					if ($FilenameType != '.gif')
					{
						message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
					}
				}
				elseif (($BildTyp == 2) || ($BildTyp == 9) || ($BildTyp == 10) || ($BildTyp == 11) || ($BildTyp == 12))
				{
					if (($FilenameType != '.jpg') && ($FilenameType != '.jpeg'))
					{
						message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
					}
				}
				elseif ($BildTyp == 3)
				{
					if ($FilenameType != '.png')
					{
						message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
					}
				}
				else
				{
					message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
				}
				$UploadOK = 1;
			}
			else
			{
				$UploadOK = 1;
			}
		}
		else
		{
			$UploadOK = 1;
		}
	}

	if (!$UploadOK)
	{
		// The filename and file type check fails
		$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . $lang['ABQ_Error_upload_invalid_File'];
		message_die(GENERAL_MESSAGE, $message);
	}

	if (@$ini_val('open_basedir') != '')
	{
		if (@phpversion() < '4.0.3')
		{
			message_die(GENERAL_ERROR, 'open_basedir is set and your PHP version does not allow move_uploaded_file', '', __LINE__, __FILE__);
		}
		$move_file = 'move_uploaded_file';
	}
	else
	{
		$move_file = 'copy';
	}

	if (!is_uploaded_file($UF_TmpName))
	{
		message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
	}

	if ($UF_Modus == 'Font')
	{
		$UploadFolder = 'abq_mod/fonts/';
	}
	elseif ($UF_Modus == 'IQT1Image')
	{
		$UploadFolder = 'images/abq_mod/';
	}

	if (file_exists(@phpbb_realpath($phpbb_root_path.$UploadFolder.$UF_Name)))
	{
		$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . $lang['ABQ_Error_upload_File_exists'];
		message_die(GENERAL_MESSAGE, $message);
	}

	if (@$move_file($UF_TmpName, $phpbb_root_path . $UploadFolder . '/' . $UF_Name))
	{}
	else
	{
		$message = $lang['ABQ_Error_File_Uploaderror'] . '<br /><br />' . sprintf($lang['ABQ_Error_upload_can_not_create_File'], $UploadFolder);
		message_die(GENERAL_MESSAGE, $message);
	}

	@chmod($phpbb_root_path . $UploadFolder . $UF_Name, 0777);

	$message = $lang['ABQ_upload_File_ok'] . '<br /><br />';
	if ($UF_Modus == 'Font')
	{
		$message .= sprintf($lang['ABQ_Click_return_Fonts'], '<a href="' . append_sid($phpbb_root_path.'admin/abq_fonts.'.$phpEx) . '">', '</a>');
	}
	elseif ($UF_Modus == 'IQT1Image')
	{
		$message .= sprintf($lang['ABQ_Click_return_IImages'], '<a href="' . append_sid($phpbb_root_path.'admin/abq_indi_images.'.$phpEx) . '">', '</a>');
	}
	$message .= '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid($phpbb_root_path.'admin/index.'.$phpEx.'?pane=right') . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}
?>