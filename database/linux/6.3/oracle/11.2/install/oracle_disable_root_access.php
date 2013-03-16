<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Запретить удаленное подключение к сереверу баз данных пользователем root:</h2>

<br/><br/>

<pre>


Запрет входа root по SSH

# vi /etc/ssh/sshd_config

Нужно 

#PermitRootLogin yes


заменить на 
PermitRootLogin no



# service sshd restart

</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
