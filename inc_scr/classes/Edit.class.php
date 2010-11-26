<?php
require_once(DataDir.'classes/Grants/GrantsEdit.class.php');

class Edit
{
	var $FTitle='';
	var $FFormatTitle='Админ-панель :: %s';
	var $FMaxGridLen=100;
	var $FSmarty;
	var $FContentTemplate;
	var $FContentText;
	var $FContentParams=array();
	var $FPanels;
	var $FGrants;
	var $FTable;
	var $FEditFields;
	var $FOrderCause;

	function Edit()
	{
		$this->FSmarty=getSmarty();
		$this->FGrants=new GrantsEdit();
		$this->FContentParams['Mod']=get_class($this);
	}

	function display()
	{
		ob_start();
		$this->getContent();
		$buffer=ob_get_contents();
		if( ($this->FContentTemplate=='' )and($this->FContentText=='') )
		{
			$this->FContentText=$buffer;
			ob_end_clean();
		}
		else
			ob_end_flush();
		$this->getIndex();
	}

	function getTitle()
	{
		if( $this->FTitle=='' )
			return "";
		else
			return sprintf( $this->FFormatTitle,$this->FTitle );
	}

	function getIndex()
	{
		//формирование возможных панелей в левой части
		$Dir=dir(DataDir.'classes/Edit/');
		while (false !== ($FileName = $Dir->read()))
		{
		    if(basename($FileName,'.class.php')!=$FileName)
		    {
				require_once(DataDir.'classes/Edit/'.$FileName);
				$Panel['Name']=basename($FileName,'.class.php');
				$EditClass=new $Panel['Name'];
    			$Panel['Title']= $EditClass->FTitle;
    			$this->FPanels[]=$Panel;
    		}
		}
		$Dir->close();

		//var_dump($this->FPanels);
		//формирование контента
		$this->FSmarty->assign('Panels',$this->FPanels);

		global $sid;
		$this->FSmarty->assign('sid',$sid);

		$this->FSmarty->assign('title',$this->getTitle());
		$this->FSmarty->assign_by_ref('Grants',$this->FGrants);
		$this->FSmarty->assign('ContentText',$this->FContentText);
		$this->FSmarty->assign('ContentTemplate',$this->FContentTemplate);
		if( count($this->FContentParams)!=0 )
			foreach($this->FContentParams as $key=>$value):
				$this->FSmarty->assign($key,$value);
				//echo $key;br();
				//echo $value;br();
			endforeach;
		/*вывод на печать*/
		$this->FSmarty->display('EditIndex.tpl');
	}

	function SelectFields()
	{		if(is_array($this->FEditFields))
			return implode(',',$this->FEditFields);
		else
			user_error('Не определены редактируемые поля!');
	}

	function getContent()
	{
		$db=getDB();
		$Fields=$db->getFields(PREFIX_DB.$this->FTable);
		// Удаляем лишние поля
		//var_dump($this->FEditFields); br();  br();
		//var_dump($Fields);
		foreach($Fields as $key=>$value):
			$str=strtoupper($value['Field']);
			if(array_search($str,$this->FEditFields)===false)
				unset($Fields[$key]);
		endforeach;
		//echo nl2br(print_r($Fields,true));
		$this->FContentParams['Fields']=$Fields;
		// Редактирование и добавление
		if(isset($_POST['ID']))
		{
			$db->InsOrUpdByForm(
				PREFIX_DB.$this->FTable,
				$this->FEditFields,
				'ID',$_POST['ID']);

			echo "<center>Сохранение прошло успешно!</center>";
			//print_r($_SERVER);
			$url=substr($_SERVER['HTTP_REFERER'],0,strpos($_SERVER['HTTP_REFERER'],'&'));
			unset($_POST);
			//header("Location: $url&sid=$sid");
		}
		global $Url;//достаем парсер урла
		if($Url->Exists('id') and $Url->Exists('action') and $Url->ParamByName('action')=='delete')
		{
			$db->Delete(
				PREFIX_DB.$this->FTable,
				'ID',$Url->ParamByName('id'));
		}

    	if( $Url->Exists('id')
    		and( ($Url->Exists('action') and $Url->ParamByName('action')=='edit')
    			or $Url->ParamByName('id')==-1))
    	{
 			$a=$db->GetValues(
 			  "select ".$this->SelectFields()
 			  ."  from ".PREFIX_DB."$this->FTable where id=".$Url->ParamByName('id'),'ALL');
			$this->FContentParams['ID']=$Url->ParamByName('id');
			if(isset($a))
			{
				$this->FContentParams['Item']=$a;
			}
			else
				$this->FContentParams['TimeStamp']=date('Y.m.d H:i:s');
		}
		else//if($Url->ParamByName('action')=='delete')
		{

			$a=$db->getArray(
				"select ".$this->SelectFields()
				."  from ".PREFIX_DB."$this->FTable $this->FOrderCause");
			foreach($a as $key => $row):
				foreach($row as $rowkey=> $rowvalue):
					if(strlen($rowvalue)>$this->FMaxGridLen)
						$a[$key][$rowkey]=substr($rowvalue,0,$this->FMaxGridLen);
					$a[$key][$rowkey]=htmlentities($a[$key][$rowkey],ENT_NOQUOTES,'cp1251');
				endforeach;
			endforeach;
			$this->FContentParams['Items']=$a;
			//print_r($a);
		}
 		unset($db);
 		$this->FContentTemplate='Edit.tpl';
 	}

}
?>