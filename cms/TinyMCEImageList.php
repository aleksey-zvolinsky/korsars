<?php

global $FilesNotArchive;
$FilesNotArchive=array('vssver2.scc');
global $DirNotArchive;
$DirNotArchive=array('smarty','work_smarty','dbackup','.','..','mods','Appalachia','Diddle');
$BaseDir=getcwd().'/images';
ob_start();
ReadDirectory($BaseDir);
$content=ob_get_contents();
ob_end_clean();
echo 'var tinyMCEImageList = new Array('.substr($content,1).');';
/*var tinyMCEImageList = new Array(
	// Name, URL
	["Logo 1", "logo.jpg"],
	["Logo 2 Over", "logo_over.jpg"]
);*/

function ReadDirectory($ADir)
{
	global $FilesNotArchive;
	global $DirNotArchive;

	$d=dir($ADir);

	while (false !== ($entry = $d->read()))
	{		if((is_file($ADir.'/'.$entry))and(!in_array($entry,$FilesNotArchive)))
			echo ','."\n\t".'["'.$entry.'","'.str_replace(getcwd(),'',$ADir.'/'.$entry).'"]';
		elseif(is_dir($ADir.'/'.$entry)and(!in_array($entry,$DirNotArchive)))
			ReadDirectory($ADir.'/'.$entry);
	}
	$d->close();
}

?>