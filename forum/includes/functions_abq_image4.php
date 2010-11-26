<?php
/***************************************************************************
 *                          functions_abq_image4.php
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

function ShowImage($ImageNr)
{
	global $abq_config, $phpbb_root_path, $userdata;

	if ((!$abq_config['multiimages']) || (($ImageNr != 21) && ($ImageNr != 32) && ($ImageNr != 54) && ($ImageNr != 1) && ($ImageNr != 17) && ($ImageNr != 9) && ($ImageNr != 20)))
	{
		exit;
	}

	if ($abq_config['ImageFormat'])
	{
		$mime = "image/jpeg";
		$FileFormat = '.jpg';
	}
	else
	{
		$mime = "image/png";
		$FileFormat = '.png';
	}

	$Filename = $userdata['session_id'];
	if ($ImageNr == 21)
	{
			$Filename .= '_1';
	}
	elseif ($ImageNr == 32)
	{
			$Filename .= '_2';
	}
	elseif ($ImageNr == 54)
	{
			$Filename .= '_3';
	}
	elseif ($ImageNr == 1)
	{
			$Filename .= '_4';
	}
	elseif ($ImageNr == 17)
	{
			$Filename .= '_5';
	}
	elseif ($ImageNr == 9)
	{
			$Filename .= '_6';
	}
	elseif ($ImageNr == 20)
	{
			$Filename .= '_7';
	}
	$Filename .= $FileFormat;

	header("Content-Type: $mime");
	header("Expires: Mon, 20 Jul 1995 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Pragma: no-cache");
	header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
	readfile($phpbb_root_path . 'images/abq_mod/cache/' . $Filename);
}
?>