<?php
define('IN_PHPBB', true); //признак того, что запускался инициализатор
include($phpbb_root_path . 'extension.inc'); //загрузка типа расширения скриптов
include($phpbb_root_path . 'common.'.$phpEx); //загрузка системных переменных и основных классов

//грузим форумный обработчик сессий
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

//данные по пользователю возвращаются из обработчика в $GLOBALS['userdata']
$user_data=$GLOBALS['userdata'];
$sid=$user_data['session_id']; //номер форумной сессии.

?>