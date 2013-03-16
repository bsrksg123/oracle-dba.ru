<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Контрольный backup (горячий backup)</h2>

<br/><br/>

<pre>

$ cd /u03/orabackups

$ vi rmanscript.rman
RUN {
CONFIGURE DEVICE TYPE DISK BACKUP TYPE TO COMPRESSED BACKUPSET;
BACKUP FULL DATABASE TAG "FULL_DATABASE" PLUS ARCHIVELOG TAG "FULL_DATABASE_ARCHIVELOGS";
}


Проверка синтаксиса созданного файла сценария
$ rman CHECKSYNTAX @rmanscript.rman

Выполнение скрипта резервного копирования
$ rman target / @rmanscript.rman


Посмотреть список бекапов:

RMAN> rman target /

RMAN> list backup of database summary;


List of Backups
===============
Key     TY LV S Device Type Completion Time     #Pieces #Copies Compressed Tag
------- -- -- - ----------- ------------------- ------- ------- ---------- ---
1       B  F  A DISK        10.06.2012 22:05:45 1       1       NO         TAG20120610T220429
6       B  F  A DISK        10.06.2012 22:12:46 1       1       NO         TAG20120610T221132
10      B  F  A DISK        10.06.2012 23:21:10 1       1       YES        FULL_DATABASE



Следующей командой я сообщаю, что все бекапы кроме последного, следует поменить как obsolete.

RMAN> CONFIGURE RETENTION POLICY TO REDUNDANCY 1;

Теперь прошу RMAN удалить устаревшие бекапы (без подтверждения).

RMAN> delete noprompt obsolete;

RMAN> list backup of database summary;


List of Backups
===============
Key     TY LV S Device Type Completion Time     #Pieces #Copies Compressed Tag
------- -- -- - ----------- ------------------- ------- ------- ---------- ---
10      B  F  A DISK        10.06.2012 23:21:10 1       1       YES        FULL_DATABASE



RMAN>  quit

</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
