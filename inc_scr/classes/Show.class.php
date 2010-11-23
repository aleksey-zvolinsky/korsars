<?php
require_once(DataDir.'classes/MenuCreater.class.php'); //БД

class Show
{
	var $FFormatTitle='КОРСАРЫ :: %s';
	var $FTitle='';
	var $FSmarty;
	var $FContentTemplate;
	var $FContentText;
	var $FContentParams=array();

	function Show()
	{
		$this->FSmarty=GetSmarty();
	}

	function display()
	{
		ob_start();
		$this->getContent();
		$buffer=ob_get_contents();

		if( ($this->FContentTemplate=='' )and($this->FContentText=='') )
		{
			$this->FContentText=$buffer;
			ob_end_clean();
		}
		else
			ob_end_flush();
		$this->showIndex();	}

	function _title()
	{
		if( $this->FTitle=='' )
			return "";
		else			return sprintf( $this->FFormatTitle,$this->FTitle );	}

	function showIndex()
	{
		$this->FSmarty->assign( 'title',$this->_title() );
		$this->FSmarty->assign( 'title_page',$this->FTitle );
		//формирование контента
		$this->FSmarty->assign('ContentTemplate', $this->FContentTemplate);
		$this->FSmarty->assign('ContentText', $this->FContentText);
		$this->FSmarty->assign('ContentId', get_class($this));
		if( count($this->FContentParams)!=0 )
			foreach($this->FContentParams as $key=>$value)
				$this->FSmarty->assign($key,$value);
		//формирование меню
		$Menu=new MenuCreater(false);
		// $this->FSmarty->assign('MainMenu',$Menu->GetMenu(-1,false,'h'));
		$this->FSmarty->assign('MainDetailedMenu',$Menu->GetMenu(-1,false,'v'));
		unset($Menu);
		//ссылка админ раздела
		global $user_data;
		global $sid;
		if( ($user_data['user_id']!=-1)and(IsKorsar($user_data['user_id'])==1) )
			$this->FSmarty->assign( 'AdminLink',"<a href='http://${_SERVER['SERVER_NAME']}/cms/?sid=$sid'>Администраторский раздел</a>" );
		//вывод на печать		$this->FSmarty->display('index.html');	}

	/* abstract */function getContent()
	{
	}

	/* abstract */function getEditContent()
	{
	}
}
?>