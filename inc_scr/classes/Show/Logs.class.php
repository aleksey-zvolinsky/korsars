<?php
require_once(DataDir.'classes/Show.class.php');
class Logs extends Show
{
	var $FCleanLog=array(
		0=>'/subSilver/',
		'favicon.ico',
		'/logs/',
		'/include/main.css',
		'/images/');

	function Logs()
	{		Show::Show();
		$this->FTitle='Логи';	}
	function _content()
	{
		error_reporting( E_ALL );
		if( file_exists( LOG_DIR ) )
		{
			$file=file( LOG_DIR );
			foreach($file as $str)
			{
				$str=$this->NormalizeLogStr( $str );
				if( $str!='' )
					echo $str.br();			}
		}
		else
		{			user_error('Нет файла лога!'.LOG_DIR,E_USER_NOTICE);
		}
	}
	function NormalizeLogStr( $AStr )
	{

		foreach( $this->FCleanLog as $Condition )			if(strpos($AStr,$Condition)!==false)
				return '';
		return $AStr;	}
}
?>