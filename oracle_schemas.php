<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Схемы</h2>
<br/><br/>

Под термином схема в базе данных Oracle понимается - созданная учетная запись пользователя и объекты, которые ей принадлежат (например, индексы, триггеры, хранимые процедуры).


<pre>

Посмотреть имеющиеся схемы в базе данных:
SQL> set pagesize 0;
SQL> select username from dba_users order by 1;

---------------------

Создать новую схему в базе данных
SQL> CREATE USER scott IDENTIFIED BY tiger;


Создать новую схему с явным указанием расположения, где должны храниться данные и индексы.
SQL> CREATE USER scott
                IDENTIFIED BY tiger
                DEFAULT TABLESPACE MY_DATA
                TEMPORARY TABLESPACE MY_TEMP
                ACCOUNT UNLOCK;


Делегировать пользователю возможность подключаться к базе и работать с ней
SQL> grant connect, resource to scott

---------------------

Удалить схему можно следующей командой:
SQL> drop user scott cascade; 



Разблокировать схему, можно командой:
SQL> alter user scott account unlock;

А поменять пароль
SQL> alter user system identified by NewPassword;

</pre>
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
