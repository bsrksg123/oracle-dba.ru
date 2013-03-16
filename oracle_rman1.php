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
<strong>ARCHIVELOG </strong> - режим работы базы данных, при котором redo-log журналы не перезаписываются, а создаются их резервные копии - 
архивные  журналы повторного выполнения.

<br/><br/>

Команда <strong>Restore </strong> выполняет восстановление файлов из бекапа. Данные восстанавливаются 
на момент создания бекапа.

<br/><br/>

Команда <strong>Recover </strong>- примененяет к восстановленной из бекапа базе данных сохраненные архивные журналы,
чтобы база данных была актуальна на какой-то более приемлемый момент времени, нежели чем на момент создания бекапа.

При выполнении неполного восстановления, необходимо открывать базу данных командой: <br/>
ALTER DATABASE OPEN RESETLOGS;
<br/> При этом 

<br/><br/>
<h3>Бекапы могут храниться как backup set (по умолчанию) и image copies:</h3>

<ul>
<li>backup set  - данные хранятся в формате понятном только для RMAN.  В Backup set состоит из  Backup piece, каждый из которых может представлять из себя копию файла данных или копию управляющего файла, или копию архивлогов. </li>
<li>image copies - отличаются от копий, создаваемых, например с помощью команды cp, лишь тем, что информация о них заносится в управляющий файл или каталог восстановления.</li>
</ul>

<br/><br/>
Команда:<br/>
RMAN> BACKUP AS BACKUPSET DATABASE;<br/>
Создаст резернвую копию как backup set

<br/><br/>

Команда:<br/>
RMAN> BACKUP AS COPY DATABASE;<br/>
Создаст резернвую копию как image copies

<br/><br/>

Команда:<br/>
RMAN> LIST BACKUP<br/>
Предоставит информацию о имеющихся backup set

<br/><br/>

Команда:<br/>
RMAN> LIST COPY<br/>
Предоставит информацию о имеющихся image copies


<br/><br/>
<h3>Бекапы могут иметь статус:</h3>

<ul>
	<li>EXPIRED (Истекшие) - RMAN маркирует бекапы и копии данных как expired в случае, если при запуске CROSSCHECK (проверка бекапов) будут найдены ссылки на отсутсвующие или недоступные файлы.</li>
	<li>OBSOLETE (Устаревшие) - резервная копия считается устаревшей, если она уже больше не требуется для восстановления базы данных согласно используемой политике сохранности (retention policy).</li>
</ul>


<br/><br/>
<h3>Создание резервных копий с помощью утилиты RMAN:</h3>

Для создания резервной копии базы данных Oracle с помощью данной утилиты, 
достаточно подключиться к экземпляру базы данных и выполнить команду backup database:
<br/><br/>

<pre>
$ rman target /
RMAN> BACKUP FULL DATABASE;
</pre>

<br/><br/>
Для восстановление базы из бекапа:
<br/><br/>

<pre>
$ rman target /

RMAN> RESTORE DATABASE;
RMAN> RECOVER DATABASE;
</pre>


<br/><br/>
<h3>Создать backup, явно указав расположение backup:</h3>

RMAN> BACKUP AS BACKUPSET DATABASE FORMAT '/tmp/%U';<br/>
RMAN> BACKUP AS COPY DATABASE FORMAT '/tmp/%U';



<br/><br/>
<h3>Создать резервную копию архивных журналов:</h3>
Архивлоги можно как влкючать в backup так и не включать.
<br/>
Можно выполнить отдельно резервное копирование архивлогов.
<br/>
RMAN> BACKUP ARCHIVELOG ALL TAG "ARCHIVELOG_BACKUP";

<br/><br/>

TAG "ARCHIVELOG_BACKUP" - определяет имя для создаваетого бекапа архивлогов как  "ARCHIVELOG_BACKUP".
<br/>
Если ввести команду: <br/>
RMAN> LIST BACKUPSET TAG "ARCHIVELOG_BACKUP";
<br/>
Можно быстро найти бекап по имени.
<br/>
<br/>

<pre>
List of Backup Sets
===================


BS Key  Size       Device Type Elapsed Time Completion Time
------- ---------- ----------- ------------ -------------------
217     162.37M    DISK        00:00:36     16.04.2012 12:57:41
        BP Key: 229   Status: AVAILABLE  Compressed: YES  Tag: ARCHIVELOG_BACKUP
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_16/o1_mf_annnn_ARCHIVELOG_BACKUP_7rqqq1tl_.bkp

  List of Archived Logs in backup set 217
  Thrd Seq     Low SCN    Low Time            Next SCN   Next Time
  ---- ------- ---------- ------------------- ---------- ---------
  1    216     8545527    11.04.2012 22:01:01 8593981    12.04.2012 20:22:54
  1    217     8593981    12.04.2012 20:22:54 8613050    13.04.2012 04:23:11
  1    218     8613050    13.04.2012 04:23:11 8625132    13.04.2012 11:18:51
  1    219     8625132    13.04.2012 11:18:51 8625196    13.04.2012 11:21:03
  1    220     8625196    13.04.2012 11:21:03 8631647    13.04.2012 14:55:06
  1    221     8631647    13.04.2012 14:55:06 8631674    13.04.2012 14:55:21
  1    222     8631674    13.04.2012 14:55:21 8631745    13.04.2012 14:57:29
  1    223     8631745    13.04.2012 14:57:29 8631799    13.04.2012 14:59:10
  1    224     8631799    13.04.2012 14:59:10 8631966    13.04.2012 15:00:39
  1    225     8631966    13.04.2012 15:00:39 8632827    13.04.2012 15:21:02
  1    226     8632827    13.04.2012 15:21:02 8632880    13.04.2012 15:22:44
  1    227     8632880    13.04.2012 15:22:44 8635557    13.04.2012 16:47:23
  1    228     8635557    13.04.2012 16:47:23 8635605    13.04.2012 16:49:04
  1    229     8635605    13.04.2012 16:49:04 8637304    13.04.2012 17:31:20
  1    230     8637304    13.04.2012 17:31:20 8637363    13.04.2012 17:33:02
  1    231     8637363    13.04.2012 17:33:02 8638314    13.04.2012 18:01:14
  1    232     8638314    13.04.2012 18:01:14 8638384    13.04.2012 18:03:06
  1    233     8638384    13.04.2012 18:03:06 8638470    13.04.2012 18:05:15
  1    234     8638470    13.04.2012 18:05:15 8638540    13.04.2012 18:06:57
  1    235     8638540    13.04.2012 18:06:57 8639146    13.04.2012 18:27:51
  1    236     8639146    13.04.2012 18:27:51 8639204    13.04.2012 18:29:33
  1    237     8639204    13.04.2012 18:29:33 8639566    13.04.2012 18:39:55
  1    238     8639566    13.04.2012 18:39:55 8639637    13.04.2012 18:41:36
  1    239     8639637    13.04.2012 18:41:36 8639730    13.04.2012 18:43:30
  1    240     8639730    13.04.2012 18:43:30 8639757    13.04.2012 18:44:14
  1    241     8639757    13.04.2012 18:44:14 8639788    13.04.2012 18:45:06
  1    242     8639788    13.04.2012 18:45:06 8639850    13.04.2012 18:46:47
  1    243     8639850    13.04.2012 18:46:47 8661907    14.04.2012 04:24:15
  1    244     8661907    14.04.2012 04:24:15 8710176    15.04.2012 04:25:00
  1    245     8710176    15.04.2012 04:25:00 8734000    15.04.2012 14:01:51
  1    246     8734000    15.04.2012 14:01:51 8771516    16.04.2012 10:10:40
  1    247     8771516    16.04.2012 10:10:40 8776238    16.04.2012 12:57:02

</pre>

<br/><br/>
<h3>Создать копию текущего CONTROLFILE</h3>

RMAN> BACKUP CURRENT CONTROLFILE TAG "CONTROLFILE";

<br/><br/>
<h3>Создать копию SPFILE</h3>

RMAN> BACKUP SPFILE TAG "SPFILE";



<h3>Создание полного бекапа:</h3>

Полный бекап (FULL BACKUP) - включает все файлы данных, управляющий файл (control file) и файл серверных параметров (sp file).
<br/>
<br/>
RMAN> BACKUP FULL DATABASE TAG "FULL_DATABASE_BACKUP" PLUS ARCHIVELOG TAG "FULL_ARCHIVELOGS_BACKUP";
<br/><br/>
RMAN> LIST BACKUP SUMMARY;
<br/><br/>
<pre>

List of Backups
===============
Key     TY LV S Device Type Completion Time     #Pieces #Copies Compressed Tag
------- -- -- - ----------- ------------------- ------- ------- ---------- ---
200     B  A  A DISK        13.04.2012 18:40:03 1       1       YES        FULL_ARCHIVELOGS_BACKUP
201     B  F  A DISK        13.04.2012 18:40:10 1       1       YES        FULL_DATABASE_BACKUP
202     B  F  A DISK        13.04.2012 18:40:12 1       1       YES        FULL_DATABASE_BACKUP
203     B  F  A DISK        13.04.2012 18:40:13 1       1       YES        FULL_DATABASE_BACKUP
204     B  F  A DISK        13.04.2012 18:40:46 1       1       YES        FULL_DATABASE_BACKUP
205     B  F  A DISK        13.04.2012 18:41:28 1       1       YES        FULL_DATABASE_BACKUP
206     B  F  A DISK        13.04.2012 18:41:35 1       1       YES        FULL_DATABASE_BACKUP
207     B  A  A DISK        13.04.2012 18:41:37 1       1       YES        FULL_ARCHIVELOGS_BACKUP

</pre>

<br/><br/>

Key - Уникальный ключ идентификации. <br/>
TY - Тип бекапа: backup set (B) или copy (P).<br/>
LV - F - file; A - Archivelogs.<br/>
S - Статус бекапа: A (available), U (unavailable), or X (all backup pieces in set expired). Refer to the CHANGE, CROSSCHECK, and DELETE commands for an explanation of each status.

<br/><br/>
<br/><br/>

RMAN> BACKUP FULL DATABASE TAG "FULL_DATABASE_BEFORE_UPGRADE" PLUS ARCHIVELOG TAG "FULL_ARCHIVELOGS_BEFORE_UPGRADE";

<br/><br/>

RMAN> LIST BACKUP SUMMARY;

<br/><br/>

<pre>

List of Backups
===============
Key     TY LV S Device Type Completion Time     #Pieces #Copies Compressed Tag
------- -- -- - ----------- ------------------- ------- ------- ---------- ---
200     B  A  A DISK        13.04.2012 18:40:03 1       1       YES        FULL_ARCHIVELOGS_BACKUP
201     B  F  A DISK        13.04.2012 18:40:10 1       1       YES        FULL_DATABASE_BACKUP
202     B  F  A DISK        13.04.2012 18:40:12 1       1       YES        FULL_DATABASE_BACKUP
203     B  F  A DISK        13.04.2012 18:40:13 1       1       YES        FULL_DATABASE_BACKUP
204     B  F  A DISK        13.04.2012 18:40:46 1       1       YES        FULL_DATABASE_BACKUP
205     B  F  A DISK        13.04.2012 18:41:28 1       1       YES        FULL_DATABASE_BACKUP
206     B  F  A DISK        13.04.2012 18:41:35 1       1       YES        FULL_DATABASE_BACKUP
207     B  A  A DISK        13.04.2012 18:41:37 1       1       YES        FULL_ARCHIVELOGS_BACKUP
208     B  A  A DISK        13.04.2012 18:44:23 1       1       YES        FULL_ARCHIVELOGS_BEFORE_UPGRADE
209     B  A  A DISK        13.04.2012 18:45:14 1       1       YES        FULL_ARCHIVELOGS_BEFORE_UPGRADE
210     B  F  A DISK        13.04.2012 18:45:21 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
211     B  F  A DISK        13.04.2012 18:45:23 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
212     B  F  A DISK        13.04.2012 18:45:24 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
213     B  F  A DISK        13.04.2012 18:45:57 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
214     B  F  A DISK        13.04.2012 18:46:40 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
215     B  F  A DISK        13.04.2012 18:46:46 1       1       YES        FULL_DATABASE_BEFORE_UPGRADE
216     B  A  A DISK        13.04.2012 18:46:48 1       1       YES        FULL_ARCHIVELOGS_BEFORE_UPGRADE

</pre>

<br/><br/>

Получить информацю о созданном бекапе.
<br/><br/>
RMAN> LIST BACKUP TAG "FULL_DATABASE_BEFORE_UPGRADE";
<pre>  

List of Backup Sets
===================


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
215     Full    1.09M      DISK        00:00:01     13.04.2012 18:46:46
        BP Key: 227   Status: AVAILABLE  Compressed: YES  Tag: FULL_DATABASE_BEFORE_UPGRADE
        Piece Name: /u03/oracle_backups/fra/ORA112/backupset/2012_04_13/o1_mf_ncsnf_FULL_DATABASE_BEFORE_7rjh2ppm_.bkp
  SPFILE Included: Modification time: 12.04.2012 20:22:52
  SPFILE db_unique_name: ORA112
  Control File Included: Ckp SCN: 8639845      Ckp time: 13.04.2012 18:46:45

</pre>  
  

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




<!--







<br/><br/>
<strong>Создание сразу нескольких копий:</strong><br/>
RMAN> BACKUP AS BACKUPSET COPIES 2 DATABASE FORMAT '/tmp/1/%U' , '/tmp/2/%U';
<br/><br/>


<br/><br/>
<strong>Проверка базы с помощью утилиты RMAN:</strong>

<br/><br/>
	RMAN> validate database;	
<br/><br/>

Проверка файлов, хранящихся в FRA:
<br/><br/>
RMAN> validate recovery area;

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


