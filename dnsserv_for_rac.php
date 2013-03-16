<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Oracle DNS FOR RAC:</h2>
<br/><br/>




<h2>Настройка сети:</h2>

<br/><br/>
<br/><br/>

<strong># vi /etc/hosts</strong>

<pre>

###############################################
## Localdomain and Localhost (hosts file, DNS)

127.0.0.1 localhost.localdomain localhost
::1            localhost6.localdomain6 localhost6

###############################################
## 

192.168.1.15 dnsserv.localdomain dnsserv

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


# vi /etc/sysconfig/network

NETWORKING=yes
NETWORKING_IPV6=no
HOSTNAME=dnsserv.localdomain



(public)
# vi /etc/sysconfig/network-scripts/ifcfg-eth0

DEVICE="eth0"
ONBOOT="yes"
BOOTPROTO="static"
IPADDR=192.168.1.10
NETMASK=255.255.255.0
GATEWAY=192.168.1.1

</pre>


Перестартовать сетевые интерфейсы, можно с помощью следующей команды:
# service network restart


</pre>



<h2>Инсталляция DNS сервера:</h2>



<strong>Инсталляция пакетов из репозитория Oracle Linux в интернете:</strong>

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
<strong># yum install -y bind</strong>

<br/><br/>




<h2>Настройка конфигурационных файлов DNS сервера:</h2>

<br/><br/>

<strong># vi /etc/named.conf</strong>


<br/><br/>

<pre>

options
{
        directory "/var/named";
        
};

       // ## Localhost

       zone "localhost" IN {
              type master;
              file "localhost.zone";
              allow-update { none; };
       };

        zone "0.0.127.in-addr.arpa" IN {
                type master;
                file "127.0.0.in-addr.arpa";
        allow-update {none;};
        };


 // ## Localdomain without domain prefix

        zone "." IN  {
                 type master;
                 file "localdomain.zone";
                 allow-update {none;};
        };


       // ## Localdomain with domain prefix



        zone "localdomain" IN  {
                 type master;
                 file "localdomain.zone";
                 allow-update {none;};
        };



// ## zone ARPA

        zone "1.168.192.in-addr.arpa" IN  {
                type master;
                file "192.168.1.in-addr.arpa";
        };


        zone "2.168.192.in-addr.arpa" IN  {
                type master;
                file "192.168.2.in-addr.arpa";
        };


           zone "3.168.192.in-addr.arpa" IN  {
                type master;
                file "192.168.3.in-addr.arpa";
        };
		
		
</pre>

<strong># vi /var/named/localhost.zone</strong>

<pre>

$TTL 1D
$ORIGIN localhost.
@              IN  SOA   @  root (
                         1   ; Serial
                         8H  ; Refresh
                         15M ; Retry
                         1W  ; Expire
                         1D) ; Minimum TTL
               IN   NS   @
               IN   A    127.0.0.1
		
		
</pre>




<strong># vi /var/named/127.0.0.in-addr.arpa</strong>

<pre>

$TTL 1D
$ORIGIN 0.0.127.in-addr.arpa.
@    IN   SOA  localhost. root.localhost. (
               1    ; serial
               8H   ; refresh
               15M  ; retry
               1W   ; expire
               1D ) ; minimum
      IN   NS   localhost.
1    IN   PTR  localhost.
	
		
</pre>


<br/><br/>
<strong># vi /var/named/localdomain.zone</strong>
<br/><br/>

<pre>

$TTL 86400
@                   	IN SOA              	ns1.localdomain. root.localhost (
                                                            	2010063000 ; serial
                                                            	28800 ; refresh
                                                            	14400 ; retry
                                                            	3600000 ; expiry
                                                            	86400 ) ; minimum
@                   	IN                  	NS          	ns1.localdomain.
localhost           	IN                  	A           	127.0.0.1
ns1                 	IN                  	A           	192.168.1.10

scan                	IN                  	A           	192.168.1.31
scan                	IN                  	A           	192.168.1.32
scan                	IN                  	A           	192.168.1.33


node1-vip            	IN                  	A           	192.168.1.21
node2-vip            	IN                  	A           	192.168.1.22


node1                	IN                  	A           	192.168.1.11
node2                	IN                  	A           	192.168.1.12
storage             	IN                  	A           	192.168.1.15


node1-priv           	IN                  	A           	192.168.2.11
node2-priv           	IN                  	A           	192.168.2.12


node1-storage        	IN                  	A           	192.168.3.11
node2-storage        	IN                  	A           	192.168.3.12	
		
</pre>

<br/><br/>
<strong># vi /var/named/192.168.1.in-addr.arpa</strong>
<br/><br/>

<pre>

$TTL   	86400
@      	IN   	SOA   	ns1.localdomain. postmaster.localhost. (
                    	2010063000 ; serial
                    	28800 ; refresh
                    	14400 ; retry
                    	3600000 ; expiry
                    	86400 ) ; minimum
@      	IN   	NS   	ns1.localdomain.
1      	IN   	PTR  	localhost.
31     	IN   	PTR  	scan.localdomain.
32     	IN   	PTR  	scan.localdomain.
33     	IN   	PTR  	scan.localdomain.

21     	IN   	PTR  	rac1-vip.localdomain.
22     	IN   	PTR  	rac2-vip.localdomain.

11     	IN   	PTR  	rac1.localdomain.
12     	IN   	PTR  	rac2.localdomain.
13     	IN   	PTR  	storage.localdomain.
		
</pre>


<br/><br/>
<strong># vi /var/named/192.168.2.in-addr.arpa</strong>
<br/><br/>

<pre>

$TTL   	86400
@      	IN   	SOA   	ns1.localdomain. postmaster.localhost. (
                    	2010063000 ; serial
                    	28800 ; refresh
                    	14400 ; retry
                    	3600000 ; expiry
                    	86400 ) ; minimum
@      	IN   	NS   	ns1.localdomain.

11     	IN   	PTR  	node1-interconnect.localdomain.
12     	IN   	PTR  	node2-interconnect.localdomain.
		
</pre>




<br/><br/>
<strong># vi /var/named/192.168.3.in-addr.arpa</strong>
<br/><br/>

<pre>

$TTL   	86400
@      	IN   	SOA   	ns1.localdomain. postmaster.localhost. (
                    	2010063000 ; serial
                    	28800 ; refresh
                    	14400 ; retry
                    	3600000 ; expiry
                    	86400 ) ; minimum
@      	IN   	NS   	ns1.localdomain.

11     	IN   	PTR  	node1-storage.localdomain.
12     	IN   	PTR  	node2-storage.localdomain.
		
</pre>


<pre>

Добавление в автозапуск:
# chkconfig --level 345 named on

Restart
# service named restart

Статус:
rndc status


Проверка на клиентах:

nslookup node1
nslookup node2.localdomain
nslookup 192.168.1.11

</pre>

</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
