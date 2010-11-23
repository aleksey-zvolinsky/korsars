<?php
require_once(SMARTY_DIR.'Smarty.class.php');

class SiteSmarty extends Smarty
{
	function SiteSmarty()
	{
		$this->Smarty();
		$this->template_dir=DataDir.'templates/';
		$this->compile_dir=DataDir.'classes/work_smarty/templates_c/';
		$this->config_dir=DataDir.'classes/work_smarty/configs/';
		$this->cache_dir=DataDir.'classes/work_smarty/cache/';
	}
};

?>