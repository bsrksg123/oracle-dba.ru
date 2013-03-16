<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Настройка актуального времени</h2>

<br/><br/>

<pre> 

Указать доступные ntp сервера
# vi /etc/ntp.conf

Например:

server 0.rhel.pool.ntp.org
server 1.rhel.pool.ntp.org
server 2.rhel.pool.ntp.org


Внесите изменения в файл параметров ntpd

# vi /etc/sysconfig/ntpd

замените

# Drop root to id 'ntp:ntp' by default.
OPTIONS="-u ntp:ntp -p /var/run/ntpd.pid"

на

# Drop root to id 'ntp:ntp' by default.
# OPTIONS="-u ntp:ntp -p /var/run/ntpd.pid"
OPTIONS="-x -u ntp:ntp -p /var/run/ntpd.pid"




# service ntpd restart

</pre> 

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
