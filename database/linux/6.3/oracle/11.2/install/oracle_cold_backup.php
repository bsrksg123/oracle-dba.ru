<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Создание резервной копии созданной базы данных (холодный backup):</h2>

<br/><br/>

<pre>
$ sqlplus / as sysdba

SQL> alter system set db_recovery_file_dest_size = 25G;

SQL> alter system set db_recovery_file_dest="/u03/orabackups/";



SQL> shutdown immediate;
SQL> startup mount;
SQL> quit

$ rman target /
RMAN> backup full database noexclude include current controlfile spfile TAG "FULL_COLD_BACKUP";


RMAN> sql 'alter database open';

// Посмотреть, какие бекапы имеются
RMAN> list backup summary;


RMAN> quit

</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
