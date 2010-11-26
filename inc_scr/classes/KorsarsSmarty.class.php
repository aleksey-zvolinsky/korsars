<?php
require_once(SMARTY_DIR.'Smarty.class.php');

class KorsarsSmarty extends Smarty
{
	function KorsarsSmarty()
	{		$this->Smarty();
		//$this->debugging=true; 
		$this->template_dir=DataDir.'classes/work_smarty/templates/';
		$this->compile_dir=DataDir.'classes/work_smarty/templates_c/';
		$this->config_dir=DataDir.'classes/work_smarty/configs/';
		$this->cache_dir=DataDir.'classes/work_smarty/cache/';

		//$this->caching=true;
	}
};

?>