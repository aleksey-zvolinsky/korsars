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
	{
		$this->FTitle='����';

	{
		error_reporting( E_ALL );
		if( file_exists( LOG_DIR ) )
		{
			$file=file( LOG_DIR );
			foreach($file as $str)
			{
				$str=$this->NormalizeLogStr( $str );
				if( $str!='' )
					echo $str.br();
		}
		else
		{
		}
	}
	function NormalizeLogStr( $AStr )
	{

		foreach( $this->FCleanLog as $Condition )
				return '';
		return $AStr;
}
?>