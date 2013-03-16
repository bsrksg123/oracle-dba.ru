<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
	<div align="left">


<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>"><img src="remote_oracle_dba.jpeg" border="0" alt="Remote Oracle DataBase Administrator"></a><br/></div>




<br/>
<br/><br/>


<h3>FlashBack queries</h3><br/>

<div align="left">

<pre>

Если пользователь зафиксировал изменения, можно выполнить запрос прошлых данных (flashback queries) для выяснения значений, которые были до изменения (и затем изменить данные, восстановив их старые значения)

SELECT salate FROM employees
AS OF TIMESTAMP (SYSTIMESTAMP-INTERVAL'10' minute)
WHERE employee_id=100;


Если кому-то из сотрудников недавно ошибочно был изменен оклад, можно вернуть старое значение, выполнив команду UPDATE с подзапросом, в котором возвращается хранившееся ранее значение оклада. 


UPDATE employees SET salary =
(SELECT salary FROM employees
AS OF TIMESTAMP TO_TEMESTAMP
('2005-05-04 11:00:00', 'yyyy-mm-dd hh24:mi:ss')
WHERE employee_id = 200)


</pre>


</div>
<br/><br/><br/>




</div>	
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
