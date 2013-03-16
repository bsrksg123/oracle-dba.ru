<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>


<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Настройка актуального времени на серверах</h2>
<br/><br/>


<pre>


<span style="font-size: 20px; text-align: left; line-height: 130%; font-family: Arial,Helvetica,sans-serif; color: rgb(153, 0, 0);">
<strong>Настройка времени</strong></span>

<br/><br/>

<table cellpadding="4" cellspacing="2" align="center" border="0" width="98%">  
<tr>      
	<td style="color: rgb(255, 255, 255);" bgcolor="#386351" width="14%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>Server:</strong></span></td>      
	<td height="20" bgcolor="#a2bcb1" width="60%"><span style="font-family: Arial,Helvetica,sans-serif; font-size: 14px;"><strong>node1, node2, storage</strong></span></td>      
	<td rowspan="3" align="center" valign="middle" width="26%"></td>
</tr>
</table>


Указать доступные ntp сервера
# vi /etc/ntp.conf


server 0.rhel.pool.ntp.org
server 1.rhel.pool.ntp.org
server 2.rhel.pool.ntp.org


<!--
Настраиваем планировщик заданий

Сервера ru.pool.ntp.org выбраны в качестве примера

# crontab -e

# Set the date and time via NTP
*/15 * * * * /usr/sbin/ntpdate 0.ru.pool.ntp.org 1.ru.pool.ntp.org 2.ru.pool.ntp.org 3.ru.pool.ntp.org   > /var/log/time.log


-->

Внесите изменения в файл параметров ntpd

# vi /etc/sysconfig/ntpd

замените

# Drop root to id 'ntp:ntp' by default.
OPTIONS="-u ntp:ntp -p /var/run/ntpd.pid"

на

# Drop root to id 'ntp:ntp' by default.
# OPTIONS="-u ntp:ntp -p /var/run/ntpd.pid"
OPTIONS="-x -u ntp:ntp -p /var/run/ntpd.pid"

# 
# service ntpd restart

</pre>
</div>		


</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
