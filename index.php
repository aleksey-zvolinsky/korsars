<?php
	//УДАЛИТЬ
	//var_dump($_GET);
	if( isset($_GET['phpinfo']) )
		phpinfo();
	if( isset($_GET['errors']) )
		error_reporting(E_ALL);
	//Служебные
	include('inc_scr/const.php');//переменные
//	require_once($phpbb_root_path . 'includes/sessions.php');
	require_once(DataDir.'func.php');//разные функции
	require_once(DataDir.'forum_init.php');//инициализация форума
	require_once(DataDir.'classes/MainPage.class.php');//генерилка страниц

	//Инициализация переменных переменные
	global $user_data;//данные пользователя
	global $sid;

	global $Session;
	if(!isset($Session))
	{
		$Session=GetSession();
		$Session->Start();
	}
	$Session->set('RewriteMod','on');

	global $Url;
	$Url=GetUrl();

    $mod=nvl($Url->ParamByName('mod'),'news');
    $Action='Show';
    if( isset($IsAdminPanel) )
    	if($IsAdminPanel===true)
    	{
    		$Action='Edit';
    		$mod=nvl($Url->ParamByName('mod'),'news');
    		$Session->set('RewriteMod','off');
    	}

	//Обработка страниц
	$Main=new MainPage();
	$ClassName=ucfirst($mod);
	$Path=DataDir."classes/$Action/$ClassName.class.php";
	if(file_exists($Path))
	{
		require_once($Path);
		$Main->$Action(new $ClassName);

	}

?>