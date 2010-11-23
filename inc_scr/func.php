<?php
function GetVal($p_str,$p_null_return='',$p_not_null_return='')
// берем параметры для формы
{
	if(isset($_POST[$p_str]))
	{
		if($p_not_null_return=='')
			return $_POST[$p_str];
		else
			return $p_not_null_return;
	}
	else if(isset($_GET[$p_str]))
	{
		if($p_not_null_return=='')
			return $_GET[$p_str];
		else
			return $p_not_null_return;
	}
	else
		return $p_null_return;
};

function br()
{
  echo '<br />';
};

function IsKorsar( $UserId )
{
	$db=GetDB();
	$Val=$db->GetValues( "select count(*) from phpbb_user_group where user_id=$UserId and group_id=".GroupKorsars );
	return ($Val!=0)?1:0;
};

function getHttpHost()
{
	return 'http://'.$_SERVER["HTTP_HOST"].'/';
};

function nvl($AValue,$IfValueNull)
{
	if( $AValue==null )
		return $IfValueNull;
	else
		return $AValue;
};

function FindHref($var)
{
	return (strpos( strtoupper($var),'HREF')===false)? false: true;
}

function SmartyAppendSid($ATemplate,&$Smarty)
{

	$str=strip_tags($ATemplate,'<a>');
	$arr=split('[ >]',$str);
	/*?><pre><?
	var_dump($arr);
	?></pre><?   */
	$hrefs=array_filter($arr,'FindHref');
	/*?><pre><?
	var_dump($hrefs);
	?></pre><? */
	foreach($hrefs as $href):
		$href=str_replace('href=','', $href);
		$href=str_replace('"','', $href);
		$href=str_replace("'",'', $href);
		echo br().$new_href=append_sid($href);
		$ATemplate=str_replace($href,$new_href,$ATemplate);
	endforeach;
	return $ATemplate;
};
function GetDB()
{
	require_once(DataDir.'classes/SiteDB.class.php'); //БД
	return new SiteDB();
}

function GetUrl()
{
	require_once(DataDir.'classes/ParseUrl.class.php'); //парсинг урла
	return new ParseUrl();
}

function GetSmarty()
{
	require_once(DataDir.'classes/SiteSmarty.class.php');//Smarty
	return new SiteSmarty();
}

function GetSession()
{
	require_once(DataDir.'classes/Session.class.php');//Smarty
	return new Session();
}


?>