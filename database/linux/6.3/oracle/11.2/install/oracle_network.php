<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Настройка конфигурации сетевых интерфейсов</h2>

<br/><br/>


Необходимо выбрать подходящее имя для сервера, которое бы отражало его роль и назначение в сети.
<br/><br/>
Для этого, с помощью редактора (например, vi) отредактируйте файл /etc/sysconfig/network

<br/>

Задайте параметры, согласно характеристикам Вашей сети.

<br/><br/>

Не рекомендуется в hostname использовать знак нижнего подчеркивания (_).<br/><br/>
(Enterprise Manager и другие web приложения не смогут подключиться к базе по http/https)

<br/><br/>


       <div class="linuxCommand">

          # vi /etc/sysconfig/network

       </div>

<br/><br/>

       <div class="linuxCode">
          NETWORKING=yes 
          NETWORKING_IPV6=no
          HOSTNAME=oracle112.localdomain
       </div>

<br/><br/>




       <div class="linuxCommand">

          # vi /etc/sysconfig/network-scripts/ifcfg-eth0

       </div>

<br/><br/>

       <div class="linuxCode">
          DEVICE="eth0"
          ONBOOT="yes"
          BOOTPROTO="static"
          IPADDR=192.168.1.10
          NETMASK=255.255.255.0
          GATEWAY=192.168.1.1
       </div>

<br/><br/>


<br/><br/>




       <div class="linuxCommand">

          # vi /etc/resolv.conf

       </div>

<br/><br/>

       <div class="linuxCode">
          nameserver 192.168.1.1
          nameserver 127.0.0.1
          search localdomain

          options attempts: 2
          options timeout: 1
       </div>

<br/><br/>




<br/><br/>




       <div class="linuxCommand">

          # vi /etc/hosts

       </div>

<br/><br/>

       <div class="linuxCode">
          ## Localdomain and Localhost (hosts file, DNS)
          127.0.0.1 localhost.localdomain localhost
          ::1            localhost6.localdomain6 localhost6

          ## IPs Public Network (hosts file, DNS)
          192.168.1.10 oracle112.localdomain oracle112
       </div>

<br/><br/>



Перестартовать сетевые интерфейсы, можно с помощью следующей команды:

<br/><br/>




       <div class="linuxCommand">

         # service network restart

       </div>



</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
