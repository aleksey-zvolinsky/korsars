<?php
/** 
*
* attachment mod main [RUSSIAN]
*
* @package attachment_mod
* @version $Id: lang_main_attach.php,v 1.1 2005/11/05 10:25:02 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* Translated by  Makc666 (makc666@newmail.ru)
*/

/**
* DO NOT CHANGE
*/
if (!isset($lang) || !is_array($lang))
{
	$lang = array();
}

//
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$lang['Rules_attach_can'] = 'Вы <b>можете</b> добавлять приложения в этом форуме';
$lang['Rules_attach_cannot'] = 'Вы <b>не можете</b> добавлять приложения в этом форуме';
$lang['Rules_download_can'] = 'Вы <b>можете</b> скачивать файлы в этом форуме';
$lang['Rules_download_cannot'] = 'Вы <b>не можете</b> скачивать файлы в этом форуме';
$lang['Sorry_auth_view_attach'] = 'Извините, но у Вас нет прав для просмотра или скачивания данного приложения';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'Описание'; // used in Administration Panel too...
$lang['Downloaded'] = 'Скачено';
$lang['Download'] = 'Скачать'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Размер файла';
$lang['Viewed'] = 'Просмотров';
$lang['Download_number'] = '%d раз(а)'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'Расширение \'%s\' было отключено администратором, поэтому данное приложение не отображается.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Контрольная панель приложений';
$lang['Attach_posting_cp_explain'] = 'Если Вы нажмёте на "Добавить Приложение", Вы увидите окно для добавления файлов.<br />Если Вы нажмёте на "Добавленные Приложения", Вы увидите список уже добавленных файлов и сможете их отредактировать.<br />Если Вы хотите заменить (закачать новую версию) файла, Вы должны нажать обе ссылки. Выберите файл, как Вы это обычно делаете, но после этого не нажимайте на "Добавить Приложение", а нажмите на "Закачать новую версию".';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Добавить Приложение';
$lang['Add_attachment_title'] = 'Добавить Приложение';
$lang['Add_attachment_explain'] = 'Если Вы не хотите добавлять приложения к Вашему сообщению, пожалуйста, оставьте поля пустыми';
$lang['File_name'] = 'Название файла';
$lang['File_comment'] = 'Комментарий к файлу';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Добавленные Приложения';
$lang['Options'] = 'Настройки';
$lang['Update_comment'] = 'Изменить комментарий';
$lang['Delete_attachments'] = 'Удалить приложения';
$lang['Delete_attachment'] = 'Удалить приложение';
$lang['Delete_thumbnail'] = 'Удалить миниатюру';
$lang['Upload_new_version'] = 'Закачать новую версию';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s неправильное название файла'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'Приложение слишком большое.<br />Нельзя установить максимальный размер установленный в PHP.<br />Мод Приложений не может определить максимальный размер загрузки установленный в php.ini.';
$lang['Attachment_php_size_overrun'] = 'Приложение слишком большое.<br />Максимальный размер загрузки: %d МБ.<br />Заметьте, что эта величина установлена в php.ini, это значит, что она установлена PHP и Мод Приложений не может изменить данное значение.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'Расширение %s не разрешено'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'Запрещено добавлять файлы с расширением %s в данном форуме'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'Приложение слишком большое.<br />Максимальный размер загрузки: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Извините, но максимальный размер для всех приложений достигнут. Пожалуйста, свяжитесь с администратором форума, если у Вас есть вопросы.';
$lang['Too_many_attachments'] = 'Приложение не может быть добавлено, так как достигнуто максимальное число %d приложений в этом сообщение'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'Приложение/Изображение должно быть меньше чем %d пикселей в ширину и %d пикселей в высоту'; 
$lang['General_upload_error'] = 'Проблема с закачкой: Невозможно закачать приложение в %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Вы должны ввести данные в окне \'Добавить Приложение\'';
$lang['Error_missing_old_entry'] = 'Не могу изменить приложение, не могу найти старую запись о приложении';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'Извините, но максимальный размер для всех приложений в Вашей папке личных сообщений достигнут. Пожалуйста, удалите некоторые из Ваших полученных/отправленных приложений.';
$lang['Attach_quota_receiver_pm_reached'] = 'Извините, но максимальный размер для всех приложений в папке личных сообщений пользователя \'%s\' достигнут. Пожалуйста, сообщите ему об этом, или подождите пока он/она удалит некоторые из своих приложений.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Вы не выбрали приложение для скачивания/просмотра.';
$lang['Error_no_attachment'] = 'Выбранное приложение больше не существует.';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Вы уверены, что хотите удалить выбранные приложения?';
$lang['Deleted_attachments'] = 'Выбранные приложения были удалены.';
$lang['Error_deleted_attachments'] = 'Не могу удалить приложения.';
$lang['Confirm_delete_pm_attachments'] = 'Вы уверены, что хотите удалить все приложения в этом личном сообщении?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'Приложения отключены.';

$lang['Directory_does_not_exist'] = 'Директория \'%s\' не существует или не найдена.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Пожалуйста, проверьте, что \'%s\' это директория.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Запись в директорию \'%s\' запрещена. Вам необходимо создать данную директорию и установить её chmod на 777 (или изменить владельца директории на владельца сервера-http), чтобы получить возможность добавлять файлы.<br />Если у Вас есть доступ только через обычный FTP, измените атрибут директории на rwxrwxrwx.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'Невозможно связаться с FTP сервером: \'%s\'. Пожалуйста, проверьте Ваши FTP настройки.';
$lang['Ftp_error_login'] = 'Невозможно войти на FTP сервер.  Имя \'%s\' или пароль неправильные. Проверьте Ваши FTP настройки.';
$lang['Ftp_error_path'] = 'Нет доступа к директории FTP: \'%s\'. Проверьте Ваши, FTP настройки.';
$lang['Ftp_error_upload'] = 'Невозможно закачать файлы в директорию FTP: \'%s\'. Проверьте Ваши, FTP настройки.';
$lang['Ftp_error_delete'] = 'Невозможно удалить файлы из директории FTP: \'%s\'. Проверьте Ваши, FTP настройки.<br />Другая возможная причина данной ошибке может заключаться в отсутствие приложения, пожалуйста, сначала проверьте это через теневых приложениях.';
$lang['Ftp_error_pasv_mode'] = 'Невозможно включить/выключить PASV режим FTP';

// Attach Rules Window
$lang['Rules_page'] = 'Правила приложений';
$lang['Attach_rules_title'] = 'Разрешённые группы расширений и их размеры';
$lang['Group_rule_header'] = '%s -> Максимальный размер для закачки: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Разрешённые расширения и их размеры';
$lang['Note_user_empty_group_permissions'] = 'Замечание:<br />По умолчанию Вы имеете право добавлять приложения в этом форуме, <br />но так как ни одна группа расширений здесь не разрешена для добавления, <br />Вы не можете ничего добавить. Если Вы попробуете, <br />Вы получите сообщение об ошибке.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Квота закачек';
$lang['Pm_quota'] = 'Квота личных сообщений';
$lang['User_upload_quota_reached'] = 'Извините, Вы достигли максимального размера квоты для закачек: %d %s'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Контрольная панель приложений пользователя';
$lang['UACP'] = 'Контрольная панель приложений пользователя';
$lang['User_uploaded_profile'] = 'Закачено: %s';
$lang['User_quota_profile'] = 'Квота: %s';
$lang['Upload_percent_profile'] = 'Занято: %d%%';

// Common Variables
$lang['Bytes'] = 'Байты';
$lang['KB'] = 'КБ';
$lang['MB'] = 'МБ';
$lang['Attach_search_query'] = 'Поиск приложений';
$lang['Test_settings'] = 'Тест настроек';
$lang['Not_assigned'] = 'Не прикреплено';
$lang['No_file_comment_available'] = 'Комментария к файлу отсутствует';
$lang['Attachbox_limit'] = 'Ваше лимит приложений заполнен на %d%%';
$lang['No_quota_limit'] = 'Нет лимита квоты';
$lang['Unlimited'] = 'Неограниченный';

?>
