<?php
require_once(DataDir.'classes/Show.class.php');
class First extends Show
{/*	function display()
	{
		$this->FSmarty->display('First.tpl');
	}*/
	function getContent()
	{		$this->FContentTemplate='First.tpl';	}
}
?>