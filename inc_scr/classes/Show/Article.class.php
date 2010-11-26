<?php
require_once(DataDir.'classes/Show.class.php');
class Article extends Show
{

	function getContent()
	{
		$this->FContentTemplate='Article.tpl';
		global $Url;
		$db=new dbKorsars;
		if( $Url->Value('article')!=null )
 		{
 			$article=$db->getValues('select * from korsars_articles where id='.$Url->Value('article'),'ALL');
			$this->FTitle='Статьи :: '.$article['NAME'];
			$this->FContentParams['title_page']=$article['NAME'];
	 		$this->FContentParams['Text']=$article['TEXT'];
	 		$this->FContentParams['Author']=$article['AUTHOR'];
 		}
 		else
 		{
 			$db->SetSql('select * from korsars_articles order by type,id');
			$this->FTitle='Статьи';
	 		$this->FContentParams['ArticleItems']=$db->getArray();
 		}
 		unset($db);
 	}
}
?>