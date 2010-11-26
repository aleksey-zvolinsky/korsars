<?php
require_once(DataDir.'classes/debug.class.php');
class MenuCreater
{	var $Debug;
	var $FMenuSelect;
	var $FOutput;
	var $FStructure;
	/*
	 array( '-1'=>array(<менюшки пренадлежащие menu_id="-1">) ,
	   '2'=>array(<менюшки пренадлежащие menu_id="-1">)
	 )
	*/

	function MenuCreater( $AOut=true,$AIsDebug=0 )
	{		 $this->Debug=new Debug($AIsDebug);
		 $this->Debug->_log('constructor MenuCreater',1);		 $this->FOutput=$AOut;
		 $this->Debug->_log('constructor MenuCreater_');	}

	function getStructure()
	{		$this->Debug->_log('MenuCreater->getStructure',1);		$db=getDB();
		global $Session;
		$lang_field_syfix=$Session->get('lang');
		$lang_field_syfix=($lang_field_syfix=='')?'':'_'.$lang_field_syfix;
		$sql="
SELECT m.`id` , m.`type` , caption$lang_field_syfix as caption , m.`menu_id` , m.`order_id` , concat( 'pages/', s.`id` ) AS alias, 'inside' as position, m.`content_id`
FROM `".PREFIX_DB."menus` m, `".PREFIX_DB."pages` s
WHERE m.`type` = 'pages'
AND m.`content_id` = s.`id`
UNION ALL
SELECT m.`id` , m.`type` , m.caption$lang_field_syfix as caption , m.`menu_id` , m.`order_id` , s.`alias`,s.`position`,m.`content_id`
FROM `".PREFIX_DB."menus` m, `".PREFIX_DB."sections` s
WHERE m.`type` = 'sections'
AND m.`content_id` = s.`id`
UNION ALL
SELECT m.`id` , m.`type` , m.caption$lang_field_syfix as caption , m.`menu_id` , m.`order_id` , '' as `alias`,'inside' as position,m.`content_id`
FROM `".PREFIX_DB."menus` m
WHERE m.`type` <> 'sections'
AND m.`type` <> 'pages'
ORDER BY menu_id,order_id,id";

        $this->FMenuSelect=$db->getArray($sql);
		//$this->Debug->_log($this->FMenuSelect);
        unset($db);
        $this->FStructure=array();
        if(!is_array($this->FMenuSelect))
        	user_error('Нет меню!');
        foreach( $this->FMenuSelect as $Menu ):
            $Out_alias=( $Menu['position']=='out' )? $Menu['alias']: $Menu['alias'].URL_ENDING;
        	$this->FStructure[$Menu['menu_id']][]=$Menu;
        	$this->FStructure[$Menu['menu_id']][count($this->FStructure)]['out_alias']=$Out_alias;
        endforeach;
        //$this->Debug->_log($this->FStructure);
   		$this->Debug->_log('MenuCreater->getStructure_');
	}

	function getMenu($AMenuId, $ACascade, $AIsHorisontal )
	{
		$this->Debug->_logf('MenuCreater->getMenu(%s,%s,%s)',array($AMenuId, $ACascade, $AIsHorisontal ),1);
		$this->getStructure();
		ob_start();
	    $this->getMenuByID($AMenuId, $ACascade, $AIsHorisontal);
		if( $this->FOutput===true )			ob_end_flush();
		else
		{
			$buffer=ob_get_contents();
			ob_end_clean();
			return $buffer;
		}
		$this->Debug->_log('MenuCreater->getMenu_');	}

	function getMenuByID( $AStartMenuId, $ACascade, $AIsHorisontal )
	{
		$this->Debug->_logf('MenuCreater->getMenuByID(%s,%s,%s)',array($AStartMenuId, $ACascade, $AIsHorisontal ),1);
		if($AIsHorisontal=='h')
		{	$this->Debug->_log('AIsHorisontal=true'); }
		else
		{	$this->Debug->_log('AIsHorisontal=false'); }
		//$this->Debug->_log($AIsHorisontal);		if( isset($this->FStructure[ $AStartMenuId ]) )
		{			//echo $current_link=getHttpHost().$_SERVER["REQUEST_URI"];
			echo "<table>\n\t";
			if($AIsHorisontal=='h')
				echo "<tr>\n\t";
			foreach( $this->FStructure[ $AStartMenuId ] as $brik ):
				//echo $brik["type"];br();
				//var_dump($brik);br();
				if( !isset($brik["type"]) )
					continue;
               // Error_Reporting(E_ALL & ~E_NOTICE);
				if($AIsHorisontal!='h')
					echo "<tr>\n\t";
				//Определение текущего пункта меню
				$current_link=getHttpHost();
				if( isset($_SERVER["REQUEST_URI"]) )
					$current_link.=substr($_SERVER["REQUEST_URI"],1);
				global $Session;
				if ($Session->get('RewriteMod')=='on')
					$menu_link=getHttpHost().'mod/'.$brik["type"].'/id/'.$brik["content_id"].URL_ENDING;
				else
					$menu_link=getHttpHost().'?mod='.$brik["type"].'&id='.$brik["content_id"];
				$class=( trim($current_link)==trim($menu_link) ) ?'menuitem_selected' :'menuitem';
				echo "<td class='$class'><a href='$menu_link'>".$brik['caption']."</a>";
				if( $ACascade )
				    $this->getMenuByID($brik['id'],$ACascade, $AIsHorisontal);
				echo "</td>\n";

				if($AIsHorisontal!='h')
					echo "</tr>\n";
			endforeach;
			if($AIsHorisontal=='h')
				echo "</tr>\n";
			echo "</table>\n";
		}
		$this->Debug->_log('MenuCreater->getMenuByID_');
	}}

?>
