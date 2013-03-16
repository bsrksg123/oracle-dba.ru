<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Создание структуры каталогов и назначение необходимых прав</h2>

<br/><br/>

<pre> 

# mkdir -p /u01/oracle/database/11.2
# chown -R oracle11:dba /u01/oracle
# chmod -R 775 /u01/oracle/database/11.2


# mkdir -p /u01/oraInventory
# chown -R oracle11:oinstall /u01/oraInventory
# chmod -R 775 /u01/oraInventory


# mkdir -p /u02/oradata
# chown -R oracle11:oinstall /u02/oradata
# chmod -R 775 /u02/oradata

# mkdir -p /u03/oradata
# chown -R oracle11:oinstall /u03/oradata
# chmod -R 775 /u03/oradata


# mkdir -p /u03/orabackups
# chown -R oracle11:oinstall /u03/orabackups
# chmod -R 775 /u03/orabackups  

</pre> 

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
