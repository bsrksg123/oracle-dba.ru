<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Утилита RMAN (Recovery Manager)</h2><br/>

<strong>RMAN [Recovery Manager] </strong> - (утилита для резервного копирования и восстановление данных).
<br/><br/>
<strong>FRA [Fast Recovery Area] </strong> - область на диске для резервных копий и архивных журналов.
<br/><br/>
<strong>ARCHIVELOG </strong> - режим работы базы данных, при котором после переключения активной журнальной группы,
копия журнала архивируется и сохраняется на диск. Redo-лог журналы постепенно перезаписываются, а информация которая в них хранилась 
может быть получена из архивлогов.

<br/><br/>

Команда <strong>Restore </strong> выполняет восстановление файлов из бекапа. Данные восстанавливаются 
на момент создания бекапа.

<br/><br/>

Команда <strong>Recover </strong>- примененяет к восстановленной из бекапа базе данных сохраненные архивные журналы,
чтобы база данных была актуальна на какой-то более приемлемый момент времени, нежели чем на момент создания бекапа.

При выполнении неполного восстановления, необходимо открывать базу данных командой: <br/>
ALTER DATABASE OPEN RESETLOGS;


<br/><br/>
<h3>Посмотреть режим работы баз данных ORacle (archivelog | noarchivelog), flashback (on | off)</h3>

<br/>
SQL> select db_unique_name, log_mode, flashback_on from v$database;

<pre>

DB_UNIQUE_NAME                 LOG_MODE     FLASHBACK_ON
------------------------------ ------------ ------------------
ora112                         ARCHIVELOG   YES

</pre>

<br/><br/>
При включении FLASHBACK - возможно, необходимо расширить табличное пространство UNDO не менее, чем до 2GB.
<br/><br/>

<pre>


// Установить предельный размер flash_recovery_area
SQL> alter system set db_recovery_file_dest_size = 60G;

// Изменить расположение flash_recovery_area
SQL> alter system set db_recovery_file_dest='/u03/oracle_backups/fra';

// Влючить archivelog (если выключен)

SQL> shutdown immediate;
SQL> startup mount;
SQL> alter database archivelog;
SQL> shutdown immediate;
SQL> startup;

// Влючить flashback (если выключен)

SQL> shutdown immediate;
SQL> startup mount exclusive;
SQL> alter database flashback on;
SQL> alter database open;


// Основные представления:

select * from v$database; --
select * from v$recovery_file_dest; -- месторасположение FRA.
select * from v$flash_recovery_area_usage; -- использованный объем
select * from v$rman_backup_job_details; -- информация по бекапам
select * from v$rman_backup_subjob_details;
select * from v$rman_configuration; 
select * from v$rman_status;
select * from v$rman_backup_type;



select * from v$rman_configuration;

select * from v$archived_log;

select * from v$backup_corruption;
select * from v$copy_corruption;

select * from v$backup_files;
select * from v$backup_device;
select * from v$backup_set;
select * from v$backup_piece;
select * from v$backup_redolog;
select * from v$backup_spfile;


===================================
В 11 версии.

RMAN> list failure;
RMAN> advise failure;
RMAN> repair failure; 



// Команды для проверки

RMAN> CROSSCHECK backup;
RMAN> CROSSCHECK copy;
RMAN> CROSSCHECK backup of database;
RMAN> CROSSCHECK backup of controlfile;
RMAN> CROSSCHECK archivelog all; 

</pre>





<br/><br/>
<h3>Простой пример создания и восстановление базы данных из резервных копий с помощью утилиты RMAN:</h3>

Для создания резервной копии базы данных Oracle с помощью данной утилиты, 
достаточно подключиться к экземпляру базы данных и выполнить команду backup database:
<br/><br/>

<pre>
$ rman target /
RMAN> BACKUP FULL DATABASE;
</pre>

<br/><br/>
Для восстановление базы данных из бекапа:
<br/><br/>

<pre>
$ rman target /

RMAN> RESTORE DATABASE;
RMAN> RECOVER DATABASE;
</pre>


<br/>
<br/>

Показать устаревшие бэкапы<br/>
RMAN> report obsolete;

<br/><br/>

Показать полный список архивных журналов<br/>
RMAN> list archivelog all;
<br/><br/>

RMAN> report schema;

<br/>
<br/>

<pre>
Report of database schema for database with db_unique_name ORA112

List of Permanent Datafiles
===========================
File Size(MB) Tablespace           RB segs Datafile Name
---- -------- -------------------- ------- ------------------------
1    780      SYSTEM               ***     /u02/oradata/ora112/system01.dbf
2    850      SYSAUX               ***     /u02/oradata/ora112/sysaux01.dbf
3    75       UNDOTBS1             ***     /u02/oradata/ora112/undotbs01.dbf
4    5        USERS                ***     /u02/oradata/ora112/users01.dbf
5    2048     MY_INDEXES           ***     /u02/oradata/ora112/my_indexes01.dbf
6    2048     MY_DATA              ***     /u02/oradata/ora112/my_data01.dbf
7    2048     MY_DATA              ***     /u01/app/oracle/product/11.2/dbs/my_data02.dbf
8    1024     MY_DATA              ***     /u01/app/oracle/product/11.2/dbs/my_data03.dbf
9    1024     MY_DATA2             ***     /u01/app/oracle/product/11.2/dbs/my_data04.dbf
10   1024     MY_DATA              ***     /u01/app/oracle/product/11.2/dbs/my_data05.dbf
11   1024     MY_DATA              ***     /u01/app/oracle/product/11.2/dbs/my_data06.dbf
12   1024     MY_DATA              ***     /u01/app/oracle/product/11.2/dbs/my_data07.dbf
13   1024     MY_DATA              ***     /u01/app/oracle/product/11.2/dbs/my_data08.dbf
14   10       MY_DATA              ***     /u02/oradata/ORA112/datafile/o1_mf_my_data_7oy0k0vr_.dbf

List of Temporary Files
=======================
File Size(MB) Tablespace           Maxsize(MB) Tempfile Name
---- -------- -------------------- ----------- --------------------
1    537      TEMP                 32767       /u02/oradata/ora112/temp01.dbf
2    2048     MY_TEMP              2048        /u02/oradata/ora112/my_temp01.dbf


</pre>



<h3>Параметры RMAN по умолчанию </h3>
<br/><br/>

RMAN> show all;
<br/>
<pre>
RMAN configuration parameters for database with db_unique_name ORA112 are:
CONFIGURE RETENTION POLICY TO REDUNDANCY 1;
CONFIGURE BACKUP OPTIMIZATION OFF; # default
CONFIGURE DEFAULT DEVICE TYPE TO DISK; # default
CONFIGURE CONTROLFILE AUTOBACKUP OFF; # default
CONFIGURE CONTROLFILE AUTOBACKUP FORMAT FOR DEVICE TYPE DISK TO '%F'; # default
CONFIGURE DEVICE TYPE DISK BACKUP TYPE TO COMPRESSED BACKUPSET PARALLELISM 1;
CONFIGURE DATAFILE BACKUP COPIES FOR DEVICE TYPE DISK TO 1; # default
CONFIGURE ARCHIVELOG BACKUP COPIES FOR DEVICE TYPE DISK TO 1; # default
CONFIGURE MAXSETSIZE TO UNLIMITED; # default
CONFIGURE ENCRYPTION FOR DATABASE OFF; # default
CONFIGURE ENCRYPTION ALGORITHM 'AES128'; # default
CONFIGURE COMPRESSION ALGORITHM 'BASIC' AS OF RELEASE 'DEFAULT' OPTIMIZE FOR LOAD TRUE ; # default
CONFIGURE ARCHIVELOG DELETION POLICY TO NONE; # default
CONFIGURE SNAPSHOT CONTROLFILE NAME TO '/u01/app/oracle/product/11.2/dbs/snapcf_ora112.f'; # default


</pre>

<br/><br/>
<strong>Проверка базы с помощью утилиты RMAN:</strong>

<br/><br/>
	RMAN> VALIDATE DATABASE;
<br/><br/>


<h3>Проверка файлов, хранящихся в FRA:</h3>
<br/><br/>
RMAN> VALIDATE RECOVERY AREA;

<br/><br/>
RMAN читает все блоки и проверяет их на поврежденность. <br/>
Если находятся поврежденные блоки, то информация о них попадает в V$DATABASE_BLOCK_CORRUPTION<br/>
RMAN> BACKUP VALIDATE DATABASE;<br/>
RMAN> BACKUP VALIDATE DATABASE ARCHIVELOG ALL;


</div>	



<?php include_once "_footer.php"?>

</body>

</html>


