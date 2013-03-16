<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Мультиплексирование controlfiles</h2>

<br/><br/>

<pre>

$ mkdir -p /u02/oradata/${ORACLE_SID}/control
$ mkdir -p /u03/oradata/${ORACLE_SID}/control


$ sqlplus / as sysdba

SQL> select name from v$CONTROLFILE;


NAME
--------------------------------------------------------------------------------
/u02/oradata/ora112/control01.ctl
/u02/oradata/ora112/control02.ctl

SQL> shutdown immediate;

SQL> quit




$ cp /u02/oradata/ora112/control01.ctl /u02/oradata/${ORACLE_SID}/control/control01.ctl
$ cp /u02/oradata/ora112/control01.ctl /u02/oradata/${ORACLE_SID}/control/control02.ctl
$ cp /u02/oradata/ora112/control01.ctl /u03/oradata/${ORACLE_SID}/control/control03.ctl

$ sqlplus / as sysdba

SQL> startup nomount;

SQL> ALTER SYSTEM SET control_files = '/u02/oradata/ora112/control/control01.ctl', '/u02/oradata/ora112/control/control02.ctl', '/u03/oradata/ora112/control/control03.ctl' scope=spfile;


SQL> shutdown immediate;
SQL> startup;

SQL> SELECT name FROM v$CONTROLFILE;

NAME
--------------------------------------------------------------------------------
/u02/oradata/ora112/control/control01.ctl
/u02/oradata/ora112/control/control02.ctl
/u03/oradata/ora112/control/control03.ctl



SQL> quit

// Удаляем старые controlfile
$ rm /u02/oradata/ora112/control01.ctl
$ rm /u02/oradata/ora112/control02.ctl

</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>

