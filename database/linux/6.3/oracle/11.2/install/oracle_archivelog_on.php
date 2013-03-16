<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Включить режим работы ARCHIVELOG</h2>

<br/><br/>

<pre>

При работе в ARCHIVELOG, после переключения redo-log журналов, копия журнала архивируется и сохраняется на диске. Это позволяет при необходимости откатить базу данных на определенный момент в прошлом (например на конкретное время). При работе в ARCHIVELOG, появляется возможность создавать резервные копии базы данных не останавливая базу данных (горячий бекап). При данном режиме работы, необходимо выделять дополнительные ресурсы сервера, т.е. отнимать ресурсы у других процессов. По умолчанию данная опция отключена.


$ sqlplus / as sysdba

Узнать режим работы базы данных:
SQL> select log_mode from v$database;

LOG_MODE
------------
NOARCHIVELOG


Влючить archivelog (если выключен)

SQL> shutdown immediate;
SQL> startup mount exclusive;
SQL> alter database archivelog;
SQL> alter database open;

SQL> select log_mode from v$database;

LOG_MODE
------------------------------------
ARCHIVELOG


Получить дополнительную информацию можно следующей командой:
SQL> ARCHIVE LOG LIST
Database log mode              Archive Mode
Automatic archival             Enabled
Archive destination            USE_DB_RECOVERY_FILE_DEST
Oldest online log sequence     30
Next log sequence to archive   32
Current log sequence           32


SQL> quit



</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
