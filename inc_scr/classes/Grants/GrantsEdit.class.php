<?php
require_once(DataDir.'classes/Grants.class.php');
class GrantsEdit extends Grants
{	var $Edit;
	var $Add;
	var $Delete;
	function GrantsEdit()
	{  		Grants::Grants();
		$this->Edit=false;
		$this->Add=false;
		$this->Delete=false;	}}

?>