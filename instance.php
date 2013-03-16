<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>




<br/><br/><br/>
<h3>Экземпляр базы данных Oracle (Oracle DataBase Instance)</h3><br/>


<br/>
Когда вы инсталлируете базу данных Oracle. Вы сначала устанавливаете программное обеспечение СУБД (Систему Управления Базой Данных, DataBase Software). Помимо СУБД, необходима также сама база данных. Одна система управления базой данных, может работать сразу с несколькими базами данных на одном сервере. Каждая такая база данных в терминологии Oracle называется экземпляром базы данных (DataBase Instance). Каждый запущенный экземпляр активно использует ресурсы процессора, оперативной и дисковой памяти.
<br/><br/>
Далее, мы постепенно разберем что у нас хранится на дисках (основные файлы), какие процессы за что отвечают и собственно, что хранится в оперативной памяти.

<br/><br/><br/>

<strong>Oracle Database = Oracle DataBase Software + Oracle DataBase Instance (s)</strong>

<br/><br/><br/>

<div align="center">
<img src="http://oracle-dba.ru/images/OracleInstance.jpg" border="0" alt="Oracle Instance"><br/>
</div>



<br/>
<br/>
Для того, чтобы узнать текущее состояние экземпляра базы данных,
можно выполнить следующую процедуру:

<br/>
<br/>
1) убедиться, что подключаетесь к базе с правильным параметром ORACLE_SID.<br/>
Поменять SID можно, командой <strong>export</strong>
<br/><br/>
$ export ORACLE_SID=ora112

<br/><br/>

$ echo $ORACLE_SID<br/>
ora112
<br/><br/>
$ sqlplus / as sysdba


<br/>
SQL> select status from v$instance;
<br/>
<br/>

<pre>
STATUS
------------
OPEN
</pre>

<br/><br/>
В данном случае, все хорошо.
<br/><br/>


</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
