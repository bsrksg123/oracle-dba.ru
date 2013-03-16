<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Oracle RAC:</h2>
<br/><br/>


Для развертывания Oracle Real Applicatoin Cluster 11 необходимо:

<br/><br/>

<ul>
<li>2 сервера, которые будут использоваться в качестве узлов кластера (кластерных нод, nodes). На них устанавливается программное обеспечение Oracle: Oracle ClusterWare и Oracle DataBase (Software)</li>
<li>1 сервер на котором будут храниться файлы данных (storage). Диски данного сервера будут смонтированы в файловой системе узлов кластера. 
Для этого мы воспользуемся технологией iSCSI. </li>
<li>Инсталляция DNS сервера описывается отдельно.</li>
</ul>



<br/><br/>
<strong>Минимальное количество сетевых интерфейсов необходимых для развертывания Oracle RAC два, но для обеспечения большей доступности, количество интерфейсов может быть увеличено. В нашем случае на каждой ноде установлено по 3 сетевых адаптера.</strong>
<br/><br/>

<ul>
	<li>eth0 – public</li>
	<li>eth1 – interconnect (для связи межу узлами кластера)</li>
	<li>eth2 – private (для связи узлов кластера с внешним хранилищем (storage))</li>
</ul>


<br/><br/>
<strong>Для инсталляции RAC, необходимо в одной подсети выделить IP адреса для доступа клиентов (непосредственно, либо через маршрутизатор):</strong>
<br/><br/>

<ul>
	<li>1 public IP для каждого узла (просто для того, чтобы подключиться к серверу и выполнять задачи по администрированию)</li>
	<li>1 vip IP для каждого узла (желательно, чтобы vip были прописаны в DNS)</li>
	<li>3 IP адреса для SCAN (обязательно должны быть прописаны в DNS. Клиент обращается к SCAN адресу, который перенаправляет запрос на поднятый на узле кластера vip адрес)</li>
</ul>


<br/><br/>
<h2>Предварительные настройки на всех виртуальных машинах:</h2>
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

<br/><br/>

<pre>

1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111

# vi /etc/grub.conf

Нужно вырать следующее ядро для автозапуска:
Oracle Linux Server-base (2.6.18-274.el5)

1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111

</pre>

<br/><br/>


<br/><br/>
<hr>
<br/><br/>


<h2>Настройка конфигурации сетевых интерфейсов:</h2>


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
nameserver 192.168.1.10
nameserver 192.168.1.1
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

<br/><br/>
<hr>
<br/><br/>


<h2>Конфигурурование системных пользователей, настройка параметров системы (выполняется на обоих узлах кластера):</h2>
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


</pre>

<br/><br/>
<hr>
<br/><br/>


<h2>Настройка Secure Shell между узлами кластера:</h2>

<pre>



Необходимо, чтобы узлы кластера могли обмениваться между собой по протоколу ssh.

Собственно, когда устанавливается Oracle RAC, он устанавливается только на первую ноду, на все стальные он просто копируется.


Настраиваем secure shell (ssh) 

node1

su - oracle11

mkdir ~/.ssh
chmod 700 ~/.ssh



Создаем RSA-type public и private encryption keys. (На все вопросы просто жмем Enter)

$ /usr/bin/ssh-keygen -t rsa

Создаем DSA-type public и private encryption keys.  (На все вопросы жмем Enter)

$ /usr/bin/ssh-keygen -t dsa


$ cd .ssh/


Добавляем полученные ключи в файл authorized key.

$ cat id_rsa.pub >>authorized_keys
$ cat id_dsa.pub >>authorized_keys 

ssh node2 mkdir /home/oracle11/.ssh/

scp authorized_keys node2:/home/oracle11/.ssh

ssh node2

Повторяем процедуру генерации

$ /usr/bin/ssh-keygen -t rsa
$ /usr/bin/ssh-keygen -t dsa


$ cd ~/.ssh
$ cat id_rsa.pub >> authorized_keys
$ cat id_dsa.pub >> authorized_keys


$ chmod 644 authorized_keys

$ scp authorized_keys node1:/home/oracle11/.ssh

$ ssh node1

$ exec /usr/bin/ssh-agent $SHELL
$ /usr/bin/ssh-add


Проверяем, что все работает нормально. Необходимо постараться пройти все возможные варианты подключений между узлами без ввода учетных записей.

$ ssh node1 date
$ ssh node2 date

$ ssh node1.localdomain date
$ ssh node2.localdomain date

$ ssh node2

$ ssh node1 date
$ ssh node2 date

$ ssh node1.localdomain date
$ ssh node2.localdomain date

</pre>

<br/><br/>
<hr>
<br/><br/>

<strong>Добавление репозитория для инсталляции пакетов (на node1, node2 и storage):</strong>

<br/><br/>

# vi /etc/yum.repos.d/oracleLinuxRepoINTERNET.repo

<br/><br/>

<pre>
[OEL_INTERNET]
name=Oracle Enterprise Linux $releasever - $basearch 
baseurl=http://public-yum.oracle.com/repo/OracleLinux/OL5/latest/x86_64/
gpgkey=http://public-yum.oracle.com/RPM-GPG-KEY-oracle-el5
gpgcheck=1
enabled=1

</pre>


<br/><br/>
<strong># yum repolist</strong>


<br/><br/>
<hr>
<br/><br/>


<h2>Подготовка дисков к инсталляции базы данных:</h2>



<h3>Подготовка дисков к инсталляции базы данных:</h3>

<pre>
node 1 и node2: 

# fdisk /dev/sdb


The number of cylinders for this disk is set to 5221.
There is nothing wrong with that, but this is larger than 1024,
and could in certain setups cause problems with:
1) software that runs at boot time (e.g., old versions of LILO)
2) booting and partitioning software from other OSs
  (e.g., DOS FDISK, OS/2 FDISK)

Command (m for help): n
Command action
  e   extended
  p   primary partition (1-4)
p
Partition number (1-4): 1
First cylinder (1-5221, default 1):
Using default value 1
Last cylinder or +size or +sizeM or +sizeK (1-5221, default 5221):
Using default value 5221

Command (m for help): w
The partition table has been altered!

Calling ioctl() to re-read partition table.
Syncing disks.



# mkfs.ext4 /dev/sdb1

# mkdir /u01

# cp /etc/fstab /etc/fstab.bkp
# echo "/dev/sdb1 /u01 ext4 defaults 1 2" >> /etc/fstab

# mount /u01

# mount | grep sdb1
/dev/sdb1 on /u01 type ext4 (rw)

</pre>

<h3>Инсталляция ISCSI (необходима, чтобы диски на storage стали доступными узлам кластера):</h3>

http://www.outsidaz.org/blog/2010/02/27/configuring-iscsi-targets-and-initiators-on-rhel5/
<pre>




iSCSI target — программа или контроллер, осуществляющие эмуляцию диска и выполняющие запросы iSCSI.
iSCSI initiator — программа, осуществляющая клиентский доступ к SCSI.


<strong>На storage</strong>

# yum install -y scsi-target-utils 


1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111


# chkconfig --level 345 tgtd on


1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111
1111111111111111111111111111111111111111111111111111111111111111

# ls /dev/sd*
/dev/sda   /dev/sda2  /dev/sdc  /dev/sde  /dev/sdg
/dev/sda1  /dev/sdb   /dev/sdd  /dev/sdf  /dev/sdh


# service tgtd start


# 
{
## DISK1 - sdb

tgtadm --lld iscsi --op new --mode target --tid 1 -T ru.oracle-dba:disk1
tgtadm --lld iscsi --op new --mode logicalunit --tid 1 --lun 1 -b /dev/sdb
tgtadm --lld iscsi --op bind --mode target --tid 1 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 1 -I 192.168.3.12


## DISK2 - sdc

tgtadm --lld iscsi --op new --mode target --tid 2 -T ru.oracle-dba:disk2
tgtadm --lld iscsi --op new --mode logicalunit --tid 2 --lun 1 -b /dev/sdc
tgtadm --lld iscsi --op bind --mode target --tid 2 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 2 -I 192.168.3.12

## DISK3 - sdd

tgtadm --lld iscsi --op new --mode target --tid 3 -T ru.oracle-dba:disk3
tgtadm --lld iscsi --op new --mode logicalunit --tid 3 --lun 2 -b /dev/sdd
tgtadm --lld iscsi --op bind --mode target --tid 3 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 3 -I 192.168.3.12

## DISK4 - sde

tgtadm --lld iscsi --op new --mode target --tid 4 -T ru.oracle-dba:disk4
tgtadm --lld iscsi --op new --mode logicalunit --tid 4 --lun 3 -b /dev/sde
tgtadm --lld iscsi --op bind --mode target --tid 4 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 4 -I 192.168.3.12


## DISK5 - sdf

tgtadm --lld iscsi --op new --mode target --tid 5 -T ru.oracle-dba:disk5
tgtadm --lld iscsi --op new --mode logicalunit --tid 5 --lun 4 -b /dev/sdf
tgtadm --lld iscsi --op bind --mode target --tid 5 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 5 -I 192.168.3.12



## DISK6 - sdg

tgtadm --lld iscsi --op new --mode target --tid 6 -T ru.oracle-dba:disk6
tgtadm --lld iscsi --op new --mode logicalunit --tid 6 --lun 5 -b /dev/sdg
tgtadm --lld iscsi --op bind --mode target --tid 6 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 6 -I 192.168.3.12


## DISK7 - sdh

tgtadm --lld iscsi --op new --mode target --tid 7 -T ru.oracle-dba:disk7
tgtadm --lld iscsi --op new --mode logicalunit --tid 7 --lun 6 -b /dev/sdg
tgtadm --lld iscsi --op bind --mode target --tid 7 -I 192.168.3.11
tgtadm --lld iscsi --op bind --mode target --tid 7 -I 192.168.3.12
}


# --lld [driver] - "Which driver to use. Currently iSCSI is the only option"
# --op [operation] - "Which operation to complete"
# --mode [mode] - "What are we operating on, whether it is a target or logicalunit (LUN)
# --tid [target] - "Which target are we operating on"
# --targetname [name] "The name of said target"




Посмотреть результаты:
# tgtadm --lld iscsi --op show --mode target


// Save this configuration to a config file so it is persistent across reboots.
tgt-admin --dump >> /etc/tgt/targets.conf

Если нужно сбросить все настройки, достаточно просто перестартовать сервис.
# service tgtd restart



<h3>Подключение экспортированных дисков к узлам</h3>


На node1, node2:

# yum install -y iscsi-initiator-utils.x86_64

11111111111111111111111111111111111111111111111111111111111
11111111111111111111111111111111111111111111111111111111111
11111111111111111111111111111111111111111111111111111111111
11111111111111111111111111111111111111111111111111111111111

# chkconfig --level 345 iscsi on
# chkconfig --level 345 iscsid on


11111111111111111111111111111111111111111111111111111111111
11111111111111111111111111111111111111111111111111111111111
11111111111111111111111111111111111111111111111111111111111
11111111111111111111111111111111111111111111111111111111111


# service iscsid start
# service iscsi start



# iscsiadm -m discovery -t sendtargets -p 192.168.3.15:3260

192.168.3.15:3260,1 ru.oracle-dba:disk1
192.168.3.15:3260,1 ru.oracle-dba:disk2
192.168.3.15:3260,1 ru.oracle-dba:disk3
192.168.3.15:3260,1 ru.oracle-dba:disk4
192.168.3.15:3260,1 ru.oracle-dba:disk5
192.168.3.15:3260,1 ru.oracle-dba:disk6
192.168.3.15:3260,1 ru.oracle-dba:disk7


// List node records: 
# iscsiadm --mode node

// Display all data for a given node record:
iscsiadm --mode node --targetname ru.oracle-dba:disk1 --portal 192.168.3.15:3260


---------
Ранее обходились без них

# iscsiadm --mode node --targetname ru.oracle-dba:disk1 --portal 192.168.3.15:3260 --login
# iscsiadm --mode node --targetname ru.oracle-dba:disk2 --portal 192.168.3.15:3260 --login
# iscsiadm --mode node --targetname ru.oracle-dba:disk3 --portal 192.168.3.15:3260 --login
# iscsiadm --mode node --targetname ru.oracle-dba:disk4 --portal 192.168.3.15:3260 --login
# iscsiadm --mode node --targetname ru.oracle-dba:disk5 --portal 192.168.3.15:3260 --login
# iscsiadm --mode node --targetname ru.oracle-dba:disk6 --portal 192.168.3.15:3260 --login
# iscsiadm --mode node --targetname ru.oracle-dba:disk7 --portal 192.168.3.15:3260 --login

Ранее обходились без них
---------
# iscsiadm --mode node --targetname ru.oracle-dba:disk1 --portal 192.168.3.15:3260 --logout
# iscsiadm --mode node --targetname ru.oracle-dba:disk2 --portal 192.168.3.15:3260 --logout
# iscsiadm --mode node --targetname ru.oracle-dba:disk3 --portal 192.168.3.15:3260 --logout
# iscsiadm --mode node --targetname ru.oracle-dba:disk4 --portal 192.168.3.15:3260 --logout
# iscsiadm --mode node --targetname ru.oracle-dba:disk5 --portal 192.168.3.15:3260 --logout
# iscsiadm --mode node --targetname ru.oracle-dba:disk6 --portal 192.168.3.15:3260 --logout
# iscsiadm --mode node --targetname ru.oracle-dba:disk7 --portal 192.168.3.15:3260 --logout




# less /var/log/messages

# service iscsi restart

Получить список дисков
# ls /dev/sd*

Получить информацию по дискам
# fdisk -l 


 




http://linux.die.net/man/8/iscsiadm



<h3>Настройка правил UDEV, чтобы при перезагрузке, сохранялись имена устройств в системе.</h3>



На node1 и node2:

# cp /etc/scsi_id.config /etc/scsi_id.config.bkp
# echo "vendor="NETAPP", model=LUN, options=-g" >> /etc/scsi_id.config


Нужно получить серийный номер для каждого SCSI устройства (LUN):


# scsi_id -g -u -s /block/sdc
1IET_00060006
# scsi_id -g -u -s /block/sdd
1IET_00070007
# scsi_id -g -u -s /block/sde
1IET_00010001
# scsi_id -g -u -s /block/sdf
1IET_00050005
# scsi_id -g -u -s /block/sdg
1IET_00030003
# scsi_id -g -u -s /block/sdh
1IET_00040004
# scsi_id -g -u -s /block/sdi
1IET_00020002




* -g : Treat the device as white listed
* -u : Reformat the output
* -s /bock/sdd : Generate an id for the /block/sda.




vi /etc/udev/rules.d/99-static-scsi-names.rules

	
#----------------------------
#DISKS
#----------------------------
# SCSI1
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00010001", NAME="sdc%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI2
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00020002", NAME="sdd%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI3
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00030003", NAME="sde%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI4
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00040004", NAME="sdf%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI5
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00050005", NAME="sdg%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI6
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00060006", NAME="sdh%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI7
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00070007", NAME="sdi%n", OWNER="oracle11", GROUP="dba", MODE="0640"





#----------------------------
#DISKS
#----------------------------
# SCSI1
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00010001", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI2
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00020002", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI3
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00030003", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI4
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00040004", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI5
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00050005", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI6
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00060006", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"
# SCSI7
KERNEL=="sd*", BUS=="scsi", PROGRAM=="/sbin/scsi_id -g -u -s %p", RESULT=="1IET_00070007", NAME="ext_dsk%n", OWNER="oracle11", GROUP="dba", MODE="0640"



udevtest /block/sda

udevcontrol reload_rules

start_udev







Инсталляция asmlib


Проверяем, какое ядро используется:

uname -rm
2.6.32-200.13.1.el5uek x86_64

В репозитории пакеты oracleasm для ядра.
oracleasm-2.6.18-274.el5.x86_64

Необходимо выбрать нужно ядро. В файле grub.conf указываю какое ядро необходимо использовать.
# vi /etc/grub.conf



Необходимо 3 пакета :

2 общие для всех ядер (oracleasm-support*.rpm и oracleasmlib*.rpm)
и пакет соответствующий ядру. В моем случае это oracleasm-2.6.18-194.32.1.el5-2.0.5-1.el5.x86_64.rpm

Необходимо с сайта Oracle:

http://www.oracle.com/technetwork/server-storage/linux/downloads/rhel5-084877.html?ssSourceSiteId=ocomen

Скачать: oracleasmlib-2.0.4-1.el5.x86_64.rpm

Далее скачанный файл я копирую в каталог /tmp
# scp oracleasmlib-2.0.4-1.el5.x86_64.rpm root@192.168.1.20:/tmp

# cd /tmp

key ID 1e5e0159
# vi key_1e5e0159


-----BEGIN PGP PUBLIC KEY BLOCK-----
Version: GnuPG v1.2.6 (GNU/Linux)

mQGiBEZNBCgRBAC3RQKaN5WC3EQN1RhLeM4WXl9GLz2p/nvoDSpGQVKYxpobYScF
nNkn6CUPuIhLrVJRAuVhCjgpOZS/KtU3n1P+eSm9FauqW1FoA7WUzsZRyMZh5T8A
1RpaTxYv+nb667EKmBXEUFgMyZK4JRzPrVFIoxjI5AX3vQzlefQi3aluewCgsSc5
3rm/0reucF/wpIVIhA2yYZED/jFO/DzJJ5XLRPcPhVz8Zm5rtOmOoN9So5wrv5l5
NxVejlZSo7W/AOdOlIkRztZ8qLCFblG/jwLL97ERPAkIh69ISHlmO5LVerDek/j+
jyr07YsoF3ahhay0R3NDJH95VJhJqOefqRv+YLFK1bbwE5Sqjb/0QOu/6cqRWZFx
glw3BACTKKKkrFcpWmYd3sG0vn04xcQsh2yhCq1S+4nFhbV2KH14StHV8caZCDlA
Hsfh/bM1feXTYlJSIxuokYBEavt2fKeInp59TKPdRxjawAHGwfexgBnqT6GCcZlD
0XWScUKe9X+g6DbsV+/wt7g/Q1nUAZYl4hb1rn+FGxWYOI02+7RET3JhY2xlIE9T
UyBncm91cCAoT3BlbiBTb3VyY2UgU29mdHdhcmUgZ3JvdXApIDxidWlsZEBvc3Mu
b3JhY2xlLmNvbT6IZAQTEQIAJAUCRk0EKAIbAwUJDwmcAAYLCQgHAwIDFQIDAxYC
AQIeAQIXgAAKCRBmztPeHl4BWb/lAJ96rhwoCYBzB+gxQenOZXQA8ulabgCfaV0m
jWLQLm0hnp5gFk0AFM0q2Za5AQ0ERk0EKhAEAIlQEI38AN1tgzX/70Ny1BulBpmq
5FAT62fMl5Bc8lXrmNBpX7Qwca6IMyuqCt00hTBwcY8PWkdQs0V4T9hrMlALq1gF
whF5ViTUAC3BPFrggJJxTYx+r6z7IWnt/v2WLnUlJ0PP6/8s6IFplFxhBZVPAshN
3tz7wOacVb7L7/PvAAQNA/9gmi1sNHfDg7Ng2idNfpr0PKWAQJ+VnUAEENEAMXIn
vYZovJ5HTluzLDWM4yBmK7lqxSdN+7Ro6LYz7orRVNLpGJD8EHO2uZDQkeFiwb2N
HfjKR52Or5mj/AmIxZR4A9626PlaVAXq8Pba44nUMp1VpNkvsJUmgxIz4s8sRJuN
t4hPBBgRAgAPBQJGTQQqAhsMBQkPCZwAAAoJEGbO094eXgFZ6yUAn2E9A2rtGsNV
TUIjQIsRduYTj8yWAKCtqU1Tg2CyTeSsSBZlnpdbA1qzGw==
=WJsp
-----END PGP PUBLIC KEY BLOCK-----


# rpm --import key_1e5e0159


# yum install -y \
oracleasm-2.6.18-274.el5.x86_64 \
oracleasm-support.x86_64 \
oracleasmlib-2.0.4-1.el5.x86_64.rpm




# /etc/init.d/oracleasm configure


Default user to own the driver interface []: oracle11
Default group to own the driver interface []: oinstall
Start Oracle ASM library driver on boot (y/n) [n]: y
Scan for Oracle ASM disks on boot (y/n) [y]: y
Writing Oracle ASM library driver configuration: done
Initializing the Oracle ASMLib driver:                 	[  OK  ]
Scanning the system for Oracle ASMLib disks:           	[  OK  ]


# /etc/init.d/oracleasm status
Checking if ASM is loaded: yes
Checking if /dev/oracleasm is mounted: yes


Маркируем диски как ASM диски:

# fdisk /dev/sdc
# fdisk /dev/sdd
# fdisk /dev/sde
# fdisk /dev/sdf
# fdisk /dev/sdg
# fdisk /dev/sdh
# fdisk /dev/sdi

ls /dev/sd*


Маркируем диски как ASM диски:

# /etc/init.d/oracleasm createdisk VOL1 /dev/sdc1
# /etc/init.d/oracleasm createdisk VOL2 /dev/sdd1
# /etc/init.d/oracleasm createdisk VOL3 /dev/sde1
# /etc/init.d/oracleasm createdisk VOL4 /dev/sdf1
# /etc/init.d/oracleasm createdisk VOL5 /dev/sdg1
# /etc/init.d/oracleasm createdisk VOL6 /dev/sdh1
# /etc/init.d/oracleasm createdisk VOL7 /dev/sdi1

Marking disk "VOL1" as an ASM disk:                    	[  OK  ]

ХЗ почему, 7 диск забраковал



// Посмотреть список дисков
# /etc/init.d/oracleasm listdisks


VOL1
VOL2
VOL3
VOL4
VOL5
VOL6


// файл логов
# less /var/log/oracleasm


В некоторых случаях, необходимо перестартовать oracleasm
# /etc/init.d/oracleasm restart

</pre>

</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
