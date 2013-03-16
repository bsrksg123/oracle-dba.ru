<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Собрать статистику пользовательской сессии:</h2>
<br/><br/>
Т.е. получить максимально полный отчет по тому, какие действия проводились пользователем и каким образом на эти действия реагировала база.
<br/><br/>

-- Показать текущие сессии

<br/><br/>
<pre class="brush: sql;">

select t.SID, t.SERIAL#, t.osuser as "User", t.MACHINE as "Computer", t.PROGRAM as "Program"
from v$session t
--where (NLS_LOWER(t.PROGRAM) = 'myprogram.exe') -- посмотреть сессии от программы myprogram.exe
--where status='ACTIVE' and osuser!='SYSTEM' -- посмотреть пользовательские сессии
order by 4 asc;

</pre>

<br/><br/>

-- Включить трассировку

<br/><br/>

<pre class="brush: sql;">

begin
dbms_system.set_sql_trace_in_session(sid => 139 , serial# => 40063, sql_trace => true);
end;

</pre>


<br/><br/>

-- Выключить трассировку

<br/><br/>

<pre class="brush: sql;">

begin
dbms_system.set_sql_trace_in_session(sid => 139 , serial# => 40063, sql_trace => false);
end;

</pre>

<br/><br/>

Преобразовать трассировочный файл в понятный для человека вид.
<br/><br/>

<pre class="brush: sql;">

CMD> tkprof filename.trc filename.txt 

</pre>
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
