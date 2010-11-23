<?php
//require_once("../../classes/KorsarsSmarty.class.php");
global $phpbb_root_path;
global $user_data;
global $sid;

$smarty=GetSmarty();
//������ � ������ ������������
//�������� � ��������� $user_data ������� ��������� �� forum_init.php
//$phpbb_root_path - ������� ������ �� ����� �����
//������������� ����� ��������� (�������� ����� ../) �.�. �� ������� ���� ������ �� ������ � �������� ������� ����������� � �����������
//phpinfo();
$redirect='..'.$_SERVER["REDIRECT_URL"];
//if ($_SERVER['QUERY_STRING']<>'') $redirect.='?'.$_SERVER['QUERY_STRING'];

$smarty->assign('ForumPath','http://'.$_SERVER['SERVER_NAME'].'/'.$phpbb_root_path);
$smarty->assign('sid',$sid);
$smarty->assign('Redirect',$redirect);
if ($user_data['user_id']==-1)
{
	//���� ������������ �����.. ������� ������� ������ ��� �����
	$smarty->display('UserLogin.tpl');
}
else
{
	//var_dump($user_data);
	$smarty->assign('UserName',$user_data['username']);
	$smarty->assign('UserLastVisit',date ($user_data['user_dateformat'] , $user_data['user_lastvisit']));
	$smarty->assign('UserNewPrivMsg',$user_data['user_new_privmsg']);
	if( $user_data['user_avatar']=='' )
	  $smarty->assign('UserAvatar','');
	elseif ($user_data['user_avatar_type']==1)
 	 $smarty->assign('UserAvatar',
	    'http://'.$_SERVER['SERVER_NAME'].'/'.$phpbb_root_path.'images/avatars/'
 	   .$user_data['user_avatar']);
	else
		$smarty->assign('UserAvatar',$user_data['user_avatar']);
	$smarty->display('UserLogged.tpl');
}

?>