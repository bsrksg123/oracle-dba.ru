<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Восстановление из резервой копий с помощью утилиты RMAN (Recovery Manager)</h2><br/>

<h3>Получить информацию об имеющихся бекапах.</h3>
<br/>
<br/>

<pre>
set pagesize 200;

SELECT start_time, end_time, status 
FROM v$rman_backup_job_details order by 1 desc;
</pre>

<br/>
<br/>


<h3>Получить список файлов, необходимых для восстановления из бекапа.</h3>
<br/>
<br/>
RMAN> RESTORE DATABASE PREVIEW SUMMARY;
<br/><br/>

<pre>

Starting restore at 13.04.2012 18:48:51
using channel ORA_DISK_1


List of Backups
===============
Key     TY LV S Device Type Completion Time     #Pieces #Copies Compressed Tag
------- -- -- - ----------- ------------------- ------- ------- ---------- ---
214     B  F  A DISK        13.04.2012 18:46:40 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
213     B  F  A DISK        13.04.2012 18:45:57 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
210     B  F  A DISK        13.04.2012 18:45:21 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
211     B  F  A DISK        13.04.2012 18:45:23 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
212     B  F  A DISK        13.04.2012 18:45:24 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE

List of Archived Log Copies for database with db_unique_name ORA112
=====================================================================

Key     Thrd Seq     S Low Time
------- ---- ------- - -------------------
295     1    242     A 13.04.2012 18:45:06
        Name: /u02/oradata/ora112/archivelogs/1_242_0767676036.arc

Media recovery start SCN is 8639788
Recovery must be done beyond SCN 8639822 to clear datafile fuzziness
Finished restore at 13.04.2012 18:48:51

</pre>

<br/><br/>
Команда:<br/>
RESTORE DATABASE PREVIEW - представляет детальный отчет обо всех резервных копиях, которые потребуются для успешного выолпнения команды RESTORE.
<br/><br/>

RMAN> RESTORE DATABASE PREVIEW;<br/>
<br/><br/>

<pre>

Starting restore at 13.04.2012 18:51:29
using channel ORA_DISK_1


List of Backup Sets
===================


BS Key  Type LV Size       Device Type Elapsed Time Completion Time
------- ---- -- ---------- ----------- ------------ -------------------
214     Full    191.88M    DISK        00:00:40     13.04.2012 18:46:40
        BP Key: 226   Status: AVAILABLE  Compressed: YES  Tag: FULL_DATABASE_BEFORE_UPGRADE
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_13/o1_mf_nnndf_FULL_DATABASE_BEFORE_7rjh18jk_.bkp
  List of Datafiles in backup set 214
  File LV Type Ckp SCN    Ckp Time            Name
  ---- -- ---- ---------- ------------------- ----
  1       Full 8639822    13.04.2012 18:46:00 /u02/oradata/ora112/system01.dbf
  9       Full 8639822    13.04.2012 18:46:00 /u01/app/oracle/product/11.2/dbs/my_data04.dbf

BS Key  Type LV Size       Device Type Elapsed Time Completion Time
------- ---- -- ---------- ----------- ------------ -------------------
213     Full    121.24M    DISK        00:00:32     13.04.2012 18:45:57
        BP Key: 225   Status: AVAILABLE  Compressed: YES  Tag: FULL_DATABASE_BEFORE_UPGRADE
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_13/o1_mf_nnndf_FULL_DATABASE_BEFORE_7rjh059r_.bkp
  List of Datafiles in backup set 213
  File LV Type Ckp SCN    Ckp Time            Name
  ---- -- ---- ---------- ------------------- ----
  2       Full 8639802    13.04.2012 18:45:25 /u02/oradata/ora112/sysaux01.dbf
  3       Full 8639802    13.04.2012 18:45:25 /u02/oradata/ora112/undotbs01.dbf
  4       Full 8639802    13.04.2012 18:45:25 /u02/oradata/ora112/users01.dbf
  8       Full 8639802    13.04.2012 18:45:25 /u01/app/oracle/product/11.2/dbs/my_data03.dbf
  14      Full 8639802    13.04.2012 18:45:25 /u02/oradata/ORA112/datafile/o1_mf_my_data_7oy0k0vr_.dbf

BS Key  Type LV Size       Device Type Elapsed Time Completion Time
------- ---- -- ---------- ----------- ------------ -------------------
210     Full    1.02M      DISK        00:00:00     13.04.2012 18:45:21
        BP Key: 222   Status: AVAILABLE  Compressed: YES  Tag: FULL_DATABASE_BEFORE_UPGRADE
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_13/o1_mf_nnndf_FULL_DATABASE_BEFORE_7rjh01to_.bkp
  List of Datafiles in backup set 210
  File LV Type Ckp SCN    Ckp Time            Name
  ---- -- ---- ---------- ------------------- ----
  5       Full 8639798    13.04.2012 18:45:21 /u02/oradata/ora112/my_indexes01.dbf
  7       Full 8639798    13.04.2012 18:45:21 /u01/app/oracle/product/11.2/dbs/my_data02.dbf

BS Key  Type LV Size       Device Type Elapsed Time Completion Time
------- ---- -- ---------- ----------- ------------ -------------------
211     Full    1.28M      DISK        00:00:01     13.04.2012 18:45:23
        BP Key: 223   Status: AVAILABLE  Compressed: YES  Tag: FULL_DATABASE_BEFORE_UPGRADE
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_13/o1_mf_nnndf_FULL_DATABASE_BEFORE_7rjh02yy_.bkp
  List of Datafiles in backup set 211
  File LV Type Ckp SCN    Ckp Time            Name
  ---- -- ---- ---------- ------------------- ----
  6       Full 8639799    13.04.2012 18:45:22 /u02/oradata/ora112/my_data01.dbf
  12      Full 8639799    13.04.2012 18:45:22 /u01/app/oracle/product/11.2/dbs/my_data07.dbf
  13      Full 8639799    13.04.2012 18:45:22 /u01/app/oracle/product/11.2/dbs/my_data08.dbf

BS Key  Type LV Size       Device Type Elapsed Time Completion Time
------- ---- -- ---------- ----------- ------------ -------------------
212     Full    1.02M      DISK        00:00:00     13.04.2012 18:45:24
        BP Key: 224   Status: AVAILABLE  Compressed: YES  Tag: FULL_DATABASE_BEFORE_UPGRADE
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_13/o1_mf_nnndf_FULL_DATABASE_BEFORE_7rjh044h_.bkp
  List of Datafiles in backup set 212
  File LV Type Ckp SCN    Ckp Time            Name
  ---- -- ---- ---------- ------------------- ----
  10      Full 8639800    13.04.2012 18:45:24 /u01/app/oracle/product/11.2/dbs/my_data05.dbf
  11      Full 8639800    13.04.2012 18:45:24 /u01/app/oracle/product/11.2/dbs/my_data06.dbf

List of Archived Log Copies for database with db_unique_name ORA112
=====================================================================

Key     Thrd Seq     S Low Time
------- ---- ------- - -------------------
295     1    242     A 13.04.2012 18:45:06
        Name: /u02/oradata/ora112/archivelogs/1_242_0767676036.arc

Media recovery start SCN is 8639788
Recovery must be done beyond SCN 8639822 to clear datafile fuzziness
Finished restore at 13.04.2012 18:51:29


</pre>


<br/><br/>

<strong>Применение команды RESTORE..VALIDATE</strong>
<br/><br/>
Утилита RMAN проверит, сможет ли она восстановить данные из бекапа.<br/>
Реального восстановления при этом не происходит. 

<br/><br/>

RMAN> RESTORE DATABASE VALIDATE;<br/>
RMAN> RESTORE DATABASE VALIDATE CHECK LOGICAL;


<br/><br/>
<h3>Полное восстановление</h3>


RMAN>restore database;<br/>
RMAN>recover database;
<br/><br/>

<br/>
Восстановление только табличного пространства system на время последнего бекапа<br/>
RMAN> run{restore tablespace system; recover database;}


<br/><br/>
<h3>Неполное восстановление из последнего бекапа на 15 минут назад</h3>

<pre>

RMAN> run{
shutdown immediate;
startup mount;
set until time "sysdate-15/(24*60)"; 
-- set until time "to_date('2010-06-01 12:50:30', 'yyyy-mm-dd hh24:mi:ss')"; 
restore database; 
recover database;
alter database open resetlogs;}
</pre>

При выполнении resetlogs, меняется инкарнация базы данных.


<pre>


// Восстановливать до того места, где возникает ошибка (например, отстутсвует архивный журнал или он испорчен).
recover database until cancel;

</pre>


<h3>Получить список инкарнаций.</h3>

RMAN> list incarnation of database;

<br/>
<br/>


<pre>
List of Database Incarnations
DB Key  Inc Key DB Name  DB ID            STATUS  Reset SCN  Reset Time
------- ------- -------- ---------------- --- ---------- ----------
1       1       ORA112   289829761        PARENT  1          17.09.2011 09:46:04
2       2       ORA112   289829761        CURRENT 995548     20.11.2011 03:20:36
</pre>



<!--





<br/><br/>
<strong>Проверка бекапа с помощью утилиты RMAN:</strong>

<br/>
<br/>
RMAN> list backupset;<br/>
RMAN> list backupset tag "FULL_DATABASE_PLUS_ARCHIVELOG";

<br/><br/>
	RMAN> validate backupset 82;	
<br/><br/>

<br/><br/>






<br/>








<br/>

<br/>
<br/>

<strong>Удаление бекапов</strong>

DELETE EXPIRED BACKUP;<br/>
DELETE BACKUP TAG='before_upgrade';<br/>
DELETE BACKUP;



<br/>
<br/>




Всякий раз, когда применяется команда OPEN RESETLOGS, происходит изменение инкарнации базы данных и
начинает действие новая инкарнация.

<br/>
<br/>













$ rman target / catalog rman/rman@rcat
 
a) RMAN> list incarnation;
b) RMAN> reset database to incarnation 4;
c) RMAN> startup force nomount;
d) RMAN> run {
e) RMAN> set until time "to_date('2010-10-05:12:00:00','YYYY-MM-DD:HH24:MI:SS')";
f) RMAN> restore controlfile;
g) RMAN> alter database mount;
h) RMAN> restore database;
i) RMAN> recover database;
j) RMAN> alter database open resetlogs;
-->

</div>	



<?php include_once "_footer.php"?>

</body>

</html>


