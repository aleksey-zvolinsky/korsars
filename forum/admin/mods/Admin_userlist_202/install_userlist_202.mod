############################################################## 
## MOD Title: Admin Userlist
## MOD Author: wGEric < eric@best-dev.com > (Eric Faerber) http://mods.best-dev.com/ 
## MOD Description: This MOD lets you view all of you members and various information about 
##			them in the Admin Control Panel.  From the list, you can perform 
##			various actions on multiple users.
## MOD Version: 2.0.2
## 
## Installation Level: Easy 
## Installation Time: 10 Minutes 
## Files To Edit: language/lang_english/lang_admin.php
## Included Files: admin/admin_userlist.php
##		   templates/subSilver/admin/userlist_body.tpl
##		   templates/subSilver/admin/userlist_group.tpl
############################################################## 
## For Security Purposes, Please Check: http://www.phpbb.com/mods/ for the 
## latest version of this MOD. Downloading this MOD from other sites could cause malicious code 
## to enter into your phpBB Forum. As such, phpBB will not offer support for MOD's not offered 
## in our MOD-Database, located at: http://www.phpbb.com/mods/ 
############################################################## 
## Author Notes: 
##
##	Deleting users cannot be undone!
##
##	A special thanks to all those who helped test this MOD
##		GPHemsley
##		R45
##
############################################################## 
## MOD History: 
##
##   2004-07-13 - Versoin 2.0.2
##	- Fixed bugs with adding users to groups
##	- fixed other bugs as well
##
##   2004-05-24 - Version 2.0.1
##	- Fixed security issues
##	- Made compatible with php 3
##	- Fixed minor bugs
##
##   2004-05-18 - Version 2.0.0 
##      - complete rewrite of code
##	- added ability to add multiple users to a group
##	- changed look, Open/Close Feature
##	- Fixed all known bugs
## 
############################################################## 
## Before Adding This MOD To Your Forum, You Should Back Up All Files Related To This MOD 
############################################################## 

# 
#-----[ COPY ]------------------------------------------ 
#
copy admin/admin_userlist.php to admin/admin_userlist.php
copy templates/subSilver/admin/userlist_body.tpl to templates/subSilver/admin/userlist_body.tpl
copy templates/subSilver/admin/userlist_group.tpl to templates/subSilver/admin/userlist_group.tpl

# 
#-----[ OPEN ]------------------------------------------ 
#
language/lang_english/lang_admin.php


# 
#-----[ FIND ]------------------------------------------ 
#
# Full Line:
#	$lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';
#
$lang['Install_No_PCRE'] = 


# 
#-----[ AFTER, ADD ]------------------------------------------ 
#

//
// Admin Userlist Start
//
$lang['Userlist'] = 'User list';
$lang['Userlist_description'] = 'View a complete list of your users and perform various actions on them';

$lang['Add_group'] = 'Add to a Group';
$lang['Add_group_explain'] = 'Select which group to add the selected users to';

$lang['Open_close'] = 'Open/Close';
$lang['Active'] = 'Active';
$lang['Group'] = 'Group(s)';
$lang['Rank'] = 'Rank';
$lang['Last_activity'] = 'Last Activity';
$lang['Never'] = 'Never';
$lang['User_manage'] = 'Manage';
$lang['Find_all_posts'] = 'Find All Posts';

$lang['Select_one'] = 'Select One';
$lang['Ban'] = 'Ban';
$lang['Activate_deactivate'] = 'Activate/De-activate';

$lang['User_id'] = 'User id';
$lang['User_level'] = 'User Level';
$lang['Ascending'] = 'Ascending';
$lang['Descending'] = 'Descending';
$lang['Show'] = 'Show';
$lang['All'] = 'All';

$lang['Member'] = 'Member';
$lang['Pending'] = 'Pending';

$lang['Confirm_user_ban'] = 'Are you sure you want to ban the selected user(s)?';
$lang['Confirm_user_deleted'] = 'Are you sure you want to detele the selected user(s)?';

$lang['User_status_updated'] = 'User(s) status updated successfully!';
$lang['User_banned_successfully'] = 'User(s) banned successfully!';
$lang['User_deleted_successfully'] = 'User(s) deleted successfully!';
$lang['User_add_group_successfully'] = 'User(s) added to group successfully!';

$lang['Click_return_userlist'] = 'Click %shere%s to return to the User List';
//
// Admin Userlist End
//

# 
#-----[ SAVE/CLOSE ALL FILES ]------------------------------------------ 
# 
# EoM 