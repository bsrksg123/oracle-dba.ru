<html>

<?php include_once "../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle RAC 11.2]: Настройка конфигурации сетевых интерфейсов</h2>

<br/><br/>

<h3>Настройка на storage, node1, node2: </h3>

<br/><br/>

<strong># vi /etc/hosts</strong>

<pre>

###############################################
## Localdomain and Localhost (hosts file, DNS)

127.0.0.1 localhost.localdomain localhost
::1            localhost6.localdomain6 localhost6

###############################################
## Virtual VIP IPs Public Network (hosts file, DNS)

192.168.1.21 node1-vip.localdomain node1-vip
192.168.1.22 node2-vip.localdomain node2-vip

###############################################
## eth0 Public Network (hosts file, DNS)

192.168.1.11 node1.localdomain node1
192.168.1.12 node2.localdomain node2
192.168.1.15 storage.localdomain nas

################################################
## eth1 Interconnect Private Network  (hosts file, DNS)

192.168.2.11 node1-priv
192.168.2.12 node2-priv

#################################################
## eth2 Network to nas Private Network (hosts file, DNS)

192.168.3.11 node1-priv-storage
192.168.3.12 node2-priv-storage

#################################################
## SCAN and GNS (DNS, DHCP)

# empty

#################################################
#################################################

</pre>

<br/><br/>
<strong># vi /etc/resolv.conf</strong>
<br/><br/>

<pre>
search localdomain 
nameserver 192.168.1.1
nameserver 192.168.1.10
options attempts: 2
options timeout: 1
</pre>




<pre>


<h3>Настройка сети узел 1 (node1): </h3>



# vi /etc/sysconfig/network

NETWORKING=yes
NETWORKING_IPV6=no
HOSTNAME=node1.localdomain



(public)
# vi /etc/sysconfig/network-scripts/ifcfg-eth0

DEVICE="eth0"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.1.11
NETMASK=255.255.255.0
GATEWAY=192.168.1.1




(private-interconnect)
# vi /etc/sysconfig/network-scripts/ifcfg-eth1

DEVICE="eth1"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.2.11
NETMASK=255.255.255.0




(private-storage)
# vi /etc/sysconfig/network-scripts/ifcfg-eth2

DEVICE="eth2"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.3.11
NETMASK=255.255.255.0




<h3>Настройка сети узел 2 (node1): </h3>
 

# vi /etc/sysconfig/network

NETWORKING=yes
NETWORKING_IPV6=no
HOSTNAME=node2.localdomain


(public)
# vi /etc/sysconfig/network-scripts/ifcfg-eth0

DEVICE="eth0"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.1.12
NETMASK=255.255.255.0
GATEWAY=192.168.1.1

(private-interconnect)
# vi /etc/sysconfig/network-scripts/ifcfg-eth1

DEVICE="eth1"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.2.12
NETMASK=255.255.255.0


(private-storage)
# vi /etc/sysconfig/network-scripts/ifcfg-eth2

DEVICE="eth2"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.3.12
NETMASK=255.255.255.0



Перестартовать сетевые интерфейсы, можно с помощью следующей команды:
# service network restart

</pre>


<br/><br/>

<h3>Настройка сети (storage): </h3>

<pre>

# vi /etc/sysconfig/network

NETWORKING=yes
NETWORKING_IPV6=no
HOSTNAME=storage.localdomain



(public)
# vi /etc/sysconfig/network-scripts/ifcfg-eth0

DEVICE="eth0"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.1.15
NETMASK=255.255.255.0
GATEWAY=192.168.1.1


(private-storage)
# vi /etc/sysconfig/network-scripts/ifcfg-eth1

DEVICE="eth1"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.3.15
NETMASK=255.255.255.0

</pre>


</div>		
		
	

<?php include_once "../../../../_footer.php"?>

</body>

</html>
