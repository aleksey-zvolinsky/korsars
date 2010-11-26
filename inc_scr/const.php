<?php
	//url
	define('URL_ENDING','.html');
	//path
	define('DataDir',str_replace( '\\','/',getcwd().'/inc_scr/' ));
	define('SMARTY_DIR', DataDir.'classes/smarty/');
	define('LOG_DIR','/home/logs/korsars.kiev.ua-access');
	//database
	define('PREFIX_DB','korsars_');
    if( strpos($_SERVER["HTTP_HOST"],'korsars.kiev.ua')===false )
	{
		define('DB_HOST','localhost');
		define('DB_USER','root');
		define('DB_PASSWD','');
		define('DB','korsars_db1');
	}
	else
	{
		define('DB_HOST','localhost'); 		define('DB_USER','korsars_db1');
		define('DB_PASSWD','Cx7DWHY297YG');
		define('DB','korsars_db1');	}
	//news
	define('NEWS_PER_PAGE',10);
	//forum
	global $phpbb_root_path;
	$phpbb_root_path='forum/';
	//some consts
	define('GroupKorsars',6);

?>