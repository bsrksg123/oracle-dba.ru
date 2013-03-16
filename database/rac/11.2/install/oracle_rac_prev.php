<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>


<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Предварительные настройки</h2>
<br/><br/>

Следующие команды выполняются на всех виртаульных машинах
<br/><br/>


<pre>
Некоторые комментарии к следующим 2 командам - 1 создает резервную копию файла /etc/selinux/config, а вторая заменяет значение парамета SELINUX с enforcing на disabled

# cp /etc/selinux/config /etc/selinux/config.bkp
# sed -i.gres "s/SELINUX=enforcing/SELINUX=disabled/g" /etc/selinux/config

Следующие 2 команды -  1 создает резервную копию файла, меняет значение timeout с 5 на 0

# cp /etc/grub.conf /etc/grub.conf.bkp
# sed -i.gres "s/timeout=5/timeout=0/g" /etc/grub.conf


Выключаю firewall
# service iptables stop

Запрещаю firewall запускаться при старте операционной системы
# chkconfig iptables off

</pre>

</div>		


</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
