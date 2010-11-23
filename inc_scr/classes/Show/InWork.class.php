<?php
require_once(DataDir.'classes/Show.class.php');
class InWork extends Show
{	function _content()
	{
		$this->FSmarty->display('InWork.tpl');
	}
}
?>