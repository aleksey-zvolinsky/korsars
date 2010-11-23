<?php
/* Админка */
	//УДАЛИТЬ
	//var_dump($_GET);
	if( isset($_GET['phpinfo']) )
		phpinfo();
	if( isset($_GET['errors']) )
		error_reporting(E_ALL);
	//Служебные
	$IsAdminPanel=false;
	chdir(getcwd().'/..');
	include('inc_scr/const.php');//переменные
	include('inc_scr/func.php');//библиотека с функциями
	require_once('inc_scr/func.php');//разные функции
	require_once('inc_scr/forum_init.php');//инициализация форума
	global $Session;
	$Session=getSession();
	$Session->Start();
	if( ($user_data['user_id']==-1)or(IsKorsar($user_data['user_id'])==0) )
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/index.php');
	else
	{
		define('ROLE',ROLE_ADMIN);
		$IsAdminPanel=true;
		include('index.php');
	}

?>