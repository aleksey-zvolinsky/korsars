<?php
class dbKorsars extends dbMySQL
{	function dbKorsars()
	{
		dbMySQL::dbMySQL();
		if( strpos($_SERVER["HTTP_HOST"],'korsars.kiev.ua')===false )
		{
			$this->FHost='localhost';
			$this->FUser='root';
			$this->FPass='';
			$this->FNameDb='korsars_db1';
		}
		else
		{			$this->FHost='localhost';
			$this->FUser='korsars_db1';
			$this->FPass='Cx7DWHY297YG';
			$this->FNameDb='korsars_db1';
		}	}
}?>