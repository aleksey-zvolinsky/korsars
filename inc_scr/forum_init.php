<?php
define('IN_PHPBB', true); //������� ����, ��� ���������� �������������
include($phpbb_root_path . 'extension.inc'); //�������� ���� ���������� ��������
include($phpbb_root_path . 'common.'.$phpEx); //�������� ��������� ���������� � �������� �������

//������ �������� ���������� ������
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

//������ �� ������������ ������������ �� ����������� � $GLOBALS['userdata']
$user_data=$GLOBALS['userdata'];
$sid=$user_data['session_id']; //����� �������� ������.

?>