<?php
require_once(DataDir.'classes/Show.class.php');

class Pages extends Show
{
	function getContent()
	{
		global $Url;//достаем парсер урла
		//var_dump($Url);
		if( $Url->Exists('id') )
 		{
 			$db=GetDB();
 			$a=$db->GetValues('select * from '.PREFIX_DB.'pages where id='.$Url->ParamByName('id').' order by id','ALL');
	 		$this->FTitle=$a['NAME'];
	 		$this->FContentTemplate='Pages.tpl';
	 		$this->FContentParams['text']=$a['TEXT'];
	 		unset($db);
 		}
 		else
 		{
 			$db=GetDB();
 			$a=$db->GetValues('select * from '.PREFIX_DB.'pages where id=1 order by id','ALL');
	 		$this->FTitle=$a['NAME'];
	 		$this->FContentTemplate='Pages.tpl';
	 		$this->FContentParams['text']=$a['TEXT'];
	 		unset($db);
	 	}
 	}
}
?>