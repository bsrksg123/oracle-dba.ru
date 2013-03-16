<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Настройка некоторых параметров операционной системы</h2>

<br/><br/> 


Некоторые комментарии к следующей команде. Создаем резервную копию файла /etc/selinux/config, и меняем значение парамета SELINUX с enforcing на disabled <br/> <br/> 


    
       <div class="linuxCommand">

# sed -i.bkp -e "s/SELINUX=enforcing/SELINUX=disabled/g" /etc/selinux/config

       </div>


<br/><br/> 

А здесь, мы делаем резервную копию и меняем значение timeout с 5 на 0


       <div class="linuxCommand">

# sed -i.bkp -e "s/timeout=5/timeout=0/g" /boot/grub/grub.conf

       </div>

<br/><br/> 

Выключаю firewall


       <div class="linuxCommand">

# service iptables stop

       </div>


<br/><br/> 

Запрещаю firewall запускаться при старте операционной системы



       <div class="linuxCommand">

# chkconfig iptables off

       </div>

</pre> 

	
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
