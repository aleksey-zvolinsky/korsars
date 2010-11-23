<?php
/***************************************************************************
 *                          functions_abq_image3.php
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

function ShowImage($FontID)
{
	global $abq_config, $ABQ_FTLib_Version, $ABQ_GDLib_Version, $phpbb_root_path;

	$FontID--;

	$ABQConf_ImageJPG = intval($abq_config['ImageFormat']);
	$ABQConf_ImageQuality = intval($abq_config['JPG_Quality']);
	$ABQConf_FontSize = intval($abq_config['fontsize']);
	$Color_BG_Red1 = intval($abq_config['Color_BG_R1']);
	$Color_BG_Red2 = intval($abq_config['Color_BG_R2']);
	$Color_BG_Green1 = intval($abq_config['Color_BG_G1']);
	$Color_BG_Green2 = intval($abq_config['Color_BG_G2']);
	$Color_BG_Blue1 = intval($abq_config['Color_BG_B1']);
	$Color_BG_Blue2 = intval($abq_config['Color_BG_B2']);
	$Color_Text_Red1 = intval($abq_config['Color_Text_R1']);
	$Color_Text_Red2 = intval($abq_config['Color_Text_R2']);
	$Color_Text_Green1 = intval($abq_config['Color_Text_G1']);
	$Color_Text_Green2 = intval($abq_config['Color_Text_G2']);
	$Color_Text_Blue1 = intval($abq_config['Color_Text_B1']);
	$Color_Text_Blue2 = intval($abq_config['Color_Text_B2']);


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

	$phpbb_root_path = str_replace('index.'.$phpEx, '', realpath($phpbb_root_path.'index.'.$phpEx));

	$LineSpacing = 10;
	$ImageMinWidth = 25;
	$ImageMinHeight = 10;

	if (($ABQConf_FontSize < 15) || ($ABQConf_FontSize > 40))
	{
		$ABQConf_FontSize = 20;
	}
	$ABQConf_FontSize -= 6;

	$Fonts = array();
	$FontCount = 0;
	if ($FontFolder = @opendir($phpbb_root_path.'abq_mod/fonts/'))
	{
		while (true == ($Files = @readdir($FontFolder)))
		{
			if ((substr(strtolower($Files), -4) == '.ttf'))
			{
				$Fonts[] = $Files;
			}
		}
		closedir($FontFolder);
		sort($Fonts);
		$FontCount = count($Fonts);
	}

	$ABQ_PHP_Version = array();
	$ABQ_FTLib_Version = 0;
	$ABQ_GDLib_Version = 0;
	ABQ_gdVersion();

	if ((count($FontCount) > 0) && ($FontID >= 0) && ($FontID < $FontCount))
	{
		if (!$ABQ_FTLib_Version)
		{
			exit;
		}
	}
	else
	{
		exit;
	}

	if ($ABQ_GDLib_Version >= 1)
	{}
	else
	{
		exit;
	}

	$Font = $phpbb_root_path . 'abq_mod/fonts/' . $Fonts[$FontID];
	$Line1 = 'a b d e f g h j m n p q r t x y';
	$Line2 = 'A B D E F G H J M N P Q R T U V W X Y Z';
	$Line3 = '1 2 3 4 5 6 7 8 9 0';
	$Line4 = '% = + - * / ( ) : ; . , ! ?';
	unset ($i);
	for ($i=1; $i<=4; $i++)
	{
		${'ImageheightLine'.$i} = 0;
		${'ImagewidthLine'.$i} = 0;
		unset($LineSize);
		$LineSize = imagettfbbox($ABQConf_FontSize, 0, $Font, ${'Line'.$i});
		${'ImagewidthLine'.$i} = abs($LineSize[2]);
		${'ImageheightLine'.$i} = abs($LineSize[5]);

		${'LineBottomY'.$i} = ${'ImageheightLine'.$i} + $LineSpacing;

		if ($i > 1)
		{
			${'LineBottomY'.$i} += ${'LineBottomY'.($i-1)};
		}
	}
	$Image_Width = 0;
	$Image_Height = 0;
	unset ($i);
	for ($i=1; $i<=4; $i++)
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
	$Image_FontColor = imagecolorallocate($Image, mt_rand($Color_Text_Red1, $Color_Text_Red2), mt_rand($Color_Text_Green1, $Color_Text_Green2), mt_rand($Color_Text_Blue1, $Color_Text_Blue2));

	unset($i);
	for ($i=1; $i<=4; $i++)
	{
		imagettftext($Image, $ABQConf_FontSize, 0, 10, ${'LineBottomY'.$i}, $Image_FontColor, $Font, ${'Line'.$i});
	}

	header("Content-Type: $mimeTyp");
	header("Expires: Mon, 20 Jul 1995 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Pragma: no-cache");
	header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");

	($mimeTyp == 'image/png') ? imagepng($Image) : imagejpeg($Image, '', $ABQConf_ImageQuality);
	imagedestroy($Image);
}
?>