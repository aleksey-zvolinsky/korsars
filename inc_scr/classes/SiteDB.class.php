<?php
require_once(DataDir.'classes/db/dbMySQL.class.php'); //ад

class SiteDB extends dbMySQL
{
	function SiteDB()
	{
		dbMySQL::dbMySQL();
		$this->FHost='localhost';
		$this->FUser='korsars_db1';
		$this->FPass='Cx7DWHY297YG';
		$this->FNameDb='korsars_db1';
	}
}
?>