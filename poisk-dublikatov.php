<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
	<div align="left">


<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>"><img src="remote_oracle_dba.jpeg" border="0" alt="Remote Oracle DataBase Administrator"></a><br/></div>




<br/>
<br/><br/>

<div align="center">
<h3>Поиск одинаковых записей в базе данных (поиск дубликатов)</h3><br/>



<br/><br/>
<div align="left">
<pre>
select do, count(*)
from region
group by do
having count(*) > 1; 
</pre>
</div>


</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
