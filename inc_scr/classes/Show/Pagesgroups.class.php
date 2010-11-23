<?php
require_once(DataDir.'classes/Show.class.php');

class PagesGroups extends Show
{
	function getContent()
	{
		global $Url;//достаем парсер урла
		$this->FContentTemplate='PagesGroups.tpl';
		if( ($Url->Exists('id'))&&($Url->ParamByName('id')!='0') )
 			$AddWhere='parts.id='.$Url->ParamByName('id');
 		else
 			$AddWhere='1=1';

 		$db=GetDB();
 		$a=$db->GetArray("
 		  select pages.id as page_id, pages.name page_name,
 		         parts.id part_id, parts.name part_name
 		    from ".PREFIX_DB."pages as pages,
 		         ".PREFIX_DB."parts as parts
 		   where pages.parts_id=parts.id
 		     and $AddWhere
 		   order by parts.id asc, pages.id asc");
	 	$this->FTitle='Группы статей';
        $this->FContentParams['PagesGroups']=$a;
	 	unset($db);
 	}
}
?>