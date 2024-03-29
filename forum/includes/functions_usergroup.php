<?php
/***************************************************************************
 *							   functions_usergroup.php
 *                            -------------------
 *   begin                : Tuesday, Aug 26, 2003
 *   copyright            : (C) 2003 Niels Chr. R�d
 *   email                : ncr@db9.dk
 *
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

function display_usergroups($viewer,$user,$blockname='',$template_file='')
{
	global $db,$template,$phpEx,$images;
	$sql = "SELECT  g.group_name, g.group_id, g.group_type, SUM(ug.user_id = '$viewer') as viewer , SUM(ug.user_id = '$user') as poster FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug 
	 WHERE  g.group_id = ug.group_id AND NOT g.group_single_user AND NOT ug.user_pending
		AND ug.user_id IN ('$viewer','$user')
		 GROUP BY ug.group_id having poster AND (g.group_type!=".GROUP_HIDDEN." OR viewer) ORDER BY g.group_name ";
	if(!$result = $db->sql_query($sql)) 
   		message_die(GENERAL_ERROR, "Error getting group information", "", __LINE__, __FILE__, $sql); 
	unset($group_list);
	$group_list = $db->sql_fetchrowset($result);
	if (!empty($group_list))
	{
		$template->set_filenames(array(
			'group_body' => ($template_file) ? $template_file.'.tpl' : 'show_usergroup.tpl'));
		$template->flush_block_vars('group');

		while (list($group_number, $group) = each($group_list))
		{
			$group_img = ($images['groups'][$group['group_id']]) ? '<img src="'.$images['groups'][$group['group_id']].'" border="0" alt="'.$group['group_name'].'">' : '';
			$group_url = append_sid("groupcp.$phpEx?g=".$group['group_id']); 
			$template->assign_block_vars('group', array(
				'GROUP_ID' => $group['group_id'],
				'GROUP_NAME' => $group['group_name'],
				'GROUP_IMG' => $group_img,
				'U_GROUP' => $group_url
			));
			if ($group['group_type']!=GROUP_HIDDEN)
			{
				$template->assign_block_vars('group.is_not_hidden', array());
			} else
			{
				$template->assign_block_vars('group.is_hidden', array());
			}
		}
		$template->append_var_from_handle_to_block($blockname,'SHOW_USERGROUPS', 'group_body');
		return true;
	}
	return false;
}

?>