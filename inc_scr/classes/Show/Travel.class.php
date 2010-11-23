<?php
require_once(DataDir.'classes/Show.class.php');
class Travel extends Show
{

	function getContent()
	{
		$this->FTitle='Походы';
		$this->FContentTemplate='Travel.tpl';
		global $Url;
		if( $Url->Value('detail')!=null )
 		{
 			$dbDet=GetDB();
 			$dbDet->SetSql('select * from korsars_travel_detail where travel_id='.$Url->Value('detail'));
	 		$dbDet->SetOrder('order by datetime');
	 		$this->FContentParams['TravelDetailItems']=$dbDet->GetArray();
 			$this->FContentParams['IsDetail']='Y';
	 		unset($dbDet);
            $AddWhere=' where id='.$Url->Value('detail');
 		}
 		else
 		{
 			$AddWhere='';
			$this->FContentParams['IsDetail']='N';
 		}
		$db=GetDB();
		$db->SetSql('select * from korsars_travel'.$AddWhere);
		$db->SetOrder('order by begin_date desc');
		$this->FContentParams['TravelItems']=$db->GetArray();
		/*$this->FContentParams['TravelItems']=array(
			array('ID'=>'1','NAME'=>'NAME','TYPE'=>'TYPE','BEGIN_DATE'=>'BD','END_DATE'=>'ED','COMMENTS'=>'C'));*/
		unset($db);
 	}
}
?>