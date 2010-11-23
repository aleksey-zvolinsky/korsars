<?php
require_once(DataDir.'classes/Show.class.php');
class News extends Show
{

	function getContent()
	{
		$this->FTitle='Новости';
		$db=GetDB();
 		$db->SetSql('select * from korsars_news');
 		$db->SetOrder('order by date desc');
 		global $Url;
 		$Id=$Url->Value('id');
 		$Id=(($Id==0)or($Id==null))?1:$Url->Value('id');
		$db->SetRangeByPage( $Id,NEWS_PER_PAGE );
		$navigation=$db->GetRangedNavigation(
			array(0=>'[<a href="http://'.$_SERVER["SERVER_NAME"].'/mod/news/id/{PAGE_NUM}'.URL_ENDING.'">{PAGE_CAPTION}</a>]','[{PAGE_CAPTION}]'),
			array(0=>'[<a href="http://'.$_SERVER["SERVER_NAME"].'/mod/news/id/{PAGE_NUM}'.URL_ENDING.'">{PAGE_NUM}</a>]','[{PAGE_NUM}]'),
			array('FIRST'=>'Первая','LAST'=>'Последняя','PREVIOUS'=>'Предыдущая','NEXT'=>'Следущая')
			);
		$this->FSmarty->assign('NewsItems',$db->GetArray());
		$this->FSmarty->assign('NewsNavigation',$navigation);
		$this->FContentTemplate='News.tpl';
	}


}
?>