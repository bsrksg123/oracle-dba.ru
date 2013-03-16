<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Создание пользователя oracle11 и групп</h2>

<br/><br/>
Настройка параметров системы (выполняется на обоих узлах кластера)
 
<pre>

Перед тем как вносить изменения в конфигурационные скрипты, следует предварительно создать их резервные копии:

# 
{
cp /etc/sysctl.conf /etc/sysctl.conf.bkp
cp /etc/security/limits.conf /etc/security/limits.conf.bkp
cp /etc/pam.d/login /etc/pam.d/login.bkp
cp /etc/profile /etc/profile.bkp 		
} 

// Создаем группы:

# groupadd -g 1000 oinstall
# groupadd -g 1001 dba
# groupadd -g 1002 oper


// Создаем пользователя oracle11, сообщаем, что он будет членом групп dba и oinstall и домашним каталогом у него будет /home/oracle11
# useradd -g oinstall -G dba -d /home/oracle11 oracle11

// Устанавливаем пароль для пользователе oracle11
# passwd oracle11




==============
P.S.

Видел как на однром из сайтов создают следующих пользователей и групп. Наверное это более правильно.


groupadd -g 1020 asmadmin
groupadd -g 1021 asmdba
useradd -u 1100 -g oinstall -G asmadmin,asmdba grid
useradd -u 1101 -g oinstall -G dba,asmdba oracle11
</pre>

</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
