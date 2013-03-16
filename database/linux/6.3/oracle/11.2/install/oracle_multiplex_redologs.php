<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Мультиплексирование redologs</h2>

<br/><br/>

<pre>

$ mkdir -p /u02/oradata/${ORACLE_SID}/redologs
$ mkdir -p /u03/oradata/${ORACLE_SID}/redologs



$ sqlplus / as sysdba

Блок команд, чтобы удобнее представить на экране результаты выполнения запросов.

SQL> set linesize 250;
SQL> set pagesize 0;
SQL> col  GROUP# format 99;
SQL> col  MEMBER format a40;
SQL> col  STATUS format a10;
SQL> col  MB format 999;

SQL>
select a.group#, member, a.status, bytes/1024/1024 as "MB"
from v$log a, v$logfile b
where a.group# = b.group#
order by 1;


     1 /u02/oradata/ora112/redo01.log           INACTIVE                         50
     2 /u02/oradata/ora112/redo02.log           INACTIVE                         50
     3 /u02/oradata/ora112/redo03.log           CURRENT                          50


Удалить можно только файлы неактивной группы. Группы можно переключать, что будет показано ниже.
Удаляем файлы группы в состоянии INACTIVE


1) Нужно пересоздать группу 1 и файлы данной группы.
Удаляем файлы группы 1
SQL> alter database drop logfile group 1;

SQL> quit

$ rm /u02/oradata/ora112/redo01.log

$ sqlplus / as sysdba

Добавляем новую группу, перечисляем файлы новой группы и определяем их размер.
SQL> alter database add logfile group 1 ('/u02/oradata/ora112/redologs/redo01.log' , '/u03/oradata/ora112/redologs/redo01.log') size 100M;


2) Нужно пересоздать группу 2 и файлы данной группы.
Удаляем файлы группы 2
SQL> alter database drop logfile group 2;

SQL> quit

$ rm /u02/oradata/ora112/redo02.log

$ sqlplus / as sysdba

SQL> alter database add logfile group 2 ('/u02/oradata/ora112/redologs/redo02.log' , '/u03/oradata/ora112/redologs/redo02.log ') size 100M;



3) Нужно пересоздать группу 3 и файлы данной группы.


Так как группа активна, необходимо переключиться на следующую группу файлов, сделав группу 2 INACTIVE.

Для переключения, достаточно выполнить команды:

SQL> alter system checkpoint;
SQL> alter system switch logfile;


Удаляем файлы группы 3
SQL> alter database drop logfile group 3;

SQL> quit

$ rm /u02/oradata/ora112/redo03.log

$ sqlplus / as sysdba


SQL> alter database add logfile group 3 ('/u02/oradata/ora112/redologs/redo03.log' , '/u03/oradata/ora112/redologs/redo03.log ') size 100M;




SQL> set linesize 250;
SQL> set pagesize 0;
SQL> col  GROUP# format 99;
SQL> col  MEMBER format a40;
SQL> col  STATUS format a10;
SQL> col  MB format 999;



SQL> select a.group#, member, a.status, bytes/1024/1024 as "MB"
from v$log a, v$logfile b
where a.group# = b.group#
order by 1,2;


     1 /u02/oradata/ora112/redologs/redo01.log  CURRENT     100
     1 /u03/oradata/ora112/redologs/redo01.log  CURRENT     100
     2 /u02/oradata/ora112/redologs/redo02.log  UNUSED      100
     2 /u03/oradata/ora112/redologs/redo02.log  UNUSED      100
     3 /u02/oradata/ora112/redologs/redo03.log  UNUSED      100
     3 /u03/oradata/ora112/redologs/redo03.log  UNUSED      100


SQL> quit
</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
