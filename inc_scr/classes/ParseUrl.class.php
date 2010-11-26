<?php

require_once(DataDir.'classes/debug.class.php');

class ParseUrl
{
	var $Debug;
	var $FUrl;//Входной урл
	var $FNullValue='-';
	var $FArray=array();//Выходящий масив с параметрами
	/**
	<ul>
	<li>Если после строкового параметра записываеться строковый, то первый записывается,
	  как параметр без значения;</li>
	<li>Если после строкового параметра записываеться числовой параметр, то первый запишеться
	  как параметр со значением второго.</li>
	</ul>
	<p>Пример:</p>
	<pre>
	FUrl=/store/book/10.html
	array(
	  'store'=>'-',
	  'book'=>'10');
	</pre>
	*/

	function ParseUrl( $AUrl=null, $IsDebug=0 )
	{
		$this->Debug=new Debug($IsDebug);
		$this->Debug->_log('constructor ParseUrl',1);
		if(isset( $AUrl ))
			$this->FUrl=$AUrl;
		else
			$this->FUrl=$_SERVER["REQUEST_URI"];
		$this->Debug->_log('"'.$this->FUrl.'"');
		$this->Debug->_log('ParseUrl_');
	}

	function Exists( $AParam )
	{
		$this->Debug->_logf('ParseUrl->Exists(%s)',array($AParam),1);
		$this->Debug->_log('ParseUrl->Exists_');
		return array_key_exists( $AParam,$this->getArray() );
	}

	function Value( $AParam )
	{
		$this->Debug->_log('ParseUrl->Value',1);
		if( ($this->Exists( $AParam ))&&($this->FArray[$AParam]!=$this->FNullValue) )
			return $this->FArray[$AParam];
		else
			return null;
		$this->Debug->_log('ParseUrl->Value_');
	}

	function ParamByName( $AParam )
	{
		$this->Debug->_log('ParseUrl->Value',1);
		if( ($this->Exists( $AParam ))&&($this->FArray[$AParam]!=$this->FNullValue) )
			return $this->FArray[$AParam];
		else
			return null;
		$this->Debug->_log('ParseUrl->Value_');
	}
    /**
      Выдает параметр по номеру
    */
	function ParamByNumber( $ANumber )
	{
		$this->Debug->_log('ParseUrl->ParamByNumber',1);
		$i=0;
		$result=null;
		$this->getArray();
		foreach($this->FArray as $key=>$value):
			$this->Debug->_log(array($key=>$value));
			if($i==$ANumber)
				$result=array($key=>$value);
			$i++;
		endforeach;
		return $result;
		$this->Debug->_log('ParseUrl->ParamByNumber_');
	}
	function NameByNumber( $ANumber )
	{
		$this->Debug->_log('ParseUrl->NameByNumber',1);
		$result=null;
		if(is_array($this->ParamByNumber($ANumber)))
		{			$a=array_keys($this->ParamByNumber($ANumber));
			$result=trim($a[0]);
			unset($a);		};
		return $result;
		$this->Debug->_log('ParseUrl->NameByNumber_');
	}
	function ValueByNumber( $ANumber )
	{
		$this->Debug->_log('ParseUrl->ValueByNumber',1);
		$result=null;
		if(is_array($this->ParamByNumber($ANumber)))
		{
			$a=array_values($this->ParamByNumber($ANumber));
			$result=trim($a[0]);
			unset($a);
		};
		return $result;
		$this->Debug->_log('ParseUrl->ValueByNumber_');
	}
    /**
    Обработчик урла
    */
	function getArray()
	{
		$this->Debug->_log('ParseUrl->getArray()',1);
		$this->FArray=array();
		global $Session;
		if($Session->get('RewriteMod')=='on' )
		{
			$arr=explode('/',$this->getUrl());
			$this->Debug->_log($arr);
			$prev_str='';
            foreach($arr as $str):
				if($prev_str=='')
				{
					$this->FArray[$str]='';
					$prev_str=$str;
				}
				else
				{
					$this->FArray[$prev_str]=$str;
					$prev_str='';
				}

            endforeach;
			/*$prev_str='';
			foreach($arr as $str):
				$this->Debug->_log($prev_str);
				$this->Debug->_log($str);
				if( $prev_str=='' )
				{
					$this->Debug->_log('prev_str==""');
					$prev_str=$str;
					continue;
				}
				if( is_numeric($str)===true)
				{
    	            $this->Debug->_log("is_int $str");
					$this->FArray[trim($prev_str)]=$str;
					$prev_str='';
				}
				else
				{
					$this->Debug->_log("is_not_int $str");
					$this->FArray[trim($prev_str)]=$this->FNullValue;
					$prev_str=$str;
				}
			endforeach;
			if( is_numeric($prev_str)===false )
				$this->FArray[trim($prev_str)]=$this->FNullValue;*/
        }
        else
        {
        	parse_str($this->getUrl(),$this->FArray);
        }
		$this->Debug->_log($this->FArray);
		$this->Debug->_log('ParseUrl->getArray()_');
		return $this->FArray;
	}

	/**
	Выдает очищеный урл
	*/
	function getUrl()
	{
		$this->Debug->_log('ParseUrl->getUrl()',1);		$strUrl=$this->FUrl;		//очистка урла
		$url=parse_url($this->FUrl);
		//echo $url['path'];
		//echo $url['query'];

/*		while(strpos($strUrl,'//')!==false):
			$strUrl=str_replace('//','/',$strUrl);
		endwhile;
		if( strpos($strUrl,URL_ENDING)!==false )
			$strUrl=str_replace(URL_ENDING,'',$strUrl);
		if( $strUrl[0]=='/' )
			$strUrl[0]=null;
		if( strpos($strUrl,'?')!==false )
			$strUrl=substr( $strUrl,0,strpos($strUrl,'?') );
		if( strpos($strUrl,'#')!==false )
			$strUrl=substr( $strUrl,0,strpos($strUrl,'#') );              */
		$this->Debug->_logf('ParseUrl->getUrl(%s)_',array(0=>$strUrl));
		global $Session;
		if($Session->get('RewriteMod')=='on' )
			return str_replace(URL_ENDING,'',$url['path']);
		elseif (isset($url['query']))
			return $url['query'];
		else
			return null;
//		return $strUrl;
	}
}

?>