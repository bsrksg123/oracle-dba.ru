<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle 11.2]: Инсталляция СУБД Oracle (DataBase SoftWare)</h2>

<br/><br/>

<pre>

Войдите в систему пользователем, от имени которого будет будет происходить инсталляция базы данных.

# su - oracle11
$ cd /tmp


$ unzip p10404530_112030_Linux-x86-64_1of7.zip; \
unzip p10404530_112030_Linux-x86-64_2of7.zip


$ cd /tmp/database


Определите системную переменную DISPLAY следующим образом.

$ export DISPLAY=192.168.1.200:0.0

В данном случае 192.168.1.200 - ip адрес компьютера, с которого происходит процесс управления установкой. На этом компьютере должен быть стартован xserver, например XMing (под windows).

==========================================================

[Offtopic 1]:

Если управление установкой происходит с Debian linux (Ubuntu, Kubuntu, Mint etc.)

<strong>На клиенте:</strong>

# apt-get install -y gdm 

# vi /etc/gdm/custom.conf 

###########################
[xdmcp]

[chooser]

[security]
DisallowTCP=false

[debug]
###########################

# reboot 


// Команды проверки
# netstat -an | grep -F 6000
# nmap -p 6000 192.168.1.200


# xhost +192.168.1.10


========
<strong>На сервере:</strong>

Проверить работу можно установив xterm или xclock

# yum install -y xterm xclock

$ export DISPLAY=192.168.1.200:0.0

$ xterm
$ xclock 



[Offtopic 2]:

Если управление установкой происходит с дистрибутива RedHat linux (Fedora, Centos etc...)
http://www.softpanorama.org/Xwindows/Troubleshooting/can_not_open_display.shtml

==========================================================


<strong>Проверка конфигурации перед инсталляцией: </strong>

$ ./runInstaller -executeSysPrereqs
Starting Oracle Universal Installer...

Checking Temp space: must be greater than 120 MB.   Actual 27697 MB    Passed
Checking swap space: must be greater than 150 MB.   Actual 4031 MB    Passed
Checking monitor: must be configured to display at least 256 colors.    Actual 65536    Passed
Exiting Oracle Universal Installer, log for this session can be found at /tmp/OraInstall2012-06-10_03-03-29AM/installActions2012-06-10_03-03-29AM.log


<strong>Запус программы инсталляции базы данных: </strong>

$ ./runInstaller

В некоторых случаях приходится запускать инсталляцию с игнорированием системных сообщений

$ ./runInstaller -ignoreSysPrereqs

Если все нормально, появится картинка:  
  
</pre>


<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_01.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_02.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_03.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_04.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_05.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_06.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_07.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_08.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_09.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_10.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_11.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_12.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_13.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_14.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_15.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_16.PNG" border="0" alt="Oracle RAC installation"><br/><br/>
<img src="http://img.oradba.net/img/oracle/database/simple/11.2/oracle11_database_software_installation_17.PNG" border="0" alt="Oracle RAC installation"><br/><br/>



<pre>

После появления следующего окна, необходимо выполнить под учетной записью root следующие скрипты. Рекомендуется подключиться к серверу баз данных еще одной сессией putty.


# /u01/oraInventory/orainstRoot.sh
Changing permissions of /u01/oraInventory.
Adding read,write permissions for group.
Removing read,write,execute permissions for world.

Changing groupname of /u01/oraInventory to oinstall.
The execution of the script is complete.



# /u01/oracle/database/11.2/root.sh
Performing root user operation for Oracle 11g

The following environment variables are set as:
    ORACLE_OWNER= oracle11
    ORACLE_HOME=  /u01/oracle/database/11.2

Enter the full pathname of the local bin directory: [/usr/local/bin]:
   Copying dbhome to /usr/local/bin ...
   Copying oraenv to /usr/local/bin ...
   Copying coraenv to /usr/local/bin ...


Creating /etc/oratab file...
Entries will be added to the /etc/oratab file as needed by
Database Configuration Assistant when a database is created
Finished running generic part of root script.
Now product-specific root actions will be performed.
Finished product-specific root actions.


</pre>

</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
