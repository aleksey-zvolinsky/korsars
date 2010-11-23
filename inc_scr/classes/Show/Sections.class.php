<?php
require_once(DataDir.'classes/Show.class.php');
class Sections extends Show
{

	function getContent()
	{
		$this->FTitle='Новости';
		$db=GetDB();
		global $Url;
 		$Alias=$db->GetValues('select alias from korsars_sections where id='.$Url->Value('id'));
 		if (strpos($Alias,'http')===false)
			header("Location: http://${_SERVER['SERVER_NAME']}/$Alias/");
		else
			header("Location: $Alias");
	}


}
?>