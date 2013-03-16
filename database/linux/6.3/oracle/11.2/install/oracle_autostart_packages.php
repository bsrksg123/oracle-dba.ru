<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Автозапуск только выбранных программ</h2>

<br/><br/>

<pre> 

// Следующая команда отключает автозапуск сразу всех пакетов.
# for i in $(chkconfig --list | grep '3:on\|4:on\|5:on' | awk {'print $1'}); do chkconfig --level 345 $i off; done

// Посмотреть какие программы сейча автостартуют при запуске операционной системы.
# chkconfig --list | grep '3:on\|4:on\|5:on'  |awk '{print $1}' | sort

После этого, включаем в автозапуск следующие программы:


{
chkconfig --level 345 network on
chkconfig --level 345 sshd on
chkconfig --level 345 ntpd on
}



{
chkconfig --level 345 auditd on
chkconfig --level 345 messagebus on
chkconfig --level 345 netfs on
chkconfig --level 345 sysstat on
chkconfig --level 345 crond on
chkconfig --level 345 xinetd on
}


Позднее будет также добавлено:
# chkconfig --level 345 startupOracleDatabase11GR2 on



// Обязательно убедиться, что ssh будет запущен при автозапуске!.
# chkconfig --list | grep ssh

Далее, следует перезагрузить сервер, чтобы просто убедиться, что все нормально поднимается после перезагрузки.

# reboot         

</pre> 

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
