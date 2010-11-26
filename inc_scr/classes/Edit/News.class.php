<?php
require_once(DataDir.'classes/Edit.class.php');

class News extends Edit
{
	function News()
	{
		Edit::Edit();
		$this->FTitle='Новости';
		$this->FGrants->Add=true;
		$this->FGrants->Edit=true;
		$this->FGrants->Delete=true;
		$this->FTable='news';
		$this->FEditFields=array(0=>'ID','TITLE','DATE','TEXT');
		$this->FOrderCause=' order by DATE desc';
	}

}
?>