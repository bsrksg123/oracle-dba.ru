<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h1>Oracle RAC 11G R2:</h1>
<br/><br/>

<pre>

1) 

$ vi /etc/oratab

+ASM1:/u01/app/grid/11.2:N
racnode:/u01/app/oracle/product/database/11.2:N


+ASM1:/u01/app/grid/11.2:Y
racnode:/u01/app/oracle/product/database/11.2:Y




$ vi /etc/oratab

+ASM2:/u01/app/grid/11.2:N
racnode:/u01/app/oracle/product/database/11.2:N

+ASM2:/u01/app/grid/11.2:Y
racnode:/u01/app/oracle/product/database/11.2:Y    



2) Убедитесь, что удается подключиться к узлам кластера командой sqlplus
Если нет, 

Покажет какие процессы запущены.
ps -eaf | grep ora*

Из этого можно будет понять какое имя у экземпляра.
Откореектируйте 

vi /home/oracle11/.bash_profile

	export ORACLE_SID=racnode1
	export ORACLE_UNQNAME=racnode1




</pre>





</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
