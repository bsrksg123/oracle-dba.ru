<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Мультиплексирование archivelog</h2>

<br/><br/>

<pre>

Создание каталога для хранения файлов резервных копий и архивных журналов

$ mkdir -p /u02/oradata/${ORACLE_SID}/archivelogs
$ mkdir -p /u03/oradata/${ORACLE_SID}/archivelogs


$ sqlplus / as sysdba

Задать разделы для архивных журналов
SQL>  ALTER SYSTEM SET LOG_ARCHIVE_DEST_1='location=/u02/oradata/ora112/archivelogs mandatory' scope=both;
SQL>  ALTER SYSTEM SET LOG_ARCHIVE_DEST_2='location=/u03/oradata/ora112/archivelogs mandatory' scope=both;

Посмотреть текущие значения параметра LOG_ARCHIVE_DEST
SQL> show parameter LOG_ARCHIVE_DEST ;

Задать формат для файлов arhivelogs
SQL>  ALTER SYSTEM SET LOG_ARCHIVE_FORMAT='%t_%s_%R.arc' scope=spfile;

SQL> quit

</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
