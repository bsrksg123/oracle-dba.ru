<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Сессии к базе данных Oracle</h2><br/>


<h3>Список:</h3>

<ul>
<li><a href="#sessions1">Посмотреть текущие сессии к базе данных</a></li>
<li><a href="#sessions2">Найти блокирующую сессию</a></li>
<li><a href="#sessions3">Убить сессию</a></li>
<li><a href="#sessions4">Убийство всех сессий к одной схеме</a></li>
</ul>


<br/>
<br/>
<hr>
<br/>
<br/>


<h3><a name="sessions1">Посмотреть текущие сессии к базе данных</a></h3>



<pre class="brush: sql;">
SELECT t.SID, t.SERIAL#, t.osuser as "User", t.MACHINE as "PC", t.PROGRAM as "Program"
FROM v$session t
--WHERE (NLS_LOWER(t.PROGRAM) = 'cash.exe') -- посмотреть сессии от программы cash.exe
--WHERE status='ACTIVE' and osuser!='SYSTEM' -- посмотреть пользовательские сессии
--WHERE username = 'схема' -- посмотреть сессии к схеме (пользователь)
ORDER BY 4 ASC;

</pre>


<br/><br/>

<h3><a name="sessions2">Найти блокирующую сессию</a></h3>


<pre class="brush: sql;">

SELECT status, SECONDS_IN_WAIT, BLOCKING_SESSION, SEQ# 
FROM v$session 
WHERE username= upper('scott');

</pre>

<br/><br/>


<h3><a name="sessions3">Убить сессию</a></h3>

<pre class="brush: sql;">
ALTER SYSTEM KILL SESSION 'SID,Serial#' IMMEDIATE;
</pre>

<br/><br/>

Заменить 'SID,Serial#' и 'SID,Serial#' на текущие значения сессии.

<br/><br/><br/>


<h3><a name="sessions4">Убийство всех сессий к определенной схеме<</a></h3>


<pre class="brush: sql;">

define USERNAME = "USER_NAME"

begin    
  for i in (select SID, SERIAL# from V$SESSION where USERNAME = upper('&&USERNAME')) loop   
    execute immediate 'alter system kill session '''||i.SID||','||i.SERIAL#||''' immediate';
   end loop;
end;
/

</pre>

</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
