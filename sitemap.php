<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">


<?php include_once "_pagenav.php"?>

<br/>
<br/><br/>




<br/><br/>
<h3>Введение:</h3>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/intro.php">Пара слов о базах данных Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/library.php">С чего начать изучение Oracle?</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/links.php">Ссылки на документацию по Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle-dba-questions-on-interview.php">Вопросы, которые задают претендентам на позицию Oracle DBA на собеседованиях</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/job/">Требования к кандидатам на позицию Oracle DBA в иностранных компаниях</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/cert/index.php">Сертификация Oracle</a><br/>

<br/><br/>
<h3>Основы:</h3>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/how_to_install_oracle_database.php">Инсталляция Oracle DataBase</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/startup_and_shutdown.php">Режимы запуска и останова базы данных Oracle</a><br/>


<br/><br/>
<h3>Архитектура баз данных Oracle:</h3>


<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/instance.php">Экземпляр базы данных Oracle (Oracle DataBase Instance)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_files.php">Файлы базы данных Oracle (Oracle DataBase Files)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_memory.php">Структуры памяти Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_proceses.php">Процессы Oracle (Oracle DataBase Proceses)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_transactions.php">Простая транзация базы данных Oracle</a><br/>


<br/><br/>
<h3>Управление табличными пространствами:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_tablespaces.php">Табличные пространства Oracle </a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_tablespaces_creation.php">Создание табличных пространств</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_tablespaces_add.php">Расширение табличных пространств (создание дополнительных файлов для табличных пространств)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_segments_extents_and_blocks.php">Сегменты > Экстенты > Блоки</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_undo_tablespaces.php">Команды для анализа использования UNDOTBS</a><br/>

<br/><br/>
<h3>Индексы:</h3>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_indexes.php">Индексы Oracle </a><br/>

<br/><br/>
<h3>Пользователи, схемы и их сессии к базе данных Oracle:</h3>


<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_schemas.php">Схемы Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_permissions.php">Системные и объектные полномочия пользователей в базе данных Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_sessions.php">Сессии к базе данных Oracle</a><br/>


<br/><br/>
<h3>Oracle Networking:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_networking.php">Конфигурационные файлы listener.ora, tnsnames.ora и утилита LSNRCTL</a><br/>


<br/><br/>
<h3>Резервное копирование баз данных Oracle:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_data_pump.php">Утилиты экспорта и импорта данных Data Pump (Резервное копирование объектов схемы)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_11_transportable_tablespaces.php">Транспортируемые табличные пространства в Oracle 11g</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_backup.php">Резервное копирование баз данных Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_rman.php">Утилита RMAN (Recovery Manager)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_rman_backup.php">Создание резервных копий с помощью утилиты RMAN (Recovery Manager)</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_rman_restore_and_recover.php">Восстановление из резервой копий с помощью утилиты RMAN (Recovery Manager)</a><br/>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_rman_delete.php">Удаление объектов RMAN (Recovery Manager)</a><br/>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/low_space_in_fra.php">Недостаточно свободного места в Fast Recovery Area</a><br/>


<br/><br/>
<h3>Восстановление файлов и данных:</h3>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/flashback_queries.php">FlashBack queries</a><br/>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_file_was_lost.php">Потеря файла</a><br/>






<br/><br/>
<h3>Настройка производительности баз данных Oracle:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_session_statistics.php">Собрать статистику пользовательской сессии</a><br/>


<br/><br/>
<h3>Мониторинг:</h3>
<a href="http://odba.ru/showthread.php?t=744">Инсталляция Oracle Enterprise Manager Cloud control 12c в операционной системе Oracle Linux 5.8 x86 64 bit</a><br/>


<br/><br/>
<h3>Высокая готовность и отказоустойчивость:</h3>
<a href="http://odba.ru/showthread.php?t=469">Oracle Data Guard: Развертывание физического Standby средствами Oracle Database</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/database/rac/11.2/install/">Инсталляция Oracle DataBase Real Application Cluster 11G R2 x86 64 bit в операционной системе Oracle Linux 5.8 x86 64 bit</a><br/>


<br/><br/>
<h3>Разное:</h3>

<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_database_sheduler.php">Sheduler Oracle</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/poisk-dublikatov.php">Поиск одинаковых записей в базе данных</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/oracle_err_catcher.php">Создание ловца ошибок (тестим)</a><br/>


<hr>

<h3>Сервер приложений Oracle Weblogic:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/appserv/weblogic/weblogic_versions.php">Версии Weblogic</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/appserv/weblogic/weblogic_installation.php">Инсталляция сервера приложений Oracle Weblogic в операционной системе Oracle Linux</a><br/>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/appserv/weblogic/weblogic_patches.php">О патчах для Oracle WebLogic Server</a><br/>

<hr>

<h3>Некоторые запросы к базе данных Oracle:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/query.php">Некоторые запросы к базе данных Oracle</a><br/>


<hr>

<h3>Некоторые команды Linux:</h3>
<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/linux/">Некоторые команды Linux</a><br/>


<hr>


<h3>Программирование для баз данных Oracle:</h3>
<ul>
	<li><a href="http://plsql.ru/">Программирование на PL/SQL</a></li>
	<li><a href="http://oracle-adf.org/">Программирование на Java с использованием технологии Oracle ADF</a></li>
</ul>

</div>

</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
