<?php
require_once(DataDir.'classes/Show.class.php');
class InWork extends Show
{
	{
		$this->FSmarty->display('InWork.tpl');
	}
}
?>