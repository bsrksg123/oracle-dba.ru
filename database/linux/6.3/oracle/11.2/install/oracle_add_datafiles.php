<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Расширение табличных пространств (создание дополнительных файлов для табличных пространств). </h2>

<br/><br/>

<pre>
$ sqlplus / as sysdba

Посмотреть какие файлы базы данных используются базой данных и где они расположены:

SQL> set linesize 200;
SQL> set pagesize 0;
SQL> col name format a40;
SQL> SELECT file#, name, status
FROM v$datafile;


1) Создание нового табличное пространство для индексов и данных:

SQL> CREATE TABLESPACE "MY_DATA"
DATAFILE '/u02/oradata/ora112/my_data01.dbf' SIZE 2G AUTOEXTEND OFF;

При необходимости, можно добавить дополнительное место для данных (когда будет такая необходимость) следующими командами:
SQL> ALTER TABLESPACE “MY_DATA”
ADD DATAFILE  '/u02/oradata/ora112/my_data02.dbf' SIZE 2G AUTOEXTEND OFF;


SQL> CREATE TABLESPACE "MY_INDEXES"
DATAFILE '/u02/oradata/ora112/my_indexes01.dbf' SIZE 2G AUTOEXTEND OFF;


При необходимости, можно добавить дополнительное место для индексов (когда будет такая необходимость) следующими командами:

SQL> ALTER TABLESPACE “MY_INDEXES”
ADD DATAFILE  '/u02/oradata/ora112/my_indexes02.dbf' SIZE 2G AUTOEXTEND OFF;


------------------------------

2) Иногда, нужно создать дополнительное табличное пространство для табличного пространства отмены (undo).

SQL> CREATE undo tablespace "UNDO" datafile '/u02/oradata/ora112/undo01.dbf' size 1G autoextend off;

// Определяю созданное табличное пространство, как пространство по умолчанию
SQL> ALTER SYSTEM SET UNDO_TABLESPACE = "UNDO";

// Удаляю старое табличное пространство
SQL> drop tablespace UNDOTBS1;

------------------------------

3) Создать новое табличное пространство для временных данных.

SQL> CREATE TEMPORARY TABLESPACE "MY_TEMP" 
TEMPFILE '/u02/oradata/ora112/my_temp01.dbf' SIZE 2G AUTOEXTEND OFF;


Добавить дополнительный файл для временных табличных пространств.

SQL> ALTER TABLESPACE “MY_TEMP”
ADD TEMPFILE '/u02/oradata/ora112/my_temp02.dbf' SIZE 2G AUTOEXTEND OFF; 

SQL> quit

</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
