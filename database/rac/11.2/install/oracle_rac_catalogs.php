<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Создание структуры каталогов и назначение необходимых прав</h2>


<pre>


Необходимо выполнить на каждом из узлов кластера:
Давольно неудобное расположение каталогов, обусловлено тем, что в разных каталогах, необходим 
разный набор прав на каталоги. + при внесении изменений возможна ругань при инсталляции.


# mkdir -p /u01/app/oraInventory
# chown -R oracle11:oinstall /u01/app/oraInventory
# chmod -R 775 /u01/app/oraInventory

# mkdir -p /u01/app/grid/11.2
# chown -R oracle11:oinstall /u01/app/grid/11.2
# chmod -R 775 /u01/app/grid/11.2

# mkdir -p /u01/app/oracle/product/rac/11.2
# chown -R oracle11:oinstall /u01/app/oracle
# chmod -R 775 /u01/app/oracle




</pre>

</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
