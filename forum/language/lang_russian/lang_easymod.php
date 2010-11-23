<?php
/***************************************************************************
 *                            lang_easymod.php [Russian]
 *                              -------------------
 *   begin                : Saturday, Apr 9 2005
 *   copyright            : (C) 2005 by [fatum]
 *   email                : d.fat@mail.ru
 *
 *   $Id: lang_easymod.php,v 0.1.13 2005/04/09 00:00:00 nuttzy Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/


//
// EasyMOD
//

// EasyMOD alpha specific" ;
//$lang['EM_SQL_Alpha2'] = '<b>NOTE:</b> SQL processing has been disabled in Alpha 3 and no alterations to your database will actually be preformed.  It will be implemented in Beta 1.  Press "Complete Installation" to continue.' ;

// header
$lang['EM_Title'] = 'EasyMOD - Автоматический установщик модов' ;

// login
$lang['EM_access_warning'] = 'Пароль для доступа к EasyMod.  Злоумышленник может получить доступ к базе данных и FTP без вашего ведома.' ;
$lang['EM_password_title'] = 'Пожалуйста введите пароль для доступа к EasyMod' ;
$lang['EM_password'] = 'Пароль' ;
$lang['EM_access_EM'] = 'Доступ к EasyMod' ;

// history (installed MODs)
$lang['EM_Installed'] = 'Установленные моды' ;
$lang['EM_installed_desc'] = 'Все эти моды были в какой-то момент установлены на вашем форуме.  В более поздних версиях вы будете получать больше деталей или удалять моды отсюда.' ;
$lang['EM_install_date'] = 'Установленный' ;

// settings
$lang['EM_settings_pw'] = 'Пароль к EasyMod позволит вам ограничит других админов. При наличии доступа к EasyMod админ мог получить вам логин/пароль к базе данных и информацию о FTP. Оставьте поле пустым, чтобы не использовать пароль. Оставьте поле пустым, чтобы не изменять пароль.' ;
$lang['EM_read_server'] = 'сервер' ;
$lang['EM_write_server'] = 'сервер' ;
$lang['EM_write_ftp'] = 'буфер и FTP' ;
$lang['EM_write_download'] = 'загрузка' ;
$lang['EM_write_screen'] = 'на экране' ;
$lang['EM_move_copy'] = 'копия' ;
$lang['EM_move_ftp'] = 'автоматический FTP' ;
$lang['EM_move_exec'] = 'исполняющий скрипт' ;
$lang['EM_move_manual'] = 'загрузить в ручную' ;
$lang['EM_settings'] = 'Настройки';
$lang['EM_settings_desc'] = 'Выполните настройку здесь.  <b>Эта страница должна работать</b>  Здесь производится настройка EasyMod.' ;
$lang['EM_settings_update'] = 'Обновить изменения' ;
$lang['EM_settings_success'] = 'Ваши параметры для EasyMOD успешно изменены.' ;
$lang['EM_pass_disabled'] = '(EM отключить пароль)' ;
$lang['EM_pass_updated'] = '(EM обновить пароль)' ;
$lang['EM_pass_not_updated'] = '(EM пароль не обновлен)' ;

// EasyMOD install
$lang['EM_Intro'] = 'EasyMOD быстро установит ваши моды для phpBB, раньше это было утомительным занятием. EasyMOD способен установить любой phpBB мод.  Однако, совместимые с EasyMod моды имеют больше шансов на корректную установку, чем другие.' ;
$lang['EM_none_installed'] = 'Нет модов' ;
$lang['EM_All_Processed'] = 'Все моды были обработаны.' ;
$lang['EM_unprocessed_mods'] = 'Эти моды лежат в вашей папке для модов и ещё не установлены. Клик на "Процесс" начинает пошаговую установку.  Ваши файлы не будут переписаны до последнего шага.  Моды, которые совместимы с EasyMod (EMC) имеют больше шансов на корректную установку, чем другие.  Для получения дополнительной информации кликните <a href="http://www.phpbb.com/phpBB/viewtopic.php?p=689082#689082">тут</a>.' ;
$lang['EM_Unprocessed'] = 'Необработанные моды' ;
$lang['EM_process'] = 'процесс' ;
$lang['EM_support_thread'] = 'поддержка' ;
$lang['EM_EMC'] = 'EMC' ;

// Preview
$lang['EM_preview'] = 'Просмотр' ;
$lang['EM_preview_mode'] = 'Режим просмотра' ;
$lang['EM_preview_desc'] = 'Слейдущие файлы будут переписаны.  Кликните "Просмотр" чтобы рассмотреть изменения.  Изменения, которые EasyMod применит к файлам, отмечены жирным красным цветом.  К сожалению, из-за форматирования HTML, некоторые дополнительные переводы каретки иногда добавляются, но они не будут появляться, когда файл фактически записан.' ;
$lang['EM_preview_filename'] = 'Имя файла' ;
$lang['EM_preview_view'] = 'Просмотр' ;
$lang['EM_preview_nofile'] = 'Этот мод не будет изменять никаких файлов.  Нет файлов для просмотра.' ;

// History + Install
$lang['EM_Mod'] = 'Мод' ;
$lang['EM_File'] = 'Файл' ;
$lang['EM_Version'] = 'Версия' ;
$lang['EM_Author'] = 'Автор' ;
$lang['EM_Description'] = 'Описание' ;
$lang['EM_phpBB_Version'] = 'phpBB версия' ;
$lang['EM_Themes'] = 'Темы' ;
$lang['EM_Languages'] = 'Языки' ;

// process
$lang['EM_proc_step1'] = 'Шаг 1 из 3' ;
$lang['EM_proc_complete'] = 'Обработка закончилась успешно!' ;
$lang['EM_proc_desc'] = 'EasyMOD закончил установку этого мода. Ваши оригинальные файлы остались не измененными. Следующий шаг обновит вашу базу данных и перепишет phpBB файлы.  Ваши файлы автоматически сохранены. Однако, <b>это бета версия, и вам надо делать резервные копии самому!!</b>  Нажмите на кнопку "Слейдущий шаг" для продолжения.' ;
$lang['EM_unprocessed_commands'] = 'Необработанные команды.' ;
$lang['EM_unprocessed_desc'] = 'Следующие команды не были признаны EasyMOD и игнорированы. Линии в скрипте показаны.' ;
$lang['EM_processed_commands'] = 'Обработка команды' ;
$lang['EM_processed_desc'] = 'EasyMOD успешно обработал следующие команды:';
$lang['EM_proc_failed'] = 'Установка не удалась' ;
$lang['EM_proc_failed_desc'] = 'EasyMOD столкнулся со следующей ошибкой(ками).  Общая ошибка в ABC.  Критическая ошибка означает D, и Вы должны сделать XYZ.' ;

// process + post process
$lang['EM_Mod_Data'] = 'Файл мода' ;
$lang['EM_Mod_Title'] = 'Название мода' ;
$lang['EM_Proc_Themes'] = 'В темах' ;
$lang['EM_Proc_Languages'] = 'В языках' ;
$lang['EM_Files'] = 'Редактируемые файлы' ;

// EasyMOD sql
$lang['EM_sql_step2'] = 'Шаг 2 из 3' ;
$lang['EM_SQL_Intro'] = '<b>Изменения в базе данных</b> - DISABLED' ;
$lang['EM_Alterations'] = 'Предложенные изменения в базе данных' ;
$lang['EM_Pseudo'] = 'Псевдо SQL' ;
$lang['EM_Allow'] = 'Позволить' ;
$lang['EM_Perform'] = 'Выполните изменения в базе данных' ;
$lang['EM_complete_install'] = 'Установка завершена' ;

// post process
$lang['EM_pp_step3'] = 'Шаг 3 из 3' ;
$lang['EM_pp_install_comp'] = 'Установка завершена!' ;
$lang['EM_pp_comp_desc'] = 'Установка этого мода завершена.  Вы должны проверить, что мод функционирует должным образом со всеми установленными темами и языками.' ;
$lang['EM_pp_complete'] = 'завершено' ;
$lang['EM_pp_ready'] = 'готовый' ;
$lang['EM_pp_manual'] = 'РУКОВОДСТВО' ;
$lang['EM_pp_from'] = 'Копировать в [%s]' ;
$lang['EM_pp_backups'] = 'Сделать бэкап в [%s]' ;
$lang['EM_pp_backup'] = 'Бэкап' ;
$lang['EM_pp_download'] = 'Загрузка' ;
$lang['EM_pp_to'] = 'К' ;
$lang['EM_pp_status'] = 'Статус' ;

// general use
$lang['EM_next_step'] = 'Следующий шаг' ;


//
// installer
//

// translate this and I'll hardcode the message into easymod_install.php
$lang['EM_no_lang'] = '<b>КРИТИЧЕСКАЯ ОШИБКА:</b> Файл lang_easymod.$phpEx не найден в папке easymod.  EasyMOD не может быть установлен без этого файла' ;


// step 1

$lang['EM_step1'] = '<b>Шаг 1 (из 5):</b> Добро пожаловать в установку EasyMOD.  В этом шаге EasyMod просмотрел сервер, чтобы знать какой доступ файла является доступным для ключевых шагов чтения, записи, и перемещения файлов.  EasyMOD рекомендует параметры настройки лучше всего соответствующей вашей конфигурации.' ;

$lang['EM_Install_Info'] = 'Информация о установке' ;
$lang['EM_Select_Language'] = 'Выберете язык' ;
$lang['EM_Database_type'] = 'Тип базы данных' ;
$lang['EM_phpBB_version'] = 'Версия phpBB' ;
$lang['EM_EasyMOD_version'] = 'Версия EasyMOD' ;
$lang['EM_EM_status'] = 'EM статус' ;
$lang['EM_new_install'] = 'Новая установка' ;
$lang['EM_update_from'] = 'Обновление EM' ;

$lang['EM_File_Access'] = 'Информация о правах доступа' ;
$lang['EM_failed'] = 'битый' ;
$lang['EM_unattempted'] = 'не предпринятый' ;
$lang['EM_no_module'] = 'модуль не загружен' ;
$lang['EM_no_problem'] = 'NOTE: Проблемы нет, если некоторые неудавшиеся пункты не были предприняты.  Все нормально.' ;
$lang['EM_support'] = 'Для поддержки и справки посетите <a href="http://area51.phpbb.com/phpBB22/viewforum.php?f=15" target="_blank">EasyMOD Central</a> в Area51.  Не надо слать электронные письма, ICQ (и др.), или ЛС.' ;

$lang['EM_read_access'] = 'доступ к чтению' ;
$lang['EM_write_access'] = 'доступ к записи' ;
$lang['EM_root_write'] = 'запись в корневую директорию' ;
$lang['EM_chmod_access'] = 'доступ к chmod' ;
$lang['EM_unlink_access'] = 'доступ к unlink' ;
$lang['EM_mkdir_access'] = 'доступ к mkdir' ;
$lang['EM_tmp_write'] = 'запись во временную папку' ;
$lang['EM_ftp_ext'] = 'FTP расширение' ;
$lang['EM_copy_access'] = 'доступ к копированию' ;

$lang['EM_Settings'] = 'Настройки' ;
$lang['EM_password_title'] = 'EasyMOD Защита паролем' ;
$lang['EM_password_desc'] = 'Пароль для EasyMOD позволит вам ограничить админов от EasyMOD.  Злоумышленник может получить доступ к базе данных и FTP без вашего ведома.' ;
$lang['EM_password_set'] = 'Установите пароль для EM' ;
$lang['EM_password_confirm'] = 'Повторите пароль для EM' ;
$lang['EM_file_title'] = 'Доступ к файлом' ;
$lang['EM_file_desc'] = 'FTP доступ - perferred метод для доступа к файлу.  Если вы не имеете доступ к FTP, EasyMOD подготовил дополнительные параметры настройки.' ;
$lang['EM_file_reading'] = 'Чтение' ;
$lang['EM_file_writing'] = 'Запись' ;
$lang['EM_file_moving'] = 'Просмотр' ;
$lang['EM_file_alt'] = 'замена' ;
$lang['EM_ftp_title'] = 'FTP Информация' ;
$lang['EM_ftp_desc'] = 'Если вы имеете доступ к FTP, входите.  Информация будет сохранена в базе данных phpBB.  Это будет доступно через EasyMOD.' ;
$lang['EM_ftp_dir'] = 'FTP директория к phpBB2' ;
$lang['EM_ftp_user'] = 'FTP логин' ;
$lang['EM_ftp_pass'] = 'FTP пароль' ;
$lang['EM_ftp_host'] = 'FTP сервер' ;
$lang['EM_ftp_host_info'] = '(localhost должен быть лучшим вариантом)' ;
$lang['EM_ftp_debug'] = 'FTP Способ отладки' ;
$lang['EM_ftp_debug_not'] = '(используйте, если есть проблема)' ;
$lang['EM_ftp_use_ext'] = 'PHP FTP расширение' ;
$lang['EM_ftp_ext_not'] = '(не понял нифига :()' ;
$lang['EM_ftp_ext_noext'] = 'Не выбирайте.  PHP FTP модуль не загружен.' ;
$lang['EM_ftp_ext_notmp'] = 'Не выбирайте.  Нет доступа на запись к /tmp.' ;
$lang['EM_ftp_cache'] = 'Использовать FTP кэш' ;
$lang['EM_yes'] = 'Да' ;
$lang['EM_no'] = 'Нет' ;

// step 2
$lang['EM_step2'] = '<b>Шаг 2 (из 5):</b> EasyMOD теперь подтвердит ваши параметры для доступа к файлам.' ;
$lang['EM_test_write'] = 'Метод записи (test)' ;
$lang['EM_confirm_write'] = 'Запишите метод доступа.';
$lang['EM_confirm_write_server'] = 'Измененные файлы будут записаны на сервере' ;
$lang['EM_confirm_write_ftp'] = "Измененные файлы будут записаны в буфер, а затем на FTP." ;
$lang['EM_confirm_write_local'] = 'Измененные файлы будут загружены с локальной машины через ваш браузер.' ;
$lang['EM_confirm_write_screen'] = 'Измененное содержание файла будет показано на экране..' ;
$lang['EM_test_move'] = 'Испытание метода передвижения' ;
$lang['EM_test_ftp1'] = '1) Успешно загружен' ;
$lang['EM_test_ftp2'] = '2) От CD к EasyMOD директории' ;
$lang['EM_test_ftp3'] = '3) Запись в корень phpBB' ;
$lang['EM_ftp_sync1'] = 'Вы выбрали FTP для записи файлов, но не для их перемещения.  Вы должны установить FTP на запись и перемещение, иначе вы не сможете использовать FTP.' ;
$lang['EM_ftp_sync2'] = 'Вы выбрали FTP для перемещения файлов, но не для записи.  Вы должны установить FTP на запись и перемещение, иначе вы не сможете использовать FTP.' ;
$lang['EM_confirm_move'] = 'Метод перемещения подтвержден!' ;
$lang['EM_confirm_move_ftp'] = 'Файлы будут автоматически заменены в ядре phpBB через FTP.' ;
$lang['EM_confirm_move_copy'] = 'Файлы будут автоматически заменены в ядре phpBB используя функцию копии.' ;
$lang['EM_confirm_move_exec'] = 'Скрипт сгенерирован так, чтобы вы смогли автоматически заменить ядро phpBB' ;
$lang['EM_confirm_move_ftpm'] = 'Вы выбрали ручную замену измененных файлов в ядро phpBB.' ;
$lang['EM_install_EM'] = 'Установка EasyMOD' ;
$lang['EM_confirm_download'] = '<b>ВАЖНО:</b> Чтобы полностью проверить метод загрузки, убедитесь в том, что вы можете загрузить этот файл.  В противном случае вы не сможете использовать "загрузку", нажмите "перескан" чтобы выбрать другой вариант.' ;

// step 2 ftp test
$lang['EM_ftp_testing'] = 'Тест доступа к FTP...' ;
$lang['EM_ftp_fail_conn'] = 'FTP Ошибка: не удалось подключиться к %s' ;
$lang['EM_ftp_fail_conn_lh'] = "Эта ошибка часто происходит, особенно на таких хостах как Lycos.  Вернитесь на шаг 1 вы должны изменить сервер FTP на 'localhost'." ;
$lang['EM_ftp_fail_conn_invalid'] = "Не удалось подключиться, возможно, вы допустили ошибку в хосте FTP сервера.  Имя хоста не может иметь слеш (/ и \\) и двоеточий (:).  Вернитесь в настройки FTP." ;
$lang['EM_fail_conn_info'] = 'FTP сервер, который вы указали, не подключен.  Наши рекомендации:';
$lang['EM_fail_conn_op1'] = 'Вы ставили дефлопный <b>localhost</b>?  Нужно попробовать сначала.' ;
$lang['EM_fail_conn_op2'] = 'Вы правильно ввели хост?  Проверьте.' ;
$lang['EM_fail_conn_op3'] = 'Вы уверены, что вы имеете доступ к phpBB файлам на FTP?  Очевидно это требование.' ;
$lang['EM_fail_conn_op4'] = "Некоторые серверы имеют проблемы с методом fsockopen, который EasyMod пытался использовать по умолчанию.  Если вы имеете загруженное расширение PHP FTP, то позвольте выбор в шаге 1" ;
$lang['EM_fail_login'] = 'FTP Ошибка: Доступ запрещен.' ;
$lang['EM_fail_login_info'] = 'Подключился к FTP, но логин или пароль не верны.  Следуйте нашим рекомендациям:' ;
$lang['EM_fail_login_op1'] = 'Вы уверены в правильности своего логина или пароля?  Убедитесь что CAPS LOCK выключен и повторите попытку.' ;
$lang['EM_fail_login_op2a'] = 'Если вы на 100% уверены в том, что ваш логин/пароль верен, то возможно вы соеденились не с тем хостом.  Попробуйте изменить ваш вход на FTP от "localhost" до фактического названия FTP хоста.' ;
$lang['EM_fail_login_op2b'] = 'Возможно вы соединились не с тем хостом. Попробуйте изменить вход в FTP обратно на "localhost", или введите хост правильно.' ;
$lang['EM_fail_pwd'] = 'FTP Ошибка: Битый pwd' ;
$lang['EM_fail_pwd_info'] = 'Вы успешно вошли на сервер, но команда PWD подвела.' ;
$lang['EM_fail_cd'] = 'FTP Ошибка: нет cd на %s' ;
$lang['EM_fail_cd_info'] = 'Вы успешно вошли на сервер, но не смогли изменить CD в директории easymod.  Следуйте нашим рекомендациям:' ;
$lang['EM_fail_cd_op1'] = '<b>Важно:</b> Кажется вы включили имя домена в настройке phpBB директории.  Для большинства серверов это не правильно.  Вернитесь и исправьте путь до phpBB без доменного имени (от переводчика: путь не может начинаться с ftp://, правильный пример: /work/WWW/phpBB) .' ;
$lang['EM_fail_cd_op2'] = '<b>Важно:</b> Вы имеете слеш (/) в конце пути до скриптов.  Попробуйте устранить это.' ;
$lang['EM_fail_cd_op3'] = 'Вы уверены, что вы указали правильный путь?  Листинг директории в корневой директории на FTP.  Корневая директория FTP, это просто стартовая точка, вы входите на нее при соединении.  Путь к phpBB2 должен начинаться с одной из директив упомянутых ниже.' ;
$lang['EM_fail_cd_op4'] = 'Названия директорий - чувствительный случай.  Убедитесь что easymod директория у вас в нижнем регистре.' ;
$lang['EM_fail_cd_op5'] = "В некотором случае, возможно, то, что вы не соединяетесь с надлежащим FTP сервером.  Попробуйте определить хост в области FTP сервера." ;
$lang['EM_fail_cd_op6'] = "Некоторые серверы имеют проблемы с пассивным режимом, который EasyMod использует по умолчанию." ;
$lang['EM_fail_cd_pwd'] = 'FTP Ошибка: Директивная информация не могла быть получена.  Это указывает на упомянутое выше решение 4.' ;
$lang['EM_fail_cd_nlist'] = 'FTP Ошибка: Не получен листинг файлов.  Это указывает на упомянутое выше решение 4.' ;
$lang['EM_fail_cd_nlist_no'] = 'Нет файлов для пересчета.' ;
$lang['EM_ftp_root'] = 'FTP корневая директория:' ;
$lang['EM_dir_list'] = 'Листинг директории:</b> Ваш FTP путь должен начинаться с одного из упомянутых ниже директорий.' ;
$lang['EM_fail_pwd'] = 'FTP Ошибка: Не могу сделать PWD' ;
$lang['EM_fail_put'] = 'FTP Ошибка: Не могу выполнить запись в phpBB директорию.' ;
$lang['EM_fail_put_info'] = 'EasyMOD требует чтобы ваш <b>%s</b> имел доступ на запись ко всем директориям и файлам в phpBB директории.  Выставите на все файлы и папке атрибут - 744.' ;
$lang['EM_ftp_phpbb_root'] = 'phpBB корневая директория:' ;
$lang['EM_fail_reput'] = 'FTP Ошибка: не мог переписать тестовый файл в корне phpBB' ;
$lang['EM_fail_delete'] = '<b>FTP ПРЕДУПРЕЖДЕНИЕ:</b> не мог удалить испытательный файл (не смертельно)' ;

// step 3
$lang['EM_step3'] = '<b>Шаг 3 (из 5):</b> EasyMOD теперь установлен. Процесс состоит из 2-х вариантов, создания измененных файлов и затем перемещения их на место.   Измененные файлы никогда не изменяют ядро phpBB до последнего шага.  Кликните на "закончить установку", чтобы переместить файлы на свое место.' ;
$lang['EM_processing_files'] = 'Обработка файлов' ;
$lang['EM_parsing'] = 'Парсинг' ;
$lang['EM_finding'] = 'Поиск' ;
$lang['EM_insert'] = 'Вставить' ;
$lang['EM_ifinding'] = 'Найти на линии' ;
$lang['EM_iafter'] = 'На линии, после добавить' ;
$lang['EM_before'] = 'перед' ;
$lang['EM_after'] = 'после' ;
$lang['EM_build_post'] = 'Обработка действий' ;
$lang['EM_build_post_desc'] = 'Следующие действия будут выполнены в заключительном шаге.' ;
$lang['EM_complete_processing'] = 'Полная обработка' ;

// step 4
$lang['EM_step4'] = '<b>Шаг 4 (из 5):</b> В зависимости от вашего выбора, измененные файлы были автоматически перемещены на свое место, или подготовились для перемещения их вручную.  Если нет никаких ошибок, щелкните на кнопку "Confirm", чтобы обновить вашу базу данных и закончить инсталляционный процесс.' ;
$lang['EM_add_db'] = 'Добавление таблицы EasyMOD к вашей базе данных.' ;
$lang['EM_exec_sql'] = 'Выполнение SQL' ;
$lang['EM_progress'] = 'Процесс' ;
$lang['EM_done'] = 'Сделать' ;
$lang['EM_result'] = 'Результат' ;
$lang['EM_already_exist'] = 'Таблица создана' ;
$lang['EM_failed_sql'] = 'Некоторые операции не выполнены, утверждения и ошибки смотрите ниже' ;
$lang['EM_no_worry'] = 'Нет повода для беспокойства, продолжайте установку. Если вы не в состоянии закончить установку, обратитесь на форум технической поддержки.' ;
$lang['EM_no_errors'] = 'Нет ошибок' ;
$lang['EM_update_db'] = 'Обновление данных в таблице EasyMod' ;
$lang['EM_store_entries'] = 'Хранение конфига в таблице' ;
$lang['EM_do_worry'] = 'Не мог обновить таблицу.  Установка не может продолжаться.' ;
$lang['EM_complete_post'] = 'Завершение постпроцесса' ;
$lang['EM_completed'] = 'Закончить' ;
$lang['EM_admin_panel'] = 'Теперь вы можете перейти в панель администратора и приступить к установке модов.  Вернуться на <a href="../../../index.php">список форумов</a>.' ;
$lang['EM_confirm'] = 'Confirm' ;
$lang['EM_move_files'] = '<b>ВАЖНО:</b> Перед подтверждением, файлы переместите на место.' ;

// step 5
$lang['EM_step5'] = '<b>Последний шаг:</b> EasyMOD подтверждает, что все файлы были перемещены на свое место.  Если подтверждено, ваша база данных будет обновлена и установка будет завершена!' ;
$lang['EM_confirming_mod'] = 'Подтверждение модификаций' ;
$lang['EM_confirmed'] = 'Подтвержденный!' ;
$lang['EM_confirm_lang'] = 'lang_admin.php, looking for' ;
$lang['EM_confirm_admin'] = 'admin_easymod.php, looking for' ;
$lang['EM_confirm_exist'] = 'подтверждение' ;
$lang['EM_confirm_failed'] = 'Ошибка установки' ;
$lang['EM_confirm_fix'] = 'EM не установлен должным образом, устраните вышеупомянутые ошибки.' ;
$lang['EM_install_completed'] = 'EasyMOD установлен!' ;

// debug info
$lang['EM_debug_header'] = '<b>Информация отладки:</b> Следующая информация сконфигурируема для показа на форуме.' ;
$lang['EM_debug_display'] = 'Информация отладки' ;
$lang['EM_debug_info'] = 'Расширенная информация отладки' ;
$lang['EM_debug_format'] = 'форматированный для форума' ;
$lang['EM_debug_installer'] = 'EM установка' ;
$lang['EM_debug_work_dir'] = 'Рабочая папка' ;
$lang['EM_debug_step'] = 'Шаг установки' ;
$lang['EM_debug_mode'] = 'Режим' ;
$lang['EM_debug_the_error'] = 'Ошибки' ;
$lang['EM_debug_no_error'] = 'Нет ошибок.' ;
$lang['EM_debug_permissions'] = 'Разрешения' ;
$lang['EM_debug_sys_errors'] = 'включенные ошибки системы' ;
$lang['EM_debug_recommend'] = 'Рекомендации' ;
$lang['EM_debug_write'] = 'запись' ;
$lang['EM_debug_move'] = 'перемещение' ;
$lang['EM_debug_ftp_dir'] = 'ftp папка' ;
$lang['EM_debug_ftp_debug'] = 'ftp отладка' ;
$lang['EM_debug_ftp_ext'] = 'ftp расширение' ;
$lang['EM_debug_ftp_notest'] = 'НЕ проверен FTP так-как он не используется.' ;
$lang['EM_debug_selected'] = 'Обработанные параметры настройки' ;
$lang['EM_debug_listing'] = 'CWD листинг (текущая рабочая папка)' ;                // cwd = current working directory
$lang['EM_debug_ftp_test'] = 'Тест доступа к FTP' ;
$lang['EM_debug_success'] = 'успешно' ;

// forms
$lang['Submit'] = 'ОК';
$lang['Rescan'] = 'Рескан';


//
// errors
//
$lang['EM_err_warning'] = 'Предупреждение' ;
$lang['EM_err_error'] = 'Ошибка' ;
$lang['EM_err_critical_error'] = 'Критическая ошибка' ;
$lang['EM_err_secondary'] = 'Вторичная критическая ошибка' ;
$lang['EM_err_cwd'] = 'Текущая рабочая папка' ;
$lang['EM_err_install_dir'] = '<b>Критическая ошибка:</b> EasyMOD не корректно установлен.  Это должно быть перемещено в admin/mods/easymod от корня phpBB<br>' ;
$lang['EM_err_no_subsilver'] = '<b>Критическая ошибка:</b> EasyMOD не может быть установлен.  Тема subSilver не установлена.  Эта тема используется как стандартная тема для модов.  Тема subSilver поставляется в стандартном наборе phpBB, загрузите с <a href="http://www.phpbb.com">www.phpbb.com</a>.' ;
$lang['EM_err_no_english'] = '<b>Критическая ошибка:</b> EasyMOD не может быть установлен.  Не найден английский язык в директории с языками.  Английский язык используется как стандартный язык для модов.  Английский язык поставляется в стандартном наборе phpBB, загрузите с <a href="http://www.phpbb.com">www.phpbb.com</a>.' ;
$lang['EM_err_dupe_install'] = 'Эта версия EM уже установлена.  Завершите, чтобы предотвратить переустановку.' ;
$lang['EM_err_pw_match'] = '<b>Ошибка:</b> Пароль к EasyMOD не совпадает.  Повторите, нажимая кнопку "рескан".' ;
$lang['EM_err_acc_write'] = '<b>ОШИБКА ДОСТУПА:</b> phpBB не имеет разрешения на запись в директорию EasyMod.' ;
$lang['EM_err_acc_mkdir'] = '<b>ОШИБКА ДОСТУПА:</b> phpBB не имеет разрешения создать новые папки.' ;
$lang['EM_err_copy'] = '<b>ОШИБКА КОПИРОВАНИЯ:</b> Вы не имеете доступа к копии.  Метод перемещения не используется.' ;
$lang['EM_err_no_write'] = '<b>ОШИБКА ПЕРЕМЕЩЕНИЯ:</b> Метод записи, который вы выбрали, не создает файлы на сервере.  Поэтому, использование FTP или метод копирования не разрешен для метода перемещения.' ;
$lang['EM_err_config_table'] = 'Не могу получить содержание таблицы' ;
$lang['EM_err_open_pp'] = '<b>Критическая ошибка:</b> Не могу открыть файл для записи письма.' ;
$lang['EM_err_attempt_remainder'] = 'ОСТАТОК ATTEMPING ОТ ПОЧТОВОГО ПРОЦЕССА' ;
$lang['EM_err_write_pp'] = '<b>Критическая ошибка:</b> Не могу записать письмо.' ;
$lang['EM_err_no_step'] = '<b>Критическая ошибка:</b>  Вернитесь к установке.' ;
$lang['EM_err_insert'] = 'Не могу вставить %s в конфиг.' ;
$lang['EM_err_update'] = 'Не могу обновить %s в конфиге.' ;
$lang['EM_err_find'] = 'Не могу найти' ;
$lang['EM_err_pw_fail'] = 'НЕ ДЕЙСТВИТЕЛЬНЫЙ ПАРОЛЬ' ;
$lang['EM_err_find_fail'] = 'ОШИБКА ПОИСКА: На линии [%s] не могу найти' ;
$lang['EM_err_ifind_fail'] = 'ОШИБКА ПОИСКА НА ЛИНИИ: В файле [%s] не могу найти' ;

// admin_easymod errors
$lang['EM_trace'] = 'Функции Trace' ;
$lang['EM_FAQ'] = 'ЧаВо' ;
$lang['EM_report'] = 'Рапорт' ;
$lang['EM_error_detail'] = 'Детали ошибки' ;
$lang['EM_line_num'] = 'Скрипт мода, линия #' ;
$lang['EM_err_config_info'] = 'Не могу получить информацию с конфига' ;
$lang['EM_err_no_process_file'] = 'Критическая ошибка: Есть неопределенный параметр для обработки.' ;
$lang['EM_err_set_pw'] = 'Пароль к EasyMOD не совпадает.  Настройки не обновлены.' ;
$lang['EM_err_em_info'] = 'Не могу получить информацию о EasyMod' ;
$lang['EM_err_phpbb_ver'] = 'Не могу получить информацию о версии PHP' ;
$lang['EM_err_backup_open'] = 'Не могу открыть [%s] для чтения.' ;
$lang['EM_err_no_find'] = 'БИТЫЙ: уродливый скрипт [Чё? :))].  Поиск не был предварительно выполнен.' ;
$lang['EM_err_comm_open'] = 'OPEN FAILED: Нет названия файла поставляемое в скрипте мода.' ;
$lang['EM_err_comm_find'] = 'FIND FAILED: Не найдена команда в скрипте мода.' ;
$lang['EM_err_inline_body'] = 'БИТЫЙ: Не действительное содержимое команды постовляемой с скрипте мода.' ;
$lang['EM_err_no_ifind'] = 'БИТЫЙ: Уродливый скрипт - :).  Поиск на линии не был предварительно выполнен.' ;
$lang['EM_err_comm_copy'] = 'COPY FAILED: Целевой файл, который будет скопирован [%s%s] не найден.' ;
$lang['EM_err_modify'] = 'КРИТИЧЕСКАЯ ОШИБКА: Не могу изменить [%s]' ;
$lang['EM_err_theme_info'] = 'В базе данных нет информации о теме' ;
$lang['EM_err_copy_format'] = 'Не могу выполнить ненадлежащим образом сформированную команду COPY.' ;

// mod_io errors
$lang['EM_modio_mkdir_chdir'] = 'FTP ОШИБКА: не могу изменить директорию на [%s]<br>Текущая директория: [%s]' ;
$lang['EM_modio_mkdir_mkdir'] = 'FTP ОШИБКА: не могу создать директорию [%s]<br>Текущая директория: [%s]' ;
$lang['EM_modio_open_read'] = 'Не могу открыть [%s] для чтения.' ;
$lang['EM_modio_open_write'] = 'Не могу открыть [%s] для записи.' ;
$lang['EM_modio_open_none'] = 'Не признанный метод записи.' ;
$lang['EM_modio_close_chdir'] = 'FTP ОШИБКА: не могу изменить директорию на [%s]' ;
$lang['EM_modio_close_ftp'] = 'FTP ОШИБКА: не могу записать файл [%s]' ;
$lang['EM_modio_prep_conn'] = 'FTP ОШИБКА: не могу подключиться к localhost' ;
$lang['EM_modio_prep_login'] = 'FTP ОШИБКА: битый логин' ;
$lang['EM_modio_prep_chdir'] = 'FTP ошибка: не могу внедрить директорию в phpBB' ;
$lang['EM_modio_move_copy'] = 'ОШИБКА КОПИРОВАНИЯ: не могу переместить файл [%s] в [%s]' ;
$lang['EM_modio_move_ftpa'] = 'FTP ОШИБКА: не могу переместить файл [%s] в [%s]' ;

?>
